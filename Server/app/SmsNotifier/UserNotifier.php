<?php namespace SpreadOut\SmsNotifier;

class UserNotifier {
    /**
     * @var SmsNotifierContract
     */
    private $sms;

    /**
     * @param SmsNotifierContract $sms
     */
    public function __construct(SmsNotifierContract $sms)
    {
        $this->sms = $sms;
    }

    /**
     * @param $number
     * @param $code
     * @return bool
     */
    public function confirmation($number, $code)
    {
        $message = 'Welcome to SpreadOut. Your confirmation code is: ' . $code;

        return (bool) $this->sms->send($number, $message);
    }
}