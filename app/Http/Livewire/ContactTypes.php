<?php

namespace App\Http\Livewire;

use App\Models\ContactType;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ContactTypes extends Component
{
    public $showModal = false;
    public $showDeleteModal = false;
    public $displayStatus = 0;

    public $contactTypeId;
    public $name;
    public $style;
    public $user;
    public $editMode = false;

    public function rules()
    {
        return [
            'name' => 'required',
            'style' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.contact-types', [
            'data' => $this->read(),
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function read()
    {
        return ContactType::orderby('name')->get();
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->showModal = true;
    }
    
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->contactTypeId = $id;
        $this->showModal = true;
        $this->loadModel();
    }

    public function deleteShowModal($id)
    {
        $this->contactTypeId = $id;
        $this->showDeleteModal = true;
    }

    public function create()
    {
        $this->editMode = false;
        $this->validate();
        ContactType::create($this->modelData());
        $this->showModal = false;
        $this->reset();
    }

    public function modelData()
    {
        if($this->contactTypeId)
        {
            return [
                'name' => $this->name,
                'style' => $this->style,
            ];   
        }
    }

    public function update()
    {
        $this->editMode = false;
        $this->validate();
        ContactType::find($this->contactTypeId)->update($this->modelData());
        $this->showModal = false;
    }

    public function delete()
    {
        ContactType::destroy($this->contactTypeId);
        $this->showDeleteModal = false;
        //$this->resetPage();
    }

    public function loadModel()
    {
        $data = ContactType::find($this->contactTypeId);
        $this->name = $data->name;
        $this->style = $data->style;
    }

    public function close()
    {
        $this->showModal = false;
    }
}
