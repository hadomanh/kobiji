@extends('layouts.admin')

@section('content')
<style>
.select2-container--default .select2-selection--single {
    padding: 0.15rem 0.75rem;
}
</style>
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Create User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('Name') }}:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name..." required>
                  </div>
                </div>
    
                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('Email') }}:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email..." required>
                  </div>
                </div>
    
                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('Password') }}:</label>
                    <input type="password" id="password-first" name="password" class="form-control" placeholder="Password..." required>
                  </div>
                </div>
    
                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('Confirm Password') }}:</label>
                    <input type="password" id="password-second" class="form-control" placeholder="Confirm Password..." required>
                  </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control select2 select2-danger" name="role" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option selected="selected" value="student">Student</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                
            </div>

            @if($errors->any())
            
                <div class="text-danger text-center">Invalid Email: <b>{{ $errors->first('email') }}</b></div>
            @endif
    
            <div class="row">
                <div class="col-3"></div>
                <button class="btn btn-primary col-6" id="submitBtn" type="submit" disabled>{{ __('Submit') }}</button>
            </div>
            <br>
            <div class="row">
                <div class="col-3"></div>
                <a class="btn btn-outline-secondary col-6" href="{{ route('users.index', 'student') }}">{{ __('Cancel') }}</a>
            </div>
            <br>
    
          </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection

@push('script')
<script>
    function checkPasswordMatch() {
        const password = $("#password-first").val();
        const confirmPassword = $("#password-second").val();

        const condition1 = password.length >= 8 && password.length <= 30;
        const condition2 = password === confirmPassword
        const condition3 = $.trim(password).length > 0;
        console.log(condition1, condition2, condition3);

        if (condition1 && condition2 && condition3)
            $("#submitBtn").prop('disabled', false)
        else
            $("#submitBtn").prop('disabled', true)
    }


    $(document).ready(function(){
        $("#password-first").keyup(checkPasswordMatch);
        $("#password-second").keyup(checkPasswordMatch);
    });
</script>
@endpush
