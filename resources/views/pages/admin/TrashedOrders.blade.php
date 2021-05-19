@extends('layouts.app')

@section('template_title')
    {!!trans('Deleted Orders')!!}

@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: .15em;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {!!trans('usersmanagement.show-deleted-users')!!}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('usersmanagement.buttons.back-to-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(count($order) === 0)

                            <tr>
                                <p class="text-center margin-half">
                                    {!! trans('usersmanagement.no-records') !!}
                                </p>
                            </tr>

                        @else

                            <div class="table-responsive users-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="user_count">
                                        {{ trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $errors->count()]) }}
                                    </caption>
                                   <thead class="thead">
                                    <tr>
                                        <th>{!! trans('id') !!}</th>
                                        <th class="hidden-lg hidden-md hidden-sm">{!! trans('name') !!}</th>
                                        <th class="hidden-lg hidden-md hidden-sm">{!! trans('email') !!}</th>
                                        <th class="hidden-lg hidden-md hidden-sm">{!! trans('phone') !!}</th>
                                        <th class="hidden-xs">{!! trans('category') !!}</th>
                                        <th>{!! trans('topic') !!}</th>
                                        <th class="hidden-xs">{!! trans('question') !!}</th>
                                        <th class="hidden-lg hidden-md hidden-sm">{!! trans('instructions') !!}</th>
                                        <th>{!! trans('file') !!}</th>

                                        <th class="hidden-xs">{!! trans('pages') !!}</th>
                                        <th class="hidden-xs">{!! trans('due') !!}</th>
                                        <th class="hidden-lg hidden-md hidden-sm"></th>
                                        <th class="hidden-lg hidden-md hidden-sm"></th>
                                    </tr>
                                </thead>
                                    <tbody id="users_table">
                                    @foreach($errors as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->name}}</td>
                                            <td class="hidden-lg hidden-md hidden-sm"><a href="mailto:{{ $order->email }}" title="email {{ $order->email }}">{{ $order->email }}</a></td>
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->phone}}</td>
                                            <td class="hidden-xs">{{$order->category}}</td>
                                            <td class="hidden-xs">{{$order->topic}}</td>
                                           <td class="hidden-xs">{{$order->question}}</td>
                                           <td class="hidden-lg hidden-md hidden-sm">{{$order->instructions}}</td>
                                           <td class="hidden-xs">{{$order->file}}</td>
                                           <td class="hidden-xs">{{$order->pages}}</td>
                                           <td class="hidden-xs">{{$order->due}}</td>
                                           
                                           
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->created_at}}</td>
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->updated_at}}</td>
                                             <td>
                                                    {!! Form::model($order, array('action' => array('Admin\TrashController@update', $order->id), 'method' => 'PUT', 'data-toggle' => 'tooltip')) !!}
                                                        {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-block btn-sm', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore User')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('operations/deleted/' . $order->id) }}" data-toggle="tooltip" title="Show User">
                                                        <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    {!! Form::model($order, array('action' => array('Admin\TrashController@destroy', $order->id), 'method' => 'DELETE', 'class' => 'inline', 'data-toggle' => 'tooltip', 'title' => 'Destroy User Record')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button('<i class="fa fa-user-times" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm inline','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @if (count($order) > 10)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')

@endsection
