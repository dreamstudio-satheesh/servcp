<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function sendAppointmentReminder(Request $request)
    {
        $request->validate([
            'to' => 'required|regex:/^\+\d{1,15}$/', // International format
            'message' => 'required|string',
        ]);

        $response = $this->whatsappService->sendMessage($request->to, $request->message);

        return response()->json(['status' => 'success', 'data' => $response]);
    }
}
