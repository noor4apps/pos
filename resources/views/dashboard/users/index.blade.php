@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.users')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active"> @lang('site.users')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="padding-bottom: 10px">@lang('site.users')</h3>
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                <a href="{{ route('dashboard.users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box header -->
                <div class="box-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                    <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">@lang('site.delete')</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">@lang('site.no_results_found')</td></tr>
                        @endforelse
                        </tbody>
                    </table><!-- end of table -->

                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section>
    </div>
@endsection
