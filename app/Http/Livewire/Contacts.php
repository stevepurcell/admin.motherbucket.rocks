<?php

namespace App\Http\Livewire;

use console;
use App\Models\Contact;
use Livewire\Component;
use App\Models\ContactType;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class Contacts extends Component
{
    //use WithPagination;
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $showModal = false;
    public $showDeleteModal = false;
    public $displayStatus = 0;
    public $contactId;

    public $name;
    public $address;
    public $city;
    public $state;
    public $zipcode;
    public $phone;
    public $email;
    public $website;
    public $contact_name;
    public $notes;
    public $contact_type_id;
    public $contact;

    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'zipcode' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
            'website' => 'nullable',
            'contact_name' => 'nullable',
            'contact_type_id' => 'nullable',
            'notes' => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.contacts', [
            'data' => $this->read(),
            'contacttypes' => ContactType::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function read()
    {
        return Contact::orderby('name')->get();
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
        $this->userId = $id;
        $this->showModal = true;
        $this->loadModel();
    }

    public function deleteShowModal($id)
    {
        $this->userId = $id;
        $this->showDeleteModal = true;
    }

    public function create()
    {
        $this->validate();
        UserModel::create($this->modelData());
        $this->showModal = false;
        $this->reset();
    }

    public function modelData()
    {
        if($this->userId)
        {
            // This is for an edit so the password is untouched.
            return [
                'name' => $this->name,
                'email' => $this->email,
                'is_member' => $this->is_member,
                'is_admin' => $this->is_admin,
            ];   
        } else {
            // This is for a new record creating a password
            return [
                'name' => $this->name,
                'email' => $this->email,
                'is_member' => $this->is_member,
                'is_admin' => $this->is_admin,
                'password' => Hash::make('password'),
            ];   
        }
    }

    public function update()
    {
        $this->validate();
        UserModel::find($this->userId)->update($this->modelData());
        $this->showModal = false;
    }

    public function delete()
    {
        UserModel::destroy($this->userId);
        $this->showDeleteModal = false;
        //$this->resetPage();
    }

    public function loadModel()
    {
        $data = UserModel::find($this->userId);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->is_member = $data->is_member;
        $this->is_admin = $data->is_admin;    
    }

    public function close()
    {
        $this->showModal = false;
    }
}
