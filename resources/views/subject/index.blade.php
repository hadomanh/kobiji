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

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Subject</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Code') }}</th>
            <th>{{ __('説明') }}</th>
            <th class="text-center">{{ __('セッション数') }}</th>
            <th>{{ __('教師') }}</th>
            <th class="text-center">{{ __('Enrollment') }}</th>
            <th>{{ __('始まる') }}</th>
            <th>{{ __('完了') }}</th>
            <th>{{ __('アクション') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->description }}</td>
                    <td class="text-center">{{ $subject->session }}</td>
                    <td>{{ $subject->teacher }}</td>
                    <td class="text-center">{{ $subject->students->count() }} / {{ $subject->limit }}</td>
                    <td>{{ date('d M, Y', strtotime($subject->from)) }}</td>
                    <td>{{ date('d M, Y', strtotime($subject->to)) }}</td>
                    <td>
                      <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-outline-primary">
                          <i class="fas fa-eye"></i> {{ __('View') }}
                      </a>
                      @if (Auth::user()->role == 'admin')
                        <a class="btn btn-outline-warning" href="{{ route('subjects.edit', $subject->id) }}">
                          <i class="fas fa-edit"></i> {{ __('Edit') }}
                        </a>
                        <div class="btn btn-outline-danger deleteItemBtn" data-url="{{ route('api.subjects.delete', $subject->id) }}" data-toggle="modal" data-target="#modal-default">
                          <i class="fas fa-trash"></i> {{ __('Delete') }}
                        </div>
                      @endif
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

