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
      <h3 class="card-title">コース</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>{{ __('名前') }}</th>
            <th>{{ __('メール') }}</th>
            <th>{{ __('ステータス') }}</th>
            <th>{{ __('アクション') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    @if ($user->active)
                        <td class="text-success">{{ __('アクティブ') }}</td>
                    @else
                        <td class="text-danger">{{ __('非アクティブ') }}</td>
                    @endif
                    <td>
                      <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-primary">
                          <i class="fas fa-eye"></i> {{ __('閲覧') }}
                      </a>
                      @if ($user->id !== Auth::user()->id)
                          @if ($user->active)
                            <a href="{{ route('users.toggle', $user->id) }}" class="btn btn-outline-danger">非アクティブ</a>
                          @else
                            <a href="{{ route('users.toggle', $user->id) }}" class="btn btn-outline-success">アクティブ</a>
                          @endif
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
        @include('pagination.default', ['paginator' => $users])
      </div>
</div>
@endsection

