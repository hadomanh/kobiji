@extends('layouts.admin')

@section('content')

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{ __('Confirm delete') }}?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
        <button id="deleteConfirm" type="button" class="btn btn-danger">{{ __('Delete permanently') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">{{ __('コース詳細') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">{{ __('学生一覧') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">{{ __('レッスン') }}</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('コース名') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->name }}</span>
                    </div>
                  </div>
                </div>
                
                {{-- <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('コード') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->code }}</span>
                    </div>
                  </div>
                </div> --}}
      
                <div class="col-12 col-sm-6">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('参加者の最大数') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->limit }}</span>
                    </div>
                  </div>
                </div>
      
                {{-- <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('中間/期末（割合）') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->midterm . ' / ' . $subject->endterm }}</span>
                    </div>
                  </div>
                </div> --}}

                <div class="col-12">
                  <h4>{{ __('詳細') }}:</h4>
                  <div class="post">
                    {{ $subject->description }}
                  </div>
                </div>
      
                <div class="col-12 mt-5">
                    <h4>{{ __('スキル') }}:</h4>
                    <div class="post">
                      <ul class="list-group">
                        @foreach ($subject->skills as $skill)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          {{ $skill->name }}
                          <span class="badge badge-primary badge-pill">{{ $skill->ratio }}</span>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                </div>
      
              </div>
            </div>

            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
              <div class="col-12">
              <div class="post">
                  <div class="row">
                      <div class="col-12">
                        <div class="card">
                          
                          @if ($subject->students->count() > 0)
                          <div class="card-body table-responsive p-0">
                              <table class="table table-hover text-nowrap">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>{{ __('名前') }}</th>
                                    <th>{{ __('メール') }}</th>
                                    @foreach ($subject->skills as $skill)
                                      <th>{{ $skill->name }}</th>
                                    @endforeach
                                    <th>{{ __('最終成績') }}</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subject->students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            @foreach ($subject->skills as $skill)
                                              @foreach ($skill->students as $skill_student)
                                                @if ($skill_student->id == $student->id)
                                                  <td>{{ $skill_student->pivot->grade >= 0 ? $skill_student->pivot->grade : __('なし') }}</td>
                                                @endif
                                              @endforeach
                                            @endforeach
                                            <td>{{ $student->getAverageBySubject($subject->id) }}</td>
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

            <div class="col-12">
              <a href="{{ route('subjects.registration.detail', $subject->id) }}" class="btn btn-primary">学生の追加</a>
              <a href="{{ route('subjects.grading.detail', $subject->id) }}" class="btn btn-success">成績の追加</a>
            </div>
              
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings">
              <div class="col-12">
                <div class="post">
                    <div class="row">
  
                        <div class="col-12">
                          <div class="card">
                            
                            @if ($subject->lessons->count() > 0)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>{{ __('レッスン名') }}</th>
                                      <th>{{ __('開催日') }}</th>
                                      <th>{{ __('開始時間') }}</th>
                                      <th>{{ __('終了時間') }}</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($subject->lessons as $lesson)
                                          <tr>
                                              <td>{{ $loop->index + 1 }}</td>
                                              <td>{{ $lesson->title }}</td>
                                              <td>{{ $lesson->date }}</td>
                                              <td>{{ $lesson->from }}</td>
                                              <td>{{ $lesson->to }}</td>
                                              <td>
                                                <a href="{{ route('lessons.attendance.detail', $lesson->id) }}" class="btn btn-outline-primary">View</a>
                                                <div class="btn btn-outline-danger deleteItemBtn" data-url="{{ route('api.lessons.delete', $lesson->id) }}" data-toggle="modal" data-target="#modal-default">
                                                  {{ __('Delete') }}
                                                </div>
                                              </td>
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
            
            <div class="col-12">
              <a href="{{ route('lessons.create', $subject->id) }}" class="btn btn-warning">レッスン登録</a>
            </div>
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
</div>





@endsection
