<?php namespace Kodermax\CallBack\Components;

use Cms\Classes\ComponentBase;
use Kodermax\CallBack\Models\Request as RequestModel;
use Validator;
use ValidationException;

class Request extends ComponentBase
{
    public $formValidationRules = [
        'phone' => ['required']
    ];
    public $customMessages =  [
        'phone.required' => 'Поле телефон не заполнено!',
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
        $entry = RequestModel::add(post());
        try {
            Mail::send('kodermax.callback::emails.message', post(), function ($message) {
                $message->from(post('email'), post('phone'))
                    ->to(Settings::get('recipient_email'), Settings::get('recipient_name'))
                    ->subject(Settings::get('subject'));
            });
        }
        catch (Exception $ex) {

        }
        $this->page["confirmation_text"] = Settings::get('confirmation_text');
        return ['error' => false];
    }
    public function onRun() {
        $this->addJs('assets/components/jquery.inputmask/dist/inputmask/jquery.inputmask.min.js');
        $this->addJs('assets/js/main.js');
    }
}