@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.clients')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active"> @lang('site.clients')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="padding-bottom: 10px">@lang('site.clients') <small>{{ $clients->total() }}</small></h3>
                    <form action="{{ route('dashboard.clients.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('site.search')">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if(auth()->user()->hasPermission('create_clients'))
                                    <a href="{{ route('dashboard.clients.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('site.add')</a>
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
                            <th>@lang('site.mobile')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $client->name }}</td>
{{--                                <td>{{ implode(' - ', array_filter($client->phone)) }}</td> handle in model --}}
                                <td>{{ $client->NumberOrTwo }}</td>
                                <td>{{ $client->address }}</td>
                                <td>
                                    @if(auth()->user()->hasPermission('update_clients'))
                                        <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @else
                                        <button class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                    @endif

                                    @if(auth()->user()->hasPermission('delete_clients'))
                                        <form action="{{ route('dashboard.clients.destroy', $client->id) }}" method="post" style="display: inline-block">
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
                            <tr><td colspan="5">@lang('site.no_results_found')</td></tr>
                        @endforelse
                        </tbody>
                    </table><!-- end of table -->

                    {{ $clients->appends(request()->query())->links() }}

                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section>
    </div>
@endsection
