@extends('layouts.master')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
<div class="card">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between">
            <h3>{{ getSetlistGroupName($setlist->song_list_group_id)->name }}</h3> 
            <a href="/setlistgroups" class="btn btn-primary">Back</a>
        </div>
    </div>
    <form action="{{ route('setlists.storecopy') }}" method="post">
        @csrf
                <div class="card-body">
                	<input type="hidden" id="groupId" name="groupId" value="{{ $setlist->song_list_group_id }}">
                    <input type="hidden" id="setlistId" name="setlistId" value="{{ $setlist->id }}">
                  <div class="form-group">
                    <label for="name">Setlist Name</label>
                    <input type="input" readonly class="form-control-plaintext" value="{{ $setlist->name }}" name="name" id="name">
                  </div>
                  <div class="form-group">
                    <label for="newname">New Setlist Name</label>
                    <input type="input" class="form-control" name="newname" id="newname">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form>
</div>
    
    </div>
</div>

</div>
            </div>
        </div>
    </main>
@endsection




