<?php

namespace App\Http\Livewire\Admin\Sites;

use App\Models\Block;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModalCreateBlock extends Component
{
    use AuthorizesRequests;

    public $name;

    public $site_id;

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
        ];
    }

    public $confirmingCreateBlock = false;

    public function confirmCreateBlock()
    {
        $this->resetErrorBag();

        $this->name = '';

        $this->dispatchBrowserEvent('confirming-block-add');

        $this->confirmingCreateBlock = true;
    }

    public function store()
    {
        $this->authorize('sites update');

        $this->resetErrorBag();

        $validatedData = $this->validate();

        $block = new Block();
        $block->name = $validatedData['name'];
        $block->site_id = $this->site_id;
        $block->save();

        $this->emitTo('admin.sites.form-site', 'refreshComponent');

        return $this->confirmingCreateBlock = false;
    }

    public function render()
    {
        return view('livewire.admin.sites.modal-create-block');
    }
}
