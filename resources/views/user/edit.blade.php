@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Create User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('Name') }}:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name..." required>
                  </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label for="uploadWrapper">Avatar:</label>
                        <div id="uploadWrapper">
                            <label class="upload-trigger" for="js--upload">
                                <div class="uploader">
                                    <img src="{{ asset($user->avatar) }}"  
                                        data-target="#js--upload" 
                                        class="img-fluid upload-preview" 
                                        data-content="uploadPreview">
                                </div>
                            </label>
                    
                            <input type="file" name="avatar" class="d-none" id="js--upload">
                        </div>
                    </div>
                </div>
                
            </div>
    
            <div class="row">
                <div class="col-3"></div>
                <button class="btn btn-primary col-6" id="submitBtn" type="submit">{{ __('Submit') }}</button>
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
    initUpload('#js--upload', '#uploadWrapper')
</script>
@endpush
