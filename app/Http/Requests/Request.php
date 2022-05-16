<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class Request extends FormRequest
{
    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        return $this->sanitize(parent::all($keys));
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return allows('must-be-god');
    }

    /**
     * @param array $all
     * @return array
     */
    public function sanitize(array $all)
    {
        $this->replace($all);

        return $all;
    }
}
