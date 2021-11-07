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
            <h3>New Setlist Group</h3> 
            <a href="/setlistgroups" class="btn btn-secondary">
            	<i class="nav-icon far fa-hand-point-left"></i>  Back</a>
        </div>
    </div>
	<form action="{{ route('setlistgroups.store') }}" method="post">
		    @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Group Name</label>
                    <input type="input" class="form-control" name="name" id="name">
                  </div>
                  <input type="hidden" id="public" name="private" value="0">
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




