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
            <h3>New Setlist</h3> 
            <a href="/setlistgroups" class="btn btn-secondary">
            	<i class="nav-icon far fa-hand-point-left"></i>  Back</a>
        </div>
    </div>
	<form action="{{ route('setlists.store') }}" method="post">
		    @csrf
                <div class="card-body">
                	<input type="hidden" id="id" name="groupId" value="{{ $id }}">

                  <div class="form-group">
                    <label for="name">Setlist Name</label>
                    <input type="input" class="form-control" name="name" id="name">
                  </div>
                  <input type="hidden" name="private" id="public" value="0" /> 
                 
                                <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Songs</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Title</th>
                      <th>Artist</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@forelse ($songs as $song)
                    	<tr>
                    		<td>
                    			<input type="checkbox" name="songlist[]" value="{{ $song->id }}"/>
                            </td>
                    		<td>{{ $song->name }}</td>
							<td>{{ $song->artist }}</td>
							<td>{{ $song->status_id }}</td>
						</tr>
                    @empty
			            <tr>
			                <td colspan="3">No Songs found.</td>
			            </tr>
			        @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
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




