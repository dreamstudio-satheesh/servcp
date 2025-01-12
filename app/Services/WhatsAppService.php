<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    protected $client;

    public function __construct()
    {
        $sid = config('whatsapp.sid') ?: WhatsappSetting::getSetting('twilio_sid');
        $token = config('whatsapp.auth_token') ?: WhatsappSetting::getSetting('twilio_auth_token');
        $from = config('whatsapp.whatsapp_number') ?: WhatsappSetting::getSetting('twilio_whatsapp_number');

        $this->client = new Client($sid, $token);
    }

    public function sendMessage($to, $message)
    {
        $from = config('services.twilio.whatsapp_number') ?: WhatsappSetting::getSetting('twilio_whatsapp_number');
        return $this->client->messages->create("whatsapp:{$to}", [
            'from' => "whatsapp:{$from}",
            'body' => $message,
        ]);
    }
}
