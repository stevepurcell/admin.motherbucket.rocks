<?php

namespace App\Http\Livewire;

use console;
use Livewire\Component;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class StatusTypes extends Component
{
    //use WithPagination;
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $showModal = false;
    public $showDeleteModal = false;
    public $displayStatus = 0;
    public $userId;
    public $name;
    public $email;
    public $password;
    public $is_member;
    public $is_admin;
    public $created_at;
    public $user;
    public $editMode = false;

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'is_member' => 'nullable',
            'is_admin' => 'nullable',
            'password' => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.user', [
            'data' => $this->read(),
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function read()
    {
        return UserModel::orderby('name')->get();
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
        $this->editMode = false;
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
        $this->editMode = false;
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
