@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{ __('site.users') }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ __('site.dashboard') }} </a></li>
                <li class="active"> {{ __('site.users') }} </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('site.users') }}</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('site.first_name') }}</th>
                            <th>{{ __('site.last_name') }}</th>
                            <th>{{ __('site.email') }}</th>
                            <th>{{ __('site.actions') }}</th>
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
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-info btn-sm">{{ __('site.edit') }}</a>
                                    <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">{{ __('site.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">{{ __('site.no_results_found') }}</td></tr>
                        @endforelse
                        </tbody>
                    </table><!-- end of table -->

                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section>
    </div>
@endsection
