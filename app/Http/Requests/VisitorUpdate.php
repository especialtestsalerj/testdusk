<?php

namespace App\Http\Requests;

use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Support\Constants;
use Illuminate\Validation\Rule;

class VisitorUpdate extends VisitorStore
{
    public function authorize()
    {
        return allows_in_current_building('visitors:update');
    }
    public function rules()
    {
        return [
            'visitor_id' => 'required',
            'document_type_id' => 'required',
            'document_number' => ['bail', 'required'],
            'full_name' => 'required',
            'entranced_at' => ['bail', 'required'],
            'exited_at' => ['bail', 'nullable', 'after_or_equal:entranced_at'],
            'sector_id' => 'required',
            'description' => 'required',
            'contact_type_id' => 'required',
            'contact' => [
                'required',
                Rule::when($this->contact_type_id == Constants::CONTACT_TYPE_EMAIL, 'email')
            ],
        ];
    }
}
