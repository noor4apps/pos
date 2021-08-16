@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.clients')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li></a>
                <li><a href="{{ route('dashboard.clients.index') }}"> @lang('site.clients')</li></a>
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
                    <form action="{{ route('dashboard.clients.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="mobile">@lang('site.mobile')</label>
                            <input type="text" name="phone[]" id="mobile" class="form-control" value="{{ old('phone.0') }}">
                            @error('phone.0')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">@lang('site.phone')</label>
                            <input type="text" name="phone[]" id="phone" class="form-control" value="{{ old('phone.1') }}">
                            @error('phone.1')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="address">@lang('site.address')</label>
                            <textarea type="text" name="address" id="address" class="form-control"> {{ old('address') }}</textarea>
                            @error('address')<small class="text-danger">{{ $message }}</small>@enderror
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
