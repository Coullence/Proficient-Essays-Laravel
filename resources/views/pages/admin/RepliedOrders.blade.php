@extends('layouts.app')

@section('template_title')
    {!! trans('Replied Orders') !!}
@endsection

@section('template_linked_css')
    @if(config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
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
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('Replied Orders') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                               
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('usersmanagement.enableSearchUsers'))
                            @include('partials.search-users-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.users-table.caption', 1, ['orderscount' => $orders->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>{!! trans('Client Mail') !!}</th>
                                        <th class="hidden-xs">{!! trans('category') !!}</th>
                                        <th class="hidden-xs">{!! trans('pages') !!}</th>
                                        <th class="hidden-xs">{!! trans('Format') !!}</th>
                                        <th class="hidden-xs">{!! trans('Duration') !!}</th>
                                        <th class="hidden-xs">{!! trans('Status') !!}</th>
                                        <th class="hidden-xs">{!! trans('due on') !!}</th>

                                        <th class="hidden-xs">Trash</th>
                                        <th class="hidden-xs">View</th>
                                        <th class="hidden-xs">Re-Inform</th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><a href="mailto:{{ $order->email }}" title="email {{ $order->email }}">{{ $order->email }}</a></td>
                                            <td class="hidden-xs">{{$order->category}}</td>
                                           <td class="hidden-xs">{{$order->pages}}</td>
                                           <td class="hidden-xs">{{$order->format}}</td>
                                           <td class="hidden-xs">{{$order->duration}}</td>
                                           <td class="hidden-xs" > <span class="badge badge-primary">{{$order->status}}</span></td>
                                           <td class="hidden-xs">{{$order->updated_at}}</td>
                                           
                                           
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->created_at}}</td>
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->updated_at}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'operations/' . $order->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete order', 'data-message' => 'Are you sure you want to delete this order ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('operations/' . $order->id) }}" data-toggle="tooltip" title="Show">
                                                    {!! trans('usersmanagement.buttons.show') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('operations/' . $order->id . '/edit') }}" data-toggle="tooltip" title="Reply">
                                                    {!! trans('usersmanagement.buttons.replyOrder') !!}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('usersmanagement.enableSearchUsers'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('usersmanagement.enablePagination'))
                                {{ $orders->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($orders) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-users')
    @endif
@endsection
