<div>
    <div class="card">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between">
                <h3>Songs</h3> 


                @foreach($statuses as $status)
                    <a wire:click.prevent="showStatus({{ $status->value }})" 
                        href="#" class="btn btn-{{ $status->style }}">{{ $status->name }} 
                    <span class="badge badge-light">{{ getStatusCount($status->value) }}</span>
                </a>
                @endforeach

                <a wire:click.prevent="createShowModal" href="#" class="btn btn-outline-dark">New Song</a>
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
                    <th scope="col" wire:click="sortByColumn('artist')">
                        Artist
                        @if ($sortColumn == 'artist')
                            <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                        @endif
                    </th>
                    <th scope="col" wire:click="sortByColumn('status_id')">
                        Status
                        @if ($sortColumn == 'status_id')
                            <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                        @endif
                    </th>
                    <th scope="col" wire:click="sortByColumn('created_by')">
                        Created By
                        @if ($sortColumn == 'created_by')
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
                <td>{{ $item->artist }}</td>
                <td><span class="badge badge-{{ $item->status->style }}">{{ $item->status->name }}</span></td>
                <td>{{ getUsername($item->created_by) }}</td>
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
                    <td colspan="3">No Songs found.</td>
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
                            <h5 class="modal-title">{{ $songId ? 'Edit Song' : 'Add New Song' }}</h5>
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
                            <label for="artist" class="col-sm-2 col-form-label font-weight-bold">Artist:</label>
                            <div class="col-sm-10">
                                <input wire:model="artist" class="form-control" id="artist">
                                @error('artist')
                                    <div style="font-size: 11px; color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="artist" class="col-sm-2 col-form-label font-weight-bold">Status:</label>
                            <div class="col-sm-10">
                                <select wire:model="status_id" class="form-control">
                                    <option value="">-- choose status --</option>
                                    @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div style="font-size: 11px; color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="time" class="col-sm-2 col-form-label font-weight-bold">Time:</label>
                            <div class="col-sm-10">
                                <input wire:model="time" class="form-control" id="time">
                                @error('time')
                                    <div style="font-size: 11px; color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="artist" class="col-sm-2 col-form-label font-weight-bold">Singer:</label>
                            <div class="col-sm-10">
                                <select wire:model="singer" class="form-control">
                                    <option value="">-- choose singer --</option>
                                        @foreach ($bands as $band)
                                            <option value="{{ $band->id }}">{{ $band->name }}</option>
                                        @endforeach
                                </select>
                                @error('singer')
                                    <div style="font-size: 11px; color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="solo" class="col-sm-2 col-form-label font-weight-bold">Solo:</label>
                            <div class="col-sm-10">
                                <select wire:model="solo" class="form-control">
                                    <option value="">-- choose soloist --</option>
                                        @foreach ($bands as $band)
                                            <option value="{{ $band->id }}">{{ $band->name }}</option>
                                        @endforeach
                                </select>
                                @error('solo')
                                    <div style="font-size: 11px; color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="solo" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" wire:model="keyboard" id="keyboard" value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Keyboard</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" wire:model="acoustic" id="acoustic" value="1">
                                    <label class="form-check-label" for="inlineCheckbox2">Acoustic</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="time" class="col-sm-2 col-form-label font-weight-bold">Notes:</label>
                            <div class="col-sm-10">
                                <input wire:model="notes" class="form-control" id="time">
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
                            @if ($songId)
                                <button <button class="btn btn-primary" wire:click="update" wire:loading.attr="disabled">
                                    {{ __('Update') }}
                                </button>
                            @else
                                <button class="btn btn-primary" wire:click="create" wire:loading.attr="disabled">
                                    {{ __('Create') }}
                                </button>
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
    
    
    
    
    
    