<?php namespace SpreadOut\SmsNotifier;

use Services_Twilio;

class TwilioSms implements SmsNotifierContract {
    /**
     * @var Services_Twilio
     */
    private $twilio;

    /**
     * @param Services_Twilio $twilio
     */
    public function __construct(Services_Twilio $twilio, $number)
    {
        $this->twilio = $twilio;
        $this->number = $number;
    }

    /**
     * Send message
     *
     * @param $to
     * @param $message
     * @return mixed
     */
    public function send($to, $message)
    {
        return $this->twilio->account->messages->sendMessage(
            $this->number,
            $to,
            $message
        );
    }
}