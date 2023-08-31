<?php

namespace App\Models;

use App\Http\Requests\CertificateTypeDestroy;
use Illuminate\Support\Facades\Validator;

class CertificateType extends Model
{
    protected $fillable = ['name', 'status'];

    protected $filterableColumns = ['name', 'status'];

    public function cautions()
    {
        return $this->hasMany(Caution::class, 'certificate_type_id');
    }

    public function canDelete()
    {
        $request = new CertificateTypeDestroy($this->toArray());

        return Validator::make($request->all(), $request->rules())->fails();
    }
}
