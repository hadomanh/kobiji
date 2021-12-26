@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">コースの追加</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('subjects.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('コース名') }}:</label>
                <input type="text" name="name" class="form-control" placeholder="Name..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('コード') }}:</label>
                <input type="text" name="code" class="form-control" placeholder="Code..." required>
              </div>
              
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('レッスン数') }}:</label>
                <input type="text" name="session" class="form-control" placeholder="Number of sessions..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('教師名') }}:</label>
                <input type="text" name="teacher" class="form-control" placeholder="Teacher..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('対象') }}:</label>
                <input type="text" name="target" class="form-control" placeholder="Target..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('詳細') }}:</label>
                <input type="text" name="description" class="form-control" placeholder="Description..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('参加者の最大数') }}:</label>
                <input type="number" name="limit" class="form-control" placeholder="Limit..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('開始日') }}:</label>
                <input type="date" name="from" class="form-control" placeholder="From..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('終了日') }}:</label>
                <input type="date" name="to" class="form-control" placeholder="To..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Number of skill') }}:</label>
                <input type="number" id="skillAmount" class="form-control" placeholder="Skill..." required>
              </div>
            </div>

            <div id="skill" class="col-sm-12">
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

@push('script')
<script>
    $('#skillAmount').change(function () {
      var skillAmount = $(this).val();
      var skill = '';
      for (var i = 0; i < skillAmount; i++) {
        skill += '<div class="row">';
        skill += '<div class="col-sm-4">' +
          '<div class="form-group">' +
          '<label>{{ __('Skill') }}:</label>' +
          '<input type="text" name="skill[]" class="form-control" placeholder="Skill..." required>' +
          '</div>' +
          '</div>';
        skill += '<div class="col-sm-4">' +
          '<div class="form-group">' +
          '<label>{{ __('Ratio') }}:</label>' +
          '<input type="number" name="ratio[]" class="form-control" placeholder="Ratio..." required>' +
          '</div>' +
          '</div>';
        skill += '</div>';
      }
      $('#skill').html(skill);
    });
</script>
@endpush
