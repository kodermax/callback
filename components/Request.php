<?php namespace Kodermax\CallBack\Components;

use Cms\Classes\ComponentBase;
use Guzzle\Http\Client;
use Kodermax\CallBack\Models\Request as RequestModel;
use Kodermax\CallBack\Models\Settings;
use Mail;
use Validator;
use ValidationException;
use Exception;

class Request extends ComponentBase
{
    public $formValidationRules = [
        'phone' => ['required']
    ];
    public $customMessages =  [
        'phone.required' => 'Необходимо указать телефон!!!'
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
        $validator = Validator::make(post(), $this->formValidationRules);
        // Validate
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        //Add to Database
        $entry = RequestModel::add(post());
        $sendSms = Settings::get('send_sms');
        if($sendSms) {
            $client = new Client();
            $dest = substr_replace(preg_replace('/[^0-9]/', '', array_get(post(), 'phone')), 8, 0, 1);
            $message = Settings::get('subject') . ' ' . $dest;
            $phone = Settings::get('recipient_phone');
            $login = Settings::get('login');
            $pass = Settings::get('pwd');
            $url = 'http://smsc.ru/sys/send.php?login=' . $login . '&psw=' . $pass . '&phones=' . $phone . '&charset=utf-8&mes=' . $message;
            try {
                $res = $client->post($url);
            } catch (RequestException $e) {

            }
        }
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