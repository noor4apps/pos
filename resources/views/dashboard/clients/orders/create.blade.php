@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.client') ({{ $client->name }}) - @lang('site.add_order')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li></a>
                <li><a href="{{ route('dashboard.clients.index') }}"> @lang('site.clients')</li></a>
                <li class="active"> @lang('site.add_order')</li></a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('site.categories')</h3>
                        </div><!-- end of box header -->
                        <div class="box-body">

                            @forelse ($categories as $category)
                                @if ($category->products->count() <= 0)
                                    @continue
                                @endif
                                <div class="panel-group">
                                    <div class="panel panel-info">

                                        <a data-toggle="collapse" href="#cat-{{ $category->id }}">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    {{ $category->name }}
                                                </h4>
                                            </div>
                                        </a>

                                        <div id="cat-{{ $category->id }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>@lang('site.name')</th>
                                                        <th>@lang('site.stock')</th>
                                                        <th>@lang('site.price')</th>
                                                        <th>@lang('site.add')</th>
                                                    </tr>
                                                    @foreach ($category->products as $product)
                                                        <tr>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->stock }}</td>
                                                            <td>{{ number_format($product->sale_price, 2) }}</td>
                                                            <td>
                                                                <a
                                                                    id="product-{{ $product->id }}"
                                                                    data-id="{{ $product->id }}"
                                                                    data-name="{{ $product->name }}"
                                                                    data-price="{{ $product->sale_price }}"
                                                                    class="btn btn-success btn-sm add-product-btn">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table><!-- end of table -->

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->
                            @empty
                                <h3>@lang('site.no_results_found')</h3>
                            @endforelse

                        </div><!-- end of box body -->
                    </div>

                </div> <!-- end of categories -->

                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('site.orders')</h3>
                        </div><!-- end of box header -->
                        <div class="box-body">

                            <form action="{{ route('dashboard.clients.orders.store', $client->id) }}" method="post">
                                @csrf
                                @include('partials._errors')

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list"></tbody>

                                </table><!-- end of table -->

                                <h4>@lang('site.total') : <span class="total-price">0</span></h4>

                                <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.add_order')</button>

                            </form>

                        </div><!-- end of box body -->
                    </div>
                    <!-- end of orders -->

                    @if ($client->orders->count() > 0)
                        <div class="box box-primary">

                            <div class="box-header">
                                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                                    <small>{{ $orders->total() }}</small>
                                </h3>
                            </div><!-- end of box header -->

                            <div class="box-body">
                                @foreach ($orders as $order)
                                    <div class="panel-group">
                                        <div class="panel panel-success">

                                            <a data-toggle="collapse" href="#date-{{ $order->created_at->format('d-m-Y-s') }}">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        @lang('site.created_at') {{ $order->created_at->format('d / m / Y') }} -
                                                        @lang('site.price') {{ $order->total_price }}
                                                    </h4>
                                                </div>
                                            </a>

                                            <div id="date-{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">

                                                <div class="panel-body">
                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->
                                @endforeach

                                {{ $orders->links() }}

                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    @endif

                </div> <!-- end of col: orders & previous_orders -->

            </div> <!-- end of row -->

        </section>
    </div>
@endsection
