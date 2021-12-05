@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Edit Subject</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('subjects.update', $subject->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Name') }}:</label>
                <input type="text" name="name" class="form-control" placeholder="Name..." value="{{ $subject->name }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Code') }}:</label>
                <input type="text" name="code" class="form-control" placeholder="Code..." value="{{ $subject->code }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Number of sessions') }}:</label>
                <input type="text" name="session" class="form-control" placeholder="'Number of sessions..." value="{{ $subject->session }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Teacher') }}:</label>
                <input type="text" name="teacher" class="form-control" placeholder="Teacher..." value="{{ $subject->teacher }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Target') }}:</label>
                <input type="text" name="target" class="form-control" placeholder="Target..." value="{{ $subject->target }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Description') }}:</label>
                <input type="text" name="description" class="form-control" value="{{ $subject->description }}" placeholder="Description..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Limit') }}:</label>
                <input type="number" name="limit" class="form-control" placeholder="Limit..." value="{{ $subject->limit }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('From') }}:</label>
                <input type="date" name="from" class="form-control" value="{{ date('Y-m-d', strtotime($subject->from)) }}" placeholder="From..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('To') }}:</label>
                <input type="date" name="to" class="form-control" value="{{ date('Y-m-d', strtotime($subject->to)) }}" placeholder="To..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Midterm Ratio') }}:</label>
                <input type="text" name="midterm" class="form-control" placeholder="Midterm..." value="{{ $subject->midterm }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Endterm Ratio') }}:</label>
                <input type="text" name="endterm" class="form-control" placeholder="Endterm..." value="{{ $subject->endterm }}" required>
              </div>
            </div>

        </div>

        </div>

        <div class="row">
            <div class="col-3"></div>
            <button class="btn btn-outline-warning col-6" type="submit">{{ __('Update') }}</button>
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
