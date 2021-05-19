@extends('layouts.app')

@section('template_title')
    {!! trans('Rejected Orders') !!}
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
                                {!! trans('Orders to be Revised') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                               
                            </div>
                        </div>
                    </div>

                    <div class="card-body">


                        @if(config('usersmanagement.enableSearchUsers'))
                            @include('partials.Clients.search-rejectedOrders-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.users-table.caption', 1, ['orderscount' => $readyOrders->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>

                                        <th>{!! trans('#Batch:') !!}</th>
                                        <th class="hidden-xs">{!! trans('Client  Mail') !!}</th>
                                        <th class="hidden-xs">{!! trans('Submited File') !!}</th>
                                        <th class="hidden-xs">{!! trans('Status') !!}</th>
                                        <th class="hidden-xs">{!! trans('Download') !!}</th>
                                        <th class="hidden-xs">{!! trans('View') !!}</th>
                                        <th class="hidden-xs">{!! trans('Reply') !!}</th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($readyOrders as $order)
                                        <tr>

                                            <td class="" > <span class="code">{{$order->OUID}}</span></td>
                                            <td><a href="mailto:{{ $order->email }}" title="email {{ $order->email }}">{{ $order->email }}</a></td>
                                           <td class="hidden-xs">

                                            <a href="{{ url('download_order', $order->fileName) }}">{{$order->fileName}}</a>

                                            </td>
                                            <td>
                                                    @if ($order->Status == 'Approved')
                                                        @php $badgeClass = 'primary' @endphp
                                                    @elseif ($order->Status == 'To be Revised')
                                                        @php $badgeClass = 'warning' @endphp
                                                    @elseif ($order->Status == 'Canceled!')
                                                        @php $badgeClass = 'danger' @endphp
                                                    @elseif ($order->Status == 'New')
                                                        @php $badgeClass = 'success' @endphp
                                                    @elseif ($order->Status == 'Replied')
                                                        @php $badgeClass = 'secondary' @endphp
                                                    @else
                                                        @php $badgeClass = 'default' @endphp
                                                    @endif
                                                    <span class="badge badge-{{$badgeClass}}">{{ $order->Status }}</span>
                                           
                                            </td>

                                           <td class="hidden-xs"><a href="{{ url('download_order', $order->fileName) }}"><button class="btn btn-sm btn-block btn-info"> Download</button></a></td>


                                            
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('orders_for_Revision/' . $order->id) }}" data-toggle="tooltip" title="Show">
                                                    View 
                                                    {!! trans('usersmanagement.buttons.show') !!}
                                                </a>
                                            </td>


                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('submited_Orders/' . $order->id . '/edit') }}" data-toggle="tooltip" title="Reply">
                                                    {!! trans('Reply') !!}
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
                                {{ $readyOrders->links() }}
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
    @if ((count($readyOrders) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('usersmanagement.enableSearchUsers'))
        @include('scripts.Clients.search-RejectedOrders')
    @endif
@endsection
