<?php

namespace App\Models;

use App\Http\Requests\SectorDestroy;
use Illuminate\Support\Facades\Validator;

class Sector extends Model
{
    protected $fillable = ['name', 'status'];

    protected $filterableColumns = ['name', 'status'];

    public function canDelete()
    {
        $request = new SectorDestroy($this->toArray());

        return Validator::make($request->all(), $request->rules())->fails();
    }
}
