<?php

namespace App\Http\Requests\Topic;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title' => 'required|min:5|max:80',
            'link' => 'nullable|url',
            'body' => 'required|min:10'
        ];
    }

    public function messages()
    {
        return parent::messages();
    }

    //returns true, if domain is availible, false if not
    private function isDomainAvailible($domain)
    {
        //check, if a valid url is provided
        if(!filter_var($domain, FILTER_VALIDATE_URL))
        {
            return false;
        }

        //initialize curl
        $curlInit = curl_init($domain);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

        //get answer
        $response = curl_exec($curlInit);

        curl_close($curlInit);

        if ($response) return true;

        return false;
    }
}
