<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use App\Data\Repositories\Buildings as BuildingsRepository;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRolesAndAbilities;

    protected static $allowedBuildings;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['profile_photo_url'];

    public function updatePermissions($permissionsResponse)
    {
        $this->abilities()->sync([]);

        collect($permissionsResponse)->each(function ($item) {
            Bouncer::allow($this)->to($item['evento']);
        });
        Bouncer::refresh();
    }

    public function updateProfiles($profileResponse)
    {
        $this->roles()->sync([]);

        collect($profileResponse)->each(function ($item) {
            Bouncer::assign($item['NOME_PERFIL'])->to($this);
        });
        Bouncer::refresh();
    }

    protected function name(): Attribute
    {
        return Attribute::make(get: fn($value) => convert_case($value, MB_CASE_UPPER));
    }

    public function removeAccessTokens()
    {
        return $this->tokens()
            ->where('personal_access_tokens.name', 'access')
            ->delete();
    }
    public function afterAuthentication()
    {
        $this->removeAccessTokens();
        $token = $this->createToken(
            'access',
            $this->getAbilities()
                ->pluck('name')
                ->toArray()
        )->plainTextToken;

        $this->withAccessToken($token);
        session()->put('access-token', $token);
    }

    //TODO trabalhar futuramente com uma escolha de o sistema favorito , para que este seja o sistema inicial da aplicação
    public function getBuildingIdAttribute()
    {
        return ($allowed = $this->allowed_buildings)->isEmpty() ? null : $allowed->first()->id;
    }

    public function getAllowedBuildingsAttribute()
    {
        if (static::$allowedBuildings) {
            return static::$allowedBuildings;
        }

        $profilesAllowed = $this->makeProfilesList();

        static::$allowedBuildings = app(BuildingsRepository::class)
            ->all()
            ->filter(function ($building) use ($profilesAllowed) {
                return $this->isSuperUser($profilesAllowed) ||
                    array_has($profilesAllowed, $building->slug);
            });

        return static::$allowedBuildings;
    }

    public function isSuperUser($allowed): bool
    {
        return isset($allowed['all']) && $allowed['all'] === 'administrador';
    }
    protected function makeProfilesList()
    {
        $allowed = collect(json_decode($this->roles, true))->mapWithKeys(function ($value, $key) {
            list($client, $profile) = extract_client_and_permission($value['name']);

            return [$client => $profile];
        });

        return $allowed;
    }

    public function canInCurrentBuilding($ability)
    {
        return allows_in_current_building($ability);
    }

    public function getMainBuilding()
    {
        return $this->allowed_buildings->first() ?? null;
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }
}
