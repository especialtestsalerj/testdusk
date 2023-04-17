<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoutineStore extends Request
{
    public function authorize()
    {
        return allows('routines:store');
    }

    public function rules()
    {
        Validator::extend('valid_period', function ($attribute, $value, $parameters, $validator) {
            $input = $validator->getData();

            //Avoiding the same date and shift
            if (
                DB::table('routines')
                    ->where('shift_id', $input['shift_id'])
                    ->whereDate(
                        'entranced_at',
                        \Carbon\Carbon::parse($input['entranced_at'])->format('Y-m-d')
                    )
                    ->exists()
            ) {
                return false;
            }

            //New routine can't point to the past
            $routines = DB::table('routines')
                ->whereDate('entranced_at', '>=', $input['entranced_at'])
                ->get();

            $valid = true;
            foreach ($routines as $routine) {
                echo $input['entranced_at'] . 'Z' . $routine->entranced_at;
                //Same date but shorter time
                if (
                    \Carbon\Carbon::parse($input['entranced_at'])->format('Y-m-d H:i') <
                    \Carbon\Carbon::parse($routine->entranced_at)->format('Y-m-d H:i')
                ) {
                    return false;
                }

                //Date/time longer but shift don't
                if ($input['shift_id'] < $routine->shift_id) {
                    $valid = false;
                }
            }

            return $valid;
        });

        return [
            'shift_id' => 'required',
            'entranced_at' => 'required|valid_period:shift_id,entranced_at',
            'entranced_user_id' => 'required',
            'checkpoint_obs' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'entranced_at.required' => 'Data (Assunção): preencha o campo corretamente.',
            'entranced_at.valid_period' =>
                'Data (Assunção): informe turno e data válidos. Uma rotina aberta não pode apontar para o passado.',
            'entranced_user_id.required' =>
                'Responsável (Assunção): preencha o campo corretamente.',
        ];
    }
}
