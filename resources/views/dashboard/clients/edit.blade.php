@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.clients')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}"> @lang('site.clients')</a></li>
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
                    <form action="{{ route('dashboard.clients.update', $client->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name) }}">
                            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="mobile">@lang('site.mobile')</label>
                            <input type="text" name="phone[]" id="mobile" class="form-control" value="{{ old('phone.0', $client->phone[0]) }}">
                            @error('phone.0')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">@lang('site.phone')</label>
                            <input type="text" name="phone[]" id="phone" class="form-control" value="{{ old('phone.1', $client->phone[1]) }}">
                            @error('phone.1')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="address">@lang('site.address')</label>
                            <textarea type="text" name="address" id="address" class="form-control"> {{ old('address', $client->address) }}</textarea>
                            @error('address')<small class="text-danger">{{ $message }}</small>@enderror
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
