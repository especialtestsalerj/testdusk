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

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRolesAndAbilities;

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
}
