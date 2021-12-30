<?php

namespace App\Http\Livewire\Admin\Sites;

use App\Models\BlockLink;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ModalEditBlockLink extends Component
{
    use AuthorizesRequests;

    public $name;

    public $icon = 'icon-none';

    public $link;

    public $data;

    public $confirmingUpdateBlockLink = false;

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'link' => 'required|url',
            'icon' => 'string',
        ];
    }

    public function mount()
    {
        $this->name = $this->data->name;
        $this->icon = $this->data->icon;
        $this->link = $this->data->link;
    }

    public function confirmUpdateBlockLink()
    {
        $this->resetErrorBag();

        $this->dispatchBrowserEvent('confirming-block-link-update');

        $this->confirmingUpdateBlockLink = true;
    }

    public function update($id)
    {
        $this->authorize('sites update');

        $validatedData = $this->validate();

        $block = BlockLink::findOrFail($id);
        $block->name = $validatedData['name'];
        $block->link = $validatedData['link'];
        $block->icon = $validatedData['icon'] ?? 'icon-none';
        $block->update();

        $this->emitTo('admin.sites.form-site', 'refreshComponent');

        return $this->confirmingUpdateBlockLink = false;
    }

    public function render()
    {
        return view('livewire.admin.sites.modal-edit-block-link');
    }
}
