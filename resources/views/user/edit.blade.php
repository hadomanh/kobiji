@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">ユーザーの編集</h3>
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
                    <label>{{ __('名前') }}:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name..." required>
                  </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label>{{ __('短い紹介') }}:</label>
                        <textarea rows="3" name="description" class="form-control" placeholder="Description..." required>{{ $user->description }}</textarea>
                    </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label>{{ __('国籍') }}:</label>
                        <select name="nationality" class="form-control" required>
                            <option value="Vietnam" {{ $user->nationality === 'Vietnam' ? 'selected' : '' }}>{{ __('ベトナム') }}</option>
                            <option value="Japan" {{ $user->nationality === 'Japan' ? 'selected' : '' }}>{{ __('日本') }}</option>
                            <option value="South Korea" {{ $user->nationality === 'South Korea' ? 'selected' : '' }}>{{ __('韓国') }}</option>
                            <option value="China" {{ $user->nationality === 'China' ? 'selected' : '' }}>{{ __('中国') }}</option>
                        </select>
                    </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label>{{ __('生年月日') }}:</label>
                        <input type="date" name="dob" value="{{ $user->dob }}" class="form-control" placeholder="DOB..." required>
                    </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>{{ __('身長') }}:</label>
                            <input type="number" name="height" min="1" class="form-control" value="{{ $user->height }}" placeholder="Name..." required>
                        </div>
                        <div class="form-group col-6">
                            <label>{{ __('単位') }}:</label>
                            <select name="heightu" class="form-control" required>
                                <option value="cm">{{ __('センチメートル') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>{{ __('体重') }}:</label>
                            <input type="number" name="weight" min="1" class="form-control" value="{{ $user->weight }}" placeholder="Name..." required>
                        </div>
                        <div class="form-group col-6">
                            <label>{{ __('単位') }}:</label>
                            <select name="weightu" class="form-control" required>
                                <option value="kg">{{ __('キログラム') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label for="uploadWrapper">アバター:</label>
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
                <button class="btn btn-primary col-6" id="submitBtn" type="submit">{{ __('登録') }}</button>
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
</div>
@endsection

@push('script')
<script>
    initUpload('#js--upload', '#uploadWrapper')
</script>
@endpush
