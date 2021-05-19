@extends('layouts.app') 

@section('template_title')
    {!! trans('Orders in Progress') !!}
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
                                {!! trans('Your Orders In Progress.') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('usersmanagement.enableSearchUsers'))
                            @include('partials.Clients.search-inProgressOrder-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.users-table.caption', 1, ['orderscount' => $orders->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="hidden-lg hidden-md hidden-sm">{!! trans('name') !!}</th>
                                        <th class="hidden-lg hidden-md hidden-sm">{!! trans('email') !!}</th>
                                        <th class="hidden-lg hidden-md hidden-sm">{!! trans('phone') !!}</th>


                                        <th >{!! trans('#Batch:') !!}</th>
                                        <th class="hidden-xs">{!! trans('category') !!}</th>
                                        <th>{!! trans('topic') !!}</th>
                                        <th class="hidden-xs">{!! trans('pages') !!}</th>
                                        <th class="hidden-xs">{!! trans('Format') !!}</th>
                                        <th class="hidden-xs">{!! trans('Duration') !!}</th>
                                        <th class="hidden-xs">{!! trans('Due on') !!}</th>
                                        <th class="hidden-xs">{!! trans('Budget') !!}</th>
                                        <th class="hidden-xs">{!! trans('Status') !!}</th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->name}}</td>
                                            <td class="hidden-lg hidden-md hidden-sm"><a href="mailto:{{ $order->email }}" title="email {{ $order->email }}">{{ $order->email }}</a></td>
                                            <td class="hidden-lg hidden-md hidden-sm">{{$order->phone}}</td>


                                            <td class="" > <span class="code">{{$order->OUID}}</span></td>
                                            <td class="hidden-xs">{{$order->category}}</td>
                                            <td class="hidden-xs">{{$order->topic}}</td>
                                           <td class="hidden-xs">{{$order->pages}}</td>
                                           <td class="hidden-xs">{{$order->format}}</td>
                                           <td class="hidden-xs">{{$order->duration}}</td>
                                           <td class="hidden-xs">{{$order->due}}</td>
                                           <td class="hidden-xs" > <span class="green"> ${{$order->pricing}}.00</span></td>
                                           <td class="hidden-xs" > <span class="badge badge-primary">{{$order->status}}</span></td>
                                                                                                                                                                       
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
        @include('scripts.Clients.search-inProgressOrders')
    @endif
@endsection

