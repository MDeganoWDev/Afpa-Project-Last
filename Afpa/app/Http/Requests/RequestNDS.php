<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestNDS extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'titre' => 'required|alpha_num|max:50',
            'auteur' => 'required|alpha|max:40',
            'date_creation' => 'required|date',
        ];
    
        if($this->getMethod() == 'POST') { // Vérifie si la requête est une création ou une mise à jour
            $rules['pdf'] = 'required|mimetypes:application/pdf';
        } else {
            $rules['pdf'] = 'sometimes|mimetypes:application/pdf';
        }
    
        return $rules;
    }
    
}
