<?php

namespace App\Livewire;



use Livewire\Component;
use App\Models\WhatsappTemplate;

class WhatsAppTemplates extends Component
{
    public $templates;
    public $templateId, $name, $template;

    protected $rules = [
        'name' => 'required|string|max:255',
        'template' => 'required|string',
    ];

    public function mount()
    {
        $this->templates = WhatsappTemplate::all();
    }

    public function save()
    {
        $this->validate();

        WhatsappTemplate::updateOrCreate(
            ['id' => $this->templateId],
            ['name' => $this->name, 'template' => $this->template]
        );

        session()->flash('message', 'Template saved successfully!');
        $this->resetForm();
        $this->templates = WhatsappTemplate::all();
    }

    public function edit($id)
    {
        $template = WhatsappTemplate::findOrFail($id);
        $this->templateId = $template->id;
        $this->name = $template->name;
        $this->template = $template->template;
    }

    public function delete($id)
    {
        WhatsappTemplate::findOrFail($id)->delete();
        session()->flash('message', 'Template deleted successfully!');
        $this->templates = WhatsappTemplate::all();
    }

    public function resetForm()
    {
        $this->templateId = null;
        $this->name = '';
        $this->template = '';
    }

    public function render()
    {
        return view('livewire.whatsapp-templates');
    }
}