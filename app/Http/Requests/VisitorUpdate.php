<?php

namespace App\Http\Requests;

use App\Data\Repositories\Visitors as VisitorsRepository;
class VisitorUpdate extends VisitorStore
{
    public function authorize()
    {
        return allows('visitors:update');
    }
    public function rules()
    {
        $id = $this->get('id');
        $visitor = app(VisitorsRepository::class)->findById($id);

        return [
            'id' => 'required',
            'document_type_id' => 'required',
            'document_number' => ['bail', 'required'],
            'full_name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required_if:country_id,' . config('app.country_br'),
            'city_id' => 'required_if:country_id,' . config('app.country_br'),
            'other_city' => 'required_unless:country_id,' . config('app.country_br'),
            'entranced_at' => ['bail', 'required'],
            'exited_at' => ['bail', 'nullable', 'after_or_equal:entranced_at'],
            'sector_id' => 'required',
            'description' => 'required',
        ];
    }
}
