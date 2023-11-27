<?php

namespace Nkls\Tables\Traits;

trait CrudTrait
{
    // public $openedModalId = null;

    public $openModal;

    public $action;

    public $modalBody;

    // public function updatedCrudTrait($field, $value)
    // {
    //     $this->validateOnly($field);
    // }

    public function create()
    {
        $this->action = 'create';
        $this->modalBody = 'nkls::tables.includes.modals.action-modal';

        // $this->openedModalId = $this->actionModalId;
        $className = get_class($this->form);
        $this->form = new $className($this, 'form');

        $this->form->reset();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        $this->form->save();
        session()->flash('success', 'User created successfully.');
        $this->closeModal();
    }

    // public function openModal($id)
    // {
    //     $this->openedModalId = $id;
    // }

    public function closeModal()
    {
        $this->action = 'closeModal';
        $this->dispatch('closeModal', modalId: $this->modalId);
        // $this->openedModalId = null;
    }
}
