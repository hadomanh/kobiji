@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">{{ $subject->name }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        
      <form action="" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>{{ __('Choose Talent') }}</label>
                  <div class="select2-purple">
                    <select class="select2" name="students[]" multiple="multiple" data-placeholder="Select talent" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        @foreach ($students as $student)
                            <option
                            value="{{ $student->id }}"
                            {{ array_search($student->id, array_column($subject->students->toArray(), 'id')) !== false ? 'selected' : '' }}>
                            {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.form-group -->
            </div>
        </div>

        </div>

        @if($errors->any())
            <div class="text-danger text-center">Over quota limit</b></div>
        @endif

        <div class="row">
            <div class="col-3"></div>
            <button class="btn btn-outline-warning col-6" type="submit">{{ __('Update') }}</button>
        </div>
        <br>
        <div class="row">
            <div class="col-3"></div>
            <a class="btn btn-outline-secondary col-6" href="{{ url()->previous() }}">{{ __('キャンセル') }}</a>
        </div>
        <br>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection

@push('script')
@endpush
