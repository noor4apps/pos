@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.users')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
                <li class="active"> @lang('site.edit')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="f-name">@lang('site.first_name')</label>
                            <input type="text" name="first_name" id="f-name" class="form-control" value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="l-name">@lang('site.last_name')</label>
                            <input type="text" name="last_name" id="l-name" class="form-control" value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('site.email')</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        @php
                            $models = ['categories', 'products', 'clients', 'orders', 'users']
                        @endphp

                        <div class="form-group">
                            <label>@lang('site.permissions')</label>
                            @error('permissions')<small class="text-danger">{{ $message }}</small>@enderror
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @foreach($models as $model)
                                        <li class="{{ $loop->index == 0 ? 'active' : '' }}">
                                            <a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($models as $model)
                                        <div class="tab-pane {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]"
                                                       {{ in_array('read_' . $model, old('permissions', $user->permissions->pluck('name')->toArray())) ? 'checked' : '' }}
                                                       value="read_{{ $model }}">
                                                @lang('site.read')
                                            </label>

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]"
                                                       {{ in_array('create_' . $model, old('permissions', $user->permissions->pluck('name')->toArray())) ? 'checked' : '' }}
                                                       value="create_{{ $model }}">
                                                @lang('site.create')
                                            </label>

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]"
                                                       {{ in_array('update_' . $model, old('permissions', $user->permissions->pluck('name')->toArray())) ? 'checked' : '' }}
                                                       value="update_{{ $model }}">
                                                @lang('site.update')
                                            </label>

                                            <label style="font-weight: 400; padding: 15px;">
                                                <input type="checkbox" name="permissions[]"
                                                       {{ in_array('delete_' . $model, old('permissions', $user->permissions->pluck('name')->toArray())) ? 'checked' : '' }}
                                                       value="delete_{{ $model }}">
                                                @lang('site.delete')
                                            </label>

                                        </div>
                                    @endforeach
                                </div>
                            </div><!-- end of tabs permission -->
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>
                    </form> <!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section>
    </div>
@endsection
