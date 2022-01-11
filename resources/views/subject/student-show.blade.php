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
      
                <div class="col-12 col-sm-6">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('参加者の最大数') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->limit }}</span>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <h4>{{ __('詳細') }}:</h4>
                  <div class="post">
                    {{ $subject->description }}
                  </div>
                </div>

                <div class="col-12 mt-5">
                  <h4>{{ __('Average') }}:</h4>
                  <div class="post">
                    {{ number_format(auth()->user()->getAverageBySubject($subject->id), 2) }}
                  </div>
                </div>
      
                <div class="col-12 mt-5">
                    <h4>{{ __('スキル') }}:</h4>
                    <div class="post">

                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Skill') }}</th>
                                    <th>{{ __('Ratio') }}</th>
                                    <th>{{ __('Grade') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subject->skills as $skill)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $skill->name }}</td>
                                        <td>{{ number_format($skill->ratio, 2) }}</td>
                                        @foreach ($skill->students as $student)
                                            @if ($student->id == auth()->user()->id)
                                                <td>{{ $student->pivot->grade }}</td>
                                                @break
                                            @endif
                                        @endforeach
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>

                      
                    </div>
                </div>
      
              </div>
            </div>

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
