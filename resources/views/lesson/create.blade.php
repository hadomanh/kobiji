@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Create lesson</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('lessons.store', $subject->id) }}" method="POST" autocomplete="off">
        @csrf
        <div class="row">

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('レッスン名') }}:</label>
                <input type="text" name="title" class="form-control" placeholder="Title..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('開催日') }}:</label>
                <input type="date" name="date" class="form-control" placeholder="Date..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('開始時間') }}:</label>
                <input type="time" name="from" class="form-control" placeholder="From..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('終了時間') }}:</label>
                <input type="time" name="to" class="form-control" placeholder="To..." required>
              </div>
            </div>

        </div>

        </div>

        <div class="row">
            <div class="col-3"></div>
            <button class="btn btn-primary col-6" type="submit">{{ __('登録') }}</button>
        </div>
        <br>
        <div class="row">
            <div class="col-3"></div>
            <a class="btn btn-outline-secondary col-6" href="{{ route('subjects.index') }}">{{ __('キャンセル') }}</a>
        </div>
        <br>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
