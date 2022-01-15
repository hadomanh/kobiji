@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="{{ asset($user->avatar) }}"
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $user->name }}</h3>

            <p class="text-muted text-center">{{ $user->email }}</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>平均</b> <a class="float-right">{{ number_format($average, 2) }}</a>
              </li>
              <li class="list-group-item">
                <b>ダンス</b> <a class="float-right">{{ number_format($typeAverage[0], 2) }}</a>
              </li>
              <li class="list-group-item">
                <b>歌い</b> <a class="float-right">{{ number_format($typeAverage[1], 2) }}</a>
              </li>
              <li class="list-group-item">
                <b>歌演技</b> <a class="float-right">{{ number_format($typeAverage[2], 2) }}</a>
              </li>
              <li class="list-group-item">
                <b>楽器</b> <a class="float-right">{{ number_format($typeAverage[3], 2) }}</a>
              </li>
              <li class="list-group-item">
                <b>外国語</b> <a class="float-right">{{ number_format($typeAverage[4], 2) }}</a>
              </li>
              <li class="list-group-item">
                <b>他</b> <a class="float-right">{{ number_format($typeAverage[5], 2) }}</a>
              </li>
              <li class="list-group-item">
                <b>ステータス</b>
                @if ($user->active)
                    <a class="float-right text-success">{{ __('アクティブ') }}</a>
                @else
                    <a class="float-right text-danger">{{ __('非アクティブ') }}</a>
                @endif
              </li>
            </ul>

            <a href="{{ route('home')}}" class="btn btn-outline-secondary btn-block"><b>{{ __('戻る') }}</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">{{ __('コース一覧') }}</a></li>
              <li id="timelineBtn" class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">カレンダー</a></li>
              {{-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> --}}
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body" style="height: 100vh">
            <div class="tab-content">
              <div class="active tab-pane row" id="activity">
                <div class="col-12">
                    <div class="post">
                        <div class="row">
                            <div class="col-12">
                              <div class="card">

                                @if ($user->subjects->count() > 0)
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>{{ __('コース名') }}</th>
                                          {{-- <th>{{ __('コード') }}</th> --}}
                                          {{-- <th class="text-center">{{ __('中間テスト') }}</th> --}}
                                          {{-- <th class="text-center">{{ __('期末テスト') }}</th> --}}
                                          <th class="text-center">{{ __('最終成績') }}</th>
                                          <th>{{ __('アクション') }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($user->subjects as $subject)
                                              <tr>
                                                  <td>{{ $loop->index + 1 }}</td>
                                                  <td>{{ $subject->name }}</td>
                                                  {{-- <td>{{ $subject->code }}</td> --}}
                                                  {{-- <td class="text-center">{{ $subject->pivot->midterm ?? __('なし') }}</td> --}}
                                                  {{-- <td class="text-center">{{ $subject->pivot->endterm ?? __('なし') }}</td> --}}
                                                  {{-- @if ($subject->pivot->midterm > -1 && $subject->pivot->endterm > -1)
                                                    <td class="text-center">{{ $subject->pivot->midterm * $subject->midterm + $subject->pivot->endterm * $subject->endterm }}</td>
                                                  @else
                                                    <td class="text-center">{{ __('なし') }}</td>
                                                  @endif --}}
                                                  <td class="text-center">{{ number_format($user->getAverageBySubject($subject->id), 2) }}</td>
                                                  <td><a href="{{ route('subjects.student-show', $subject->id) }}" class="btn btn-outline-primary">見る</a></td>

                                              </tr>

                                          @endforeach

                                      </tbody>
                                    </table>
                                  </div>
                                @else
                                    <p class="text-center">データがありません</p>
                                @endif
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                          </div>
                          <!-- /.row -->
                    </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">

                <div id="calendar"></div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName2" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@push('script')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('bower_components/admin-lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/fullcalendar/main.js') }}"></script>
<script type="text/javascript">

  let timelineBtnClicked = false;

  $('#timelineBtn').click(function(){

    if (timelineBtnClicked) {
      return
    }

    const timetable = {!! $timetable !!}
    let events = []
    timetable.forEach(element => {
        events.push({
            title: element.title,
            start: new Date(element.from),
            end: new Date(element.to),
            backgroundColor: element.backgroundColor,
            borderColor: element.borderColor,
            allDay: false,

        })
    });
    $(function () {

        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

        var Calendar = FullCalendar.Calendar;

        var calendarEl = document.getElementById("calendar");

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            themeSystem: "bootstrap",
            events,
        });

        calendar.render();
    });
    timelineBtnClicked = true;
  });


</script>

@endpush
