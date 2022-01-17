@extends('layouts.admin')

@section('content')
<style>
.select2-container--default .select2-selection--single {
    padding: 0.15rem 0.75rem;
}
</style>
<div class="container">
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">ユーザーの追加</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('名前') }}:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name..." required>
                  </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('メール') }}:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email..." required>
                  </div>
                </div>


                <div class="offset-sm-4 col-sm-4">
                  <div class="form-group">
                      <label>{{ __('短い紹介') }}:</label>
                      <textarea rows="3" name="description" class="form-control" placeholder="Description..." required></textarea>
                  </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label>{{ __('国籍') }}:</label>
                        <select name="nationality" class="form-control" required>
                            <option value="Vietnam">{{ __('ベトナム') }}</option>
                            <option value="Japan">{{ __('日本') }}</option>
                            <option value="South Korea">{{ __('韓国') }}</option>
                            <option value="China">{{ __('中国') }}</option>
                        </select>
                    </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label>{{ __('生年月日') }}:</label>
                        <input type="date" name="dob" class="form-control" placeholder="DOB..." required>
                    </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>{{ __('身長') }}:</label>
                            <input type="number" name="height" min="1" class="form-control" placeholder="Name..." required>
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
                            <input type="number" name="weight" min="1" class="form-control" placeholder="Name..." required>
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
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('パスワード') }}:</label>
                    <input type="password" id="password-first" name="password" class="form-control" placeholder="Password..." required>
                  </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>{{ __('パスワード（確認）') }}:</label>
                    <input type="password" id="password-second" class="form-control" placeholder="Confirm Password..." required>
                  </div>
                </div>

                <div class="offset-sm-4 col-sm-4">
                    <div class="form-group">
                        <label>役割</label>
                        <select class="form-control select2 select2-danger" name="role" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option selected="selected" value="student">学生</option>
                            @if (Auth::user()->role == 'admin')
                              <option value="admin">管理者</option>
                              <option value="manager">マネジャー</option>
                            @endif
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>

            </div>

            @if($errors->any())

                <div class="text-danger text-center">Invalid Email: <b>{{ $errors->first('email') }}</b></div>
            @endif

            <div class="row">
                <div class="col-3"></div>
                <button class="btn btn-primary col-6" id="submitBtn" type="submit" disabled>{{ __('登録') }}</button>
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
    function checkPasswordMatch() {
        const password = $("#password-first").val();
        const confirmPassword = $("#password-second").val();

        const condition1 = password.length >= 8 && password.length <= 30;
        const condition2 = password === confirmPassword
        const condition3 = $.trim(password).length > 0;
        console.log(condition1, condition2, condition3);

        if (condition1 && condition2 && condition3)
            $("#submitBtn").prop('disabled', false)
        else
            $("#submitBtn").prop('disabled', true)
    }


    $(document).ready(function(){
        $("#password-first").keyup(checkPasswordMatch);
        $("#password-second").keyup(checkPasswordMatch);
    });
</script>
@endpush
