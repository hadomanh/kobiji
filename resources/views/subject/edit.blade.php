@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title"> コースの編集 </h3>
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
                <label>{{ __('コース名') }}:</label>
                <input type="text" name="name" class="form-control" placeholder="Name..." value="{{ $subject->name }}" required>
              </div>
            </div>

            <input type="hidden" name="code" class="form-control" value="{{ $subject->code }}" required>
            {{-- <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('コード') }}:</label>
                <input type="text" name="code" class="form-control" placeholder="Code..." value="{{ $subject->code }}" required>
              </div>
            </div> --}}

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('レッスン数') }}:</label>
                <input type="text" name="session" class="form-control" placeholder="Number of sessions..." value="{{ $subject->session }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('教師名') }}:</label>
                <input type="text" name="teacher" class="form-control" placeholder="Teacher..." value="{{ $subject->teacher }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('対象') }}:</label>
                <input type="text" name="target" class="form-control" placeholder="Target..." value="{{ $subject->target }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('詳細') }}:</label>
                <input type="text" name="description" class="form-control" value="{{ $subject->description }}" placeholder="Description..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('参加者の最大数') }}:</label>
                <input type="number" name="limit" class="form-control" placeholder="Limit..." value="{{ $subject->limit }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('開始日') }}:</label>
                <input type="date" name="from" class="form-control" value="{{ date('Y-m-d', strtotime($subject->from)) }}" placeholder="From..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('終了日') }}:</label>
                <input type="date" name="to" class="form-control" value="{{ date('Y-m-d', strtotime($subject->to)) }}" placeholder="To..." required>
              </div>
            </div>

            <input type="hidden" name="midterm" class="form-control" placeholder="Midterm..." value="{{ $subject->midterm }}" required>
            <input type="hidden" name="endterm" class="form-control" placeholder="Endterm..." value="{{ $subject->endterm }}" required>

            {{-- <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('中間割合') }}:</label>
                <input type="text" name="midterm" class="form-control" placeholder="Midterm..." value="{{ $subject->midterm }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('期末割合') }}:</label>
                <input type="text" name="endterm" class="form-control" placeholder="Endterm..." value="{{ $subject->endterm }}" required>
              </div>
            </div> --}}

            <div class="col-sm-12">
              @foreach ($subject->skills as $skill)
                <div class="row">

                  <input type="hidden" name="{{ "skills[" . $loop->index . "][id]"}}" value="{{ $skill->id }}" required>

                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>{{ __('Skill') }}:</label>
                    <input type="text" name="{{ "skills[" . $loop->index . "][name]"}}" class="form-control" placeholder="Skill..." value="{{ $skill->name }}" required>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>{{ __('Type') }}:</label>
                    <select name="{{ "skills[" . $loop->index . "][type]"}}" class="form-control" required>
                      <option value=0 {{ $skill->type == 0 ? "selected" : "" }}>{{ __('Type 0') }}</option>
                      <option value=1 {{ $skill->type == 1 ? "selected" : "" }}>{{ __('Type 1') }}</option>
                      <option value=2 {{ $skill->type == 2 ? "selected" : "" }}>{{ __('Type 2') }}</option>
                      <option value=3 {{ $skill->type == 3 ? "selected" : "" }}>{{ __('Type 3') }}</option>
                      <option value=4 {{ $skill->type == 4 ? "selected" : "" }}>{{ __('Type 4') }}</option>
                      <option value=5 {{ $skill->type == 5 ? "selected" : "" }}>{{ __('Type 5') }}</option>
                      <option value=6 {{ $skill->type == 6 ? "selected" : "" }}>{{ __('Type 6') }}</option>
                      <option value=7 {{ $skill->type == 7 ? "selected" : "" }}>{{ __('Type 7') }}</option>
                      <option value=8 {{ $skill->type == 8 ? "selected" : "" }}>{{ __('Type 8') }}</option>
                      <option value=9 {{ $skill->type == 9 ? "selected" : "" }}>{{ __('Type 9') }}</option>
                    </select>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>{{ __('Ratio') }}:</label>
                    <input type="number" step="any" name="{{ "skills[" . $loop->index . "][ratio]"}}" class="form-control" placeholder="Ratio..." value="{{ $skill->ratio }}" required>
                    </div>
                  </div>

                </div>
              @endforeach
            </div>

        </div>

        </div>

        <div class="row">
            <div class="col-3"></div>
            <button class="btn btn-outline-warning col-6" type="submit">{{ __('登録') }}</button>
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
