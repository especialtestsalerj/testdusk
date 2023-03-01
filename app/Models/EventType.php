<?php

namespace App\Models;

use App\Http\Requests\EventTypeDelete;
use Illuminate\Support\Facades\Validator;

class EventType extends Model
{
    protected $fillable = ['name', 'status'];

    protected $filterableColumns = ['name', 'status'];

    public function events()
    {
        return $this->hasMany(Event::class, 'event_type_id');
    }

    public function canDelete()
    {
        $request = new EventTypeDelete($this->toArray());

        return Validator::make($request->all(), $request->rules())->fails();
    }
}
