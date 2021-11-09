@extends('layouts.admin')

@section('content')

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ __('Subject Detail') }}</h3>

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
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('Name') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->name }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('Code') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->code }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">{{ __('Quota') }}</span>
                      <span class="info-box-number text-center text-muted mb-0">{{ $subject->limit }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <h4>{{ __('Description') }}:</h4>
                    <div class="post">
                      {{ $subject->description }}
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <h4>{{ __('Students') }}:</h4>
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
                                          <th>{{ __('Name') }}</th>
                                          <th>{{ __('Email') }}</th>
                                          <th>{{ __('Midterm') }}</th>
                                          <th>{{ __('Endterm') }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($subject->students as $student)
                                              <tr>
                                                  <td>{{ $loop->index + 1 }}</td>
                                                  <td>{{ $student->name }}</td>
                                                  <td>{{ $student->email }}</td>
                                                  <td>{{ $student->midterm ?? 'Not updated yet' }}</td>
                                                  <td>{{ $student->endterm ?? 'Not updated yet' }}</td>
                                              </tr>
                                              
                                          @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                @else
                                    <p class="text-center">Nothing to display</p>
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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

@endsection
