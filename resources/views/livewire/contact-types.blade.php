<div>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    
                    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="d-flex justify-content-between">
                    <h3>Contact Types</h3> 
    
                    <a wire:click.prevent="createShowModal" href="#" class="btn btn-dark">New</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col" >ID</th>
                        <th scope="col" >Name</th>
                        <th scope="col" >Style</th>
                        <th scope="col" >Badge</th>
                        <th scope="col" >Action</th>
                
                    </tr>
                </thead>
          <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->style }}</td>
                        <td><span class="badge badge-{{ $item->style }}">{{ $item->name }}</span></td>
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
                        <td colspan="3">No Contact Types found.</td>
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
                            <h5 class="modal-title">{{ $contactTypeId ? 'Edit Contact Type' : 'Add ContactType' }}</h5>
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
                            <label for="style" class="col-sm-2 col-form-label font-weight-bold">Style:</label>
                            <div class="col-sm-10">
                                <input wire:model="style" class="form-control" id="style">
                                @error('style')
                                    <div style="font-size: 11px; color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            @if ($contactTypeId)
                                <button <button class="btn btn-primary" wire:click="update" wire:loading.attr="disabled">
                                    {{ __('Update') }}
                                </button>
                            @else
                                <button class="btn btn-primary" wire:click="create" wire:loading.attr="disabled">
                                    {{ __('Create') }}
                                </button>
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
            </div>
        </div>
        
        
        
        
        