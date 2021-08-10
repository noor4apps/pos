@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.users')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li></a>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</li></a>
                <li class="active"> @lang('site.add')</li></a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="f-name">@lang('site.first_name')</label>
                            <input type="text" name="first_name" id="f-name" class="form-control" value="{{ old('first_name') }}">
                            @error('first_name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="l-name">@lang('site.last_name')</label>
                            <input type="text" name="last_name" id="l-name" class="form-control" value="{{ old('last_name') }}">
                            @error('last_name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('site.email')</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="image-user">@lang('site.image')</label>
                            <input type="file" name="image" id="image-user" class="form-control">
                            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="password">@lang('site.password')</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        @php
                            $models = ['categories', 'products', 'clients', 'orders', 'users']
                        @endphp

                        <div class="form-group">
                            <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @foreach($models as $model)
                                        <li class="{{ $loop->index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($models as $model)
                                        <div class="tab-pane {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]" value="read_{{ $model }}">
                                                @lang('site.read')
                                            </label>

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]" value="create_{{ $model }}">
                                                @lang('site.create')
                                            </label>

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]" value="update_{{ $model }}">
                                                @lang('site.update')
                                            </label>

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]" value="delete_{{ $model }}">
                                                @lang('site.delete')
                                            </label>

                                        </div>
                                    @endforeach
                                </div>
                            </div><!-- end of tabs permission -->
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('site.save')</button>
                        </div>
                    </form> <!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section>
    </div>
@endsection
