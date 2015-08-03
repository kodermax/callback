<?php namespace Kodermax\CallBack\Components;

use Cms\Classes\ComponentBase;
use Validator;
use ValidationException;

class Request extends ComponentBase
{
    public $formValidationRules = [
        'phone' => ['required']
    ];
    public $customMessages =  [
        'phone.required' => 'kodermax.callback::lang.messages.phone.required',
    ];
    public function componentDetails()
    {
        return [
            'name'        => 'kodermax.callback::lang.component.name',
            'description' => 'kodermax.callback::lang.component.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onPost()
    {

        // Build the validator
        $validator = Validator::make(post(), $this->formValidationRules, $this->customMessages);
        // Validate
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        //Add to Database
        $entry = EntryModel::add(post());

//        $this->page["confirmation_text"] = Settings::get('confirmation_text');
        return ['error' => false];
    }

}