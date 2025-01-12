<?php

return [

    'sid' => env('TWILIO_SID', null),
    'auth_token' => env('TWILIO_AUTH_TOKEN', null),
    'whatsapp_number' => env('TWILIO_WHATSAPP_NUMBER', null),

    'fallback_to_db' => true, // Enable fallback to database if .env value is not set

];