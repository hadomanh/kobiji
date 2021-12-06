@extends('layouts.admin')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">{{ __('コース詳細') }}</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
        <div class="row">
          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">{{ __('コース名') }}</span>
                <span class="info-box-number text-center text-muted mb-0">{{ $subject->name }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">{{ __('コード') }}</span>
                <span class="info-box-number text-center text-muted mb-0">{{ $subject->code }}</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">{{ __('クォータ') }}</span>
                <span class="info-box-number text-center text-muted mb-0">{{ $subject->limit }}</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">{{ __('中間/期末（割合）') }}</span>
                <span class="info-box-number text-center text-muted mb-0">{{ $subject->midterm . ' / ' . $subject->endterm }}</span>
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-12">
              <h4>{{ __('詳細') }}:</h4>
              <div class="post">
                {{ $subject->description }}
              </div>
          </div>

          <div class="col-12 mt-5">
              <h4>{{ __('学生一覧') }}:</h4>
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
                                    <th>{{ __('中間試験') }}</th>
                                    <th>{{ __('期末試験') }}</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subject->students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->pivot->midterm >= 0 ? $student->pivot->midterm : __('なし') }}</td>
                                            <td>{{ $student->pivot->endterm >= 0 ? $student->pivot->endterm : __('なし') }}</td>
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
      </div>
    </div>
  </div>

  <div class="pl-5 pb-3">
    <a href="{{ route('subjects.registration.detail', $subject->id) }}" class="btn btn-primary">学生の追加</a>
    <a href="{{ route('subjects.grading.detail', $subject->id) }}" class="btn btn-success">コースの追加</a>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection
