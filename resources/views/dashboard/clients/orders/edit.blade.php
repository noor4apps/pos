@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@lang('site.client') ({{ $client->name }}) - @lang('site.edit_order')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.orders.index') }}"> @lang('site.orders')</a></li>
                <li class="active">@lang('site.edit_order')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h3>

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
                                                            <td>{{ $product->sale_price }}</td>
                                                            <td>
                                                                <a
                                                                    id="product-{{ $product->id }}"
                                                                    data-name="{{ $product->name }}"
                                                                    data-id="{{ $product->id }}"
                                                                    data-price="{{ $product->sale_price }}"
                                                                    class="btn {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success' }} add-product-btn btn-sm">
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

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">@lang('site.orders')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @include('partials._errors')

                            <form action="{{ route('dashboard.clients.orders.update', ['order' => $order->id, 'client' => $client->id]) }}" method="post">

                                @csrf
                                @method('put')

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">

                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td><input type="number" name="products[{{ $product->id }}][quantity]" data-price="{{ number_format($product->sale_price, 2) }}" class="form-control input-sm product-quantity" min="1" value="{{ $product->pivot->quantity }}"></td>
                                            <td class="product-price">{{ number_format($product->sale_price * $product->pivot->quantity, 2) }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm remove-product-btn" data-id="{{ $product->id }}"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table><!-- end of table -->

                                <h4>@lang('site.total') : <span class="total-price">{{ number_format($order->total_price, 2) }}</span></h4>

                                <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-edit"></i> @lang('site.edit')</button>

                            </form><!-- end of form -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
