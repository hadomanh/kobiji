@extends('layouts.admin')

@section('content')

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ __('Lesson Grading') }} <b>{{ $lesson->title }}</b></h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12">
                    <div class="post">
                        <div class="row">
                            <div class="col-12">
                            <form action="{{ route('lessons.attendance.submit', $lesson->id) }}" method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                              <div class="card">
                                
                                @if ($lesson->students->count() > 0)
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>{{ __('Name') }}</th>
                                          <th>{{ __('Email') }}</th>
                                          <th>{{ __('Attendance') }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($lesson->students as $student)
                                              <tr>
                                                    <input type="hidden" class="form-control" value="{{ $student->id }}" name="{{"students[" . $loop->index . "][id]"}}" >
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>
                                                      <select class="form-control" name="{{"students[" . $loop->index . "][status]"}}">
                                                        <option class="text-center" {{ $student->pivot->status === 'PRESENT' ? 'selected' : '' }} value="PRESENT">PRESENT</option>
                                                        <option class="text-center" {{ $student->pivot->status === 'LATE' ? 'selected' : '' }} value="LATE">LATE</option>
                                                        <option class="text-center" {{ $student->pivot->status === 'ABSENCE' ? 'selected' : '' }} value="ABSENCE">ABSENCE</option>
                                                        <option class="text-center" {{ $student->pivot->status === 'UNAUTHORIZED ABSENCE' ? 'selected' : '' }} value="UNAUTHORIZED ABSENCE">UNAUTHORIZED ABSENCE</option>
                                                      </select>
                                                    </td>
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
                              <div class="container">
                                  <button class="btn btn-primary" type="submit" >Submit</button>
                              </div>
                            </form>
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
