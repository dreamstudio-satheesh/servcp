<?php

namespace App\Livewire;



use Livewire\Component;
use App\Models\WhatsappSetting;

class WhatsAppSettings extends Component
{
    public $settings = [];

    public function mount()
    {
        $this->settings = WhatsappSetting::all()->pluck('value', 'key')->toArray();
    }

    public function save()
    {
        foreach ($this->settings as $key => $value) {
            WhatsappSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        session()->flash('message', 'Settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.whatsapp-settings');
    }
}