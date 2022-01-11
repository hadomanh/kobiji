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

            <input type="hidden" name="code" class="form-control" value="DEPRECATED" required>
            {{-- <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('コード') }}:</label>
                <input type="text" name="code" class="form-control" placeholder="Code..." required>
              </div>
            </div> --}}

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('レッスン数') }}:</label>
                <input type="number" min="1" name="session" class="form-control" placeholder="Number of sessions..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('教師名') }}:</label>
                <select name="teacher" class="form-control" required>
                  <option value="ド・マイン・ハー">{{ __('ド・マイン・ハー') }}</option>
                  <option value="グエン・ティ・トゥ・チャ">{{ __('グエン・ティ・トゥ・チャ')}}</option>
                  <option value="グエン・ティ・トゥ・ハン">{{ __('グエン・ティ・トゥ・ハン')}}</option>
                  <option value="グエン・バン・ジャン">{{ __('グエン・バン・ジャン')}}</option>
                  <option value="ダオ・ドゥック・ティエン">{{ __('ダオ・ドゥック・ティエン')}}</option>
                  <option value="チャン・ニャット・トン">{{ __('チャン・ニャット・トン')}}</option>
                  <option value="ド・クアン・ナム">{{ __('ド・クアン・ナム')}}</option>
                  <option value="グエン・ティ・ハイ・タイン">{{ __('グエン・ティ・ハイ・タイン')}}</option>
                  <option value="グエン・タイン・ハー">{{ __('グエン・タイン・ハー')}}</option>
                  <option value="ファム・チュン・ヒエウ">{{ __('ファム・チュン・ヒエウ')}}</option>
                  <option value="レ・ホアン・マイン">{{ __('レ・ホアン・マイン')}}</option>
                  <option value="ブ・ミン・ホアン・アイン">{{ __('ブ・ミン・ホアン・アイン')}}</option>
                  <option value="他">{{ __('他') }}</option>
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('対象') }}:</label>
                <select name="target" class="form-control" required>
                  <option value="俳優">{{ __('俳優')}}</option>
                  <option value="モデル">{{ __('モデル')}}</option>
                  <option value="歌手">{{ __('歌手')}}</option>
                  <option value="アイドル">{{ __('アイドル')}}</option>
                  <option value="声優">{{ __('声優')}}</option>
                  <option value="云々">{{ __('云々')}}</option>
                  <option value="他">{{ __('他')}}</option>
                </select>
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
                <input type="number" min="1" name="limit" class="form-control" placeholder="Limit..." required>
              </div>
            </div>

            {{-- DEPRECATED --}}
            <input type="hidden" name="from" class="form-control" value="2012-12-12" required>
            <input type="hidden" name="to" class="form-control" value="2012-12-12" required>
            {{-- <div class="col-sm-4">
              <div class="form-group">
                <label>{{ __('開始日') }}:</label>
                <input type="date" name="from" class="form-control" placeholder="From..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>{{ __('終了日') }}:</label>
                <input type="date" name="to" class="form-control" placeholder="To..." required>
              </div>
            </div> --}}

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('スキル数') }}:</label>
                <input type="number" min="1" id="skillAmount" class="form-control" placeholder="Skill..." required>
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
          '<label>{{ __('Type') }}:</label>' +
          '<select name="type[]" class="form-control" required>' +
          '<option value=0>{{ __('ダンス') }}</option>' +
          '<option value=1>{{ __('歌い') }}</option>' +
          '<option value=2>{{ __('演技') }}</option>' +
          '<option value=3>{{ __('楽器') }}</option>' +
          '<option value=4>{{ __('外国語') }}</option>' +
          '<option value=5>{{ __('他') }}</option>' +
          '</select>' +
          '</div>' +
          '</div>';
        skill += '<div class="col-sm-4">' +
          '<div class="form-group">' +
          '<label>{{ __('Ratio') }}:</label>' +
          '<input type="number" min="0" name="ratio[]" step="any" class="form-control" placeholder="Ratio..." required>' +
          '</div>' +
          '</div>';
        skill += '</div>';
      }
      $('#skill').html(skill);
    });
</script>
@endpush
