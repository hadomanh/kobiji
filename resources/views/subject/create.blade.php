@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Create Subject</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('subjects.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Name') }}:</label>
                <input type="text" name="name" class="form-control" placeholder="Name..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Code') }}:</label>
                <input type="text" name="code" class="form-control" placeholder="Code..." required>
              </div>
              
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Number of sessions') }}:</label>
                <input type="text" name="session" class="form-control" placeholder="'Number of sessions..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Teacher') }}:</label>
                <input type="text" name="teacher" class="form-control" placeholder="Teacher..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Description') }}:</label>
                <input type="text" name="description" class="form-control" placeholder="Description..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Limit') }}:</label>
                <input type="number" name="limit" class="form-control" placeholder="Limit..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('From') }}:</label>
                <input type="date" name="from" class="form-control" placeholder="From..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('To') }}:</label>
                <input type="date" name="to" class="form-control" placeholder="To..." required>
              </div>
            </div>

        </div>

        </div>

        <div class="row">
            <div class="col-3"></div>
            <button class="btn btn-primary col-6" type="submit">{{ __('Submit') }}</button>
        </div>
        <br>
        <div class="row">
            <div class="col-3"></div>
            <a class="btn btn-outline-secondary col-6" href="{{ route('subjects.index') }}">{{ __('Cancel') }}</a>
        </div>
        <br>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
