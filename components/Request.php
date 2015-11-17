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
    private function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
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
            $client = new \GuzzleHttp\Client();
            $dest = substr_replace(preg_replace('/[^0-9]/', '', array_get(post(), 'phone')), 8, 0, 1);
            $message = Settings::get('subject') . ' ' . $dest;
            $phone = Settings::get('recipient_phone');
            $login = Settings::get('login');
            $pass = Settings::get('pwd');
            $url = 'http://smsc.ru/sys/send.php?login=' . $login . '&psw=' . $pass . '&phones=' . $phone . '&charset=utf-8&mes=' . urlencode($message);

            try {
                $res = $client->request('GET', $url);
            } catch (\Exception $e) {

            }
        }
            try {
                $phone = post('phone');
            Mail::send('kodermax.callback::emails.message', post(), function ($message) use ($phone) {
                $message->from(Settings::get('from_email'))
                        ->to(Settings::get('recipient_email'), Settings::get('recipient_name'))
                        ->subject(Settings::get('subject'). ' ' .$phone);
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