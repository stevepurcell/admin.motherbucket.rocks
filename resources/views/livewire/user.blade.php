<div>
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-md-12">
    <div class="card">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between">
                <h3>Users</h3> 

                <a wire:click.prevent="createShowModal" href="#" class="btn btn-outline-dark">New User</a>
            </div>
        </div>
        <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" >Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" >Role(s)</th>
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
      <tbody>
            @forelse ($data as $item)
                <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>@if($item->is_member)
                    <span class="badge badge-pill badge-warning">Member</span>
                    @endif
                    @if($item->is_admin)
                    <span class="badge badge-pill badge-primary">Admin</span>
                    @endif
                </td>
                <td>{{ $item->created_at->diffForHumans() }}</td>
                <td class="">
                        <button class="btn btn-sm btn-primary"
                            wire:click.prevent="updateShowModal({{ $item->id }})">Edit
                        </button>
                        <button class="btn btn-sm btn-danger"
                            wire:click.prevent="deleteShowModal({{ $item->id }})">Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No Users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
        {{-- {!! $data->links() !!}      --}}
    </div>
    <div class="modal" @if ($showModal) style="display:block" @endif>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $userId ? 'Edit User' : 'Add User' }}</h5>
                        <button wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label font-weight-bold">Name:</label>
                        <div class="col-sm-10">
                            <input wire:model.debounce.800ms="name" class="form-control" id="name">
                            @error('name')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label font-weight-bold">Email:</label>
                        <div class="col-sm-10">
                            <input wire:model="email" class="form-control" id="email">
                            @error('email')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_member" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" wire:model="is_member" id="keyboard" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Is Band Member</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_admin" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" wire:model="is_admin" id="acoustic" value="1">
                                <label class="form-check-label" for="inlineCheckbox2">Is Admin User</label>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        @if ($userId)
                            <button <button class="btn btn-primary" wire:click="update" wire:loading.attr="disabled">
                                {{ __('Update') }}
                            </button>
                        @else
                            <button <button class="btn btn-primary" wire:click="create" wire:loading.attr="disabled">
                                {{ __('Create') }}
                            <button>
                        @endif
                        <button class="btn btn-secondary" wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </button>
                    </div>
            </div>
        </div>
    </div>

    
        {{-- The Delete Modal --}}
        <div class="modal" @if ($showDeleteModal) style="display:block" @endif>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="container d-flex pl-0">
                            <h5 class="modal-title ml-2" id="exampleModalLabel">Delete</h5>
                        </div> 
                        <button type="button" wire:click="$toggle('showDeleteModal')" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="modal-footer"> 
                        <button class="btn btn-secondary" wire:click="$toggle('showDeleteModal')" data-dismiss="modal" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </button>
                        <button type="button" wire:click="delete" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
    
    