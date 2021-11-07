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
            <h3>{{ Auth::user()->name }} --  Profile</h3> 
            <a href="/setlistgroups" class="btn btn-secondary">
            	<i class="nav-icon far fa-hand-point-left"></i>  Back</a>
        </div>
    </div>
    <form action="{{route('profile.change.password')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
      @csrf         
     
                  <div class="card-body">
                      <h4 class="card-title">
                          <h4>Change Password</h4>
                      </h4>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group mt-3">
                                  <label for="current_password">Old Password</label>
                                  <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required
                                      placeholder="Enter current password">
                                  @error('current_password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                 
                                  @enderror
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group mt-3">
                                  <label for="new_password ">New Password</label>
                                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                                      placeholder="Enter the new password">
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                 
                                  @enderror
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group mt-3">
                                  <label for="confirm_password">Confirm Password</label>
                                  <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required placeholder="Enter same password">
                                  @error('confirm_password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                 
                                  @enderror
                              </div>
                          </div>
                          <div class="d-flex justify-content-first mt-4 ml-2">
                              <button type="submit" class="btn btn-primary"
                                  id="formSubmit">change password</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>        
  </form>
</div>
    
    </div>
</div>

</div>
            </div>
        </div>
    </main>
  </div>
@endsection




