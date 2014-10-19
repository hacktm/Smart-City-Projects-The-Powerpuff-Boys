<?php namespace SpreadOut\SmsNotifier;

interface SmsNotifierContract {

    /**
     * @param $to
     * @param $message
     * @return mixed
     */
    public function send($to, $message);
}