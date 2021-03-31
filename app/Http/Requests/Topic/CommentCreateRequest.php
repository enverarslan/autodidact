<?php

namespace App\Http\Requests\Topic;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validationData()
    {
        $body = $this->get('body');
        //$body = preg_replace('/(\r\n)/', '', $body);
        $body = preg_replace('/<p>&nbsp;<\/p>/', '', $body);
        $this->request->set('body', $body);
        return $this->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|min:30'
        ];
    }

    public function messages()
    {
        return parent::messages();
    }

    public function getRedirectUrl()
    {
        $url = parent::getRedirectUrl();

        return "$url#comment";

    }
}
