@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">不参加コース</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>{{ __('コース名') }}</th>
            {{-- <th>{{ __('コード') }}</th> --}}
            <th>{{ __('出席') }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $subject->name }}</td>
                    {{-- <td>{{ $subject->code }}</td> --}}
                    <td>{{ $subject->students->count() }} / {{ $subject->limit }}</td>
                    <td>
                        <a href="{{ route('subjects.student-registration-submit', $subject->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-sign-in-alt"></i> {{ __('参加') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
      <br>
      <div class="ml-5">
        @include('pagination.default', ['paginator' => $subjects])
      </div>
</div>
@endsection

