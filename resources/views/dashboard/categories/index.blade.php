@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.categories')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active"> @lang('site.categories')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="padding-bottom: 10px">@lang('site.categories') <small>{{ $categories->total() }}</small></h3>
                    <form action="{{ route('dashboard.categories.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('site.search')">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if(auth()->user()->hasPermission('create_categories'))
                                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <button class="btn btn-success disabled"><i class="fa fa-plus"></i> @lang('site.add')</button>
                                @endif
                            </div>
                        </div>
                    </form><!-- end of form search -->
                </div><!-- end of box header -->
                <div class="box-body">

                    <table class="table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.products_count')</th>
                            <th>@lang('site.products_related')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products_count }}</td>
{{--                                <td><a href="{{ route('dashboard.product.index', ['']) }}" class="btn btn-default"><i class="fa fa-info-circle"></i></a></td>--}}
                                <td>
                                    @if(auth()->user()->hasPermission('update_categories'))
                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @else
                                        <button class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                    @endif

                                    @if(auth()->user()->hasPermission('delete_categories'))
                                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        </form>
                                    @else
                                        <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3">@lang('site.no_results_found')</td></tr>
                        @endforelse
                        </tbody>
                    </table><!-- end of table -->

                    {{ $categories->appends(request()->query())->links() }}

                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section>
    </div>
@endsection
