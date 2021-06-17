<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SaveNewArticleRequest extends FormRequest
{
    public $validator = null;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false; //return False will stop everything
		return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
		    'title'        => 'required|string|min:3|max:255',
		    'body'         => 'required|string|min:5|max:255',            
			//image validation https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
			//'filename' => ['required', /*'image',*/ 'mimes:jpeg,png,jpg,gif,svg', 'max:2048' ], // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',,
			//'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' //min:2048
		];
    }
    
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
		
		
        // use trans instead on Lang 
        return [
           //'username.required'  => Lang::get('userpasschange.usernamerequired'),
		   'title.required'       => 'Kindly asking for a title',
	       'body.required'        => 'We need u to specify the article text',
		   'body.min'             => 'We kindly require more than 5 letters for article text',
		   //'filename.required'  => 'Image is very much required',
		   'filename.image'    => 'Make sure it is an image',
		   'filename.mimes'    => 'Must be .jpeg, .png, .jpg, .gif, .svg file. Max size is 2048',
		   'filename.max'      => 'Sorry! Maximum allowed size for an image is 2MB',
		   //'filename.min'      => 'Your image is too small',
		];
	}
	

    
	 
	/**
     * To override Return validation errors. In this case it will return and exucute code in Controller, even if Request Validation fails
     * @param Validator $validator
     * 
     */
    
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
        //return response()->json(['error' => true, 'errors' => $validator->errors()->all()]);
    }
    
    
    /**
     * Return validation errors 
     *
     * @param Validator $validator
     */
     
    /*public function withValidator(Validator $validator)
    {
	
	    if ($validator->fails()) {
            //return redirect('/createNewWpressImg')->withInput()->with('flashMessageFailX', 'Validation Failed!!!' )->withErrors($validator);
            return response()->json(['error' => true, 'errors' => $validator->errors()->all()]);
        }
	}*/
}
