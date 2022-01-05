<div>
    <div class="card">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between">
                <h3>Contacts</h3> 


                @foreach($contacttypes as $contacttype)
                    <a wire:click.prevent="showType({{ $contacttype->id }})" 
                        href="#" class="btn btn-{{ $contacttype->style }}">{{ $contacttype->name }} 
                    <span class="badge badge-light">{{ getContactTypeCount($contacttype->id) }}</span>
                </a>
                @endforeach

                <a wire:click.prevent="createShowModal" href="#" class="btn btn-outline-dark">Add</a>
            </div>
        </div>

        <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" wire:click="sortByColumn('name')">
                        Name <i class="fas fa-caret-down"></i>
                        @if ($sortColumn == 'name')
                            <i class="fas fa-caret-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                        @endif
                    </th>
                    <th scope="col" wire:click="sortByColumn('email')">
                        Email
                        @if ($sortColumn == 'email')
                            <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                        @endif
                    </th>
                    <th scope="col" wire:click="sortByColumn('phone')">
                        Phone #
                        @if ($sortColumn == 'phone')
                            <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                        @endif
                    </th>
                    <th scope="col" wire:click="sortByColumn('contact_type_id')">
                        Type
                        @if ($sortColumn == 'contact_type_id')
                            <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                        @endif
                    </th>
        
                    <th scope="col">Action</th>
                </tr>
            </thead>
      <tbody>
            @forelse ($data as $item)
                <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td><span class="badge badge-{{ $item->contact_type->style }}">{{ $item->contact_type->name }}</span></td>
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
                    <td colspan="3">No Contacts found.</td>
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
                        <h5 class="modal-title">{{ $contactId ? 'Edit Contact' : 'Add New Contact' }}</h5>
                        <button wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group row">
                        <label for="contact_type_id" class="col-sm-2 col-form-label font-weight-bold">Contact Type:</label>
                        <div class="col-sm-10">
                            <select wire:model="contact_type_id" class="form-control">
                                <option value="">-- choose contact type --</option>
                                    @foreach ($contacttypes as $contacttype)
                                        <option value="{{ $contacttype->id }}">{{ $contacttype->name }}</option>
                                    @endforeach
                            </select>
                            @error('contact_type_id')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
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
                        <label for="address" class="col-sm-2 col-form-label font-weight-bold">Address:</label>
                        <div class="col-sm-10">
                            <input wire:model="address" class="form-control" id="address">
                            @error('address')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label font-weight-bold">City:</label>
                        <div class="col-sm-10">
                            <input wire:model="city" class="form-control" id="city">
                            @error('city')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="state" class="col-sm-2 col-form-label font-weight-bold">State:</label>
                        <div class="col-sm-10">
                            <input wire:model="state" class="form-control" id="state">
                            @error('state')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="zipcode" class="col-sm-2 col-form-label font-weight-bold">Zipcode:</label>
                        <div class="col-sm-10">
                            <input wire:model="zipcode" class="form-control" id="zipcode">
                            @error('zipcode')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label font-weight-bold">Phone:</label>
                        <div class="col-sm-10">
                            <input wire:model="phone" class="form-control" id="phone">
                            @error('phone')
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
                        <label for="website" class="col-sm-2 col-form-label font-weight-bold">Website:</label>
                        <div class="col-sm-10">
                            <input wire:model="website" class="form-control" id="website">
                            @error('website')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="contact_name" class="col-sm-2 col-form-label font-weight-bold">Contact Person:</label>
                        <div class="col-sm-10">
                            <input wire:model="contact_name" class="form-control" id="contact_name">
                            @error('contact_name')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="time" class="col-sm-2 col-form-label font-weight-bold">Notes:</label>
                        <div class="col-sm-10">
                            <input wire:model="time" class="form-control" id="time">
                            @error('time')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="notes" class="col-sm-2 col-form-label font-weight-bold">Notes:</label>
                        <div class="col-sm-10">
                            <input wire:model="notes" class="form-control" id="notes">
                            @error('notes')
                                <div style="font-size: 11px; color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </button>
                        @if ($contactId)
                            <button <button class="btn btn-primary" wire:click="update" wire:loading.attr="disabled">
                                {{ __('Update') }}
                            </button>
                        @else
                            <button <button class="btn btn-primary" wire:click="create" wire:loading.attr="disabled">
                                {{ __('Create') }}
                            <button>
                        @endif
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
    
    
    
    
    
    