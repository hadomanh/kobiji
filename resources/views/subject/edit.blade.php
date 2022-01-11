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
                <select name="teacher" class="form-control" required>
                  <option value="ド・マイン・ハー" {{ $subject->teacher == 'ド・マイン・ハー' ? 'selected' : ''}}> {{ __('ド・マイン・ハー') }}</option>
                  <option value="グエン・ティ・トゥ・チャ" {{ $subject->teacher == 'グエン・ティ・トゥ・チャ' ? 'selected' : ''}}> {{ __('グエン・ティ・トゥ・チャ') }}</option>
                  <option value="グエン・ティ・トゥ・ハン" {{ $subject->teacher == 'グエン・ティ・トゥ・ハン' ? 'selected' : ''}}> {{ __('グエン・ティ・トゥ・ハン') }}</option>
                  <option value="グエン・バン・ジャン" {{ $subject->teacher == 'グエン・バン・ジャン' ? 'selected' : ''}}> {{ __('グエン・バン・ジャン') }}</option>
                  <option value="ダオ・ドゥック・ティエン" {{ $subject->teacher == 'ダオ・ドゥック・ティエン' ? 'selected' : ''}}> {{ __('ダオ・ドゥック・ティエン') }}</option>
                  <option value="チャン・ニャット・トン" {{ $subject->teacher == 'チャン・ニャット・トン' ? 'selected' : ''}}> {{ __('チャン・ニャット・トン') }}</option>
                  <option value="ド・クアン・ナム" {{ $subject->teacher == 'ド・クアン・ナム' ? 'selected' : ''}}> {{ __('ド・クアン・ナム') }}</option>
                  <option value="グエン・ティ・ハイ・タイン" {{ $subject->teacher == 'グエン・ティ・ハイ・タイン' ? 'selected' : ''}}> {{ __('グエン・ティ・ハイ・タイン') }}</option>
                  <option value="グエン・タイン・ハー" {{ $subject->teacher == 'グエン・タイン・ハー' ? 'selected' : ''}}> {{ __('グエン・タイン・ハー') }}</option>
                  <option value="ファム・チュン・ヒエウ" {{ $subject->teacher == 'ファム・チュン・ヒエウ' ? 'selected' : ''}}> {{ __('ファム・チュン・ヒエウ') }}</option>
                  <option value="レ・ホアン・マイン" {{ $subject->teacher == 'レ・ホアン・マイン' ? 'selected' : ''}}> {{ __('レ・ホアン・マイン') }}</option>
                  <option value="ブ・ミン・ホアン・アイン" {{ $subject->teacher == 'ブ・ミン・ホアン・アイン' ? 'selected' : ''}}> {{ __('ブ・ミン・ホアン・アイン') }}</option>
                  <option value="他" {{ $subject->teacher == '他' ? 'selected' : ''}}> {{ __('他') }}</option>
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('対象') }}:</label>
                <select name="target" class="form-control" required>
                  <option value="俳優" {{ $subject->target == '俳優' ? 'selected' : ''}}> {{ __('俳優')}} </option>
                  <option value="モデル" {{ $subject->target == 'モデル' ? 'selected' : ''}}> {{ __('モデル')}} </option>
                  <option value="歌手" {{ $subject->target == '歌手' ? 'selected' : ''}}> {{ __('歌手')}} </option>
                  <option value="アイドル" {{ $subject->target == 'アイドル' ? 'selected' : ''}}> {{ __('アイドル')}} </option>
                  <option value="声優" {{ $subject->target == '声優' ? 'selected' : ''}}> {{ __('声優')}} </option>
                  <option value="云々" {{ $subject->target == '云々' ? 'selected' : ''}}> {{ __('云々')}} </option>
                  <option value="他" {{ $subject->target == '他' ? 'selected' : ''}}> {{ __('他')}} </option>
                </select>
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
                <input type="number" min="1" name="limit" class="form-control" placeholder="Limit..." value="{{ $subject->limit }}" required>
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
                      <option value=0 {{ $skill->type == 0 ? "selected" : "" }}>{{ __('ダンス') }}</option>
                      <option value=1 {{ $skill->type == 1 ? "selected" : "" }}>{{ __('歌い') }}</option>
                      <option value=2 {{ $skill->type == 2 ? "selected" : "" }}>{{ __('歌演技') }}</option>
                      <option value=3 {{ $skill->type == 3 ? "selected" : "" }}>{{ __('楽器') }}</option>
                      <option value=4 {{ $skill->type == 4 ? "selected" : "" }}>{{ __('外国語') }}</option>
                      <option value=5 {{ $skill->type == 5 ? "selected" : "" }}>{{ __('他') }}</option>
                    </select>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>{{ __('Ratio') }}:</label>
                    <input type="number" min="0" step="any" name="{{ "skills[" . $loop->index . "][ratio]"}}" class="form-control" placeholder="Ratio..." value="{{ $skill->ratio }}" required>
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
