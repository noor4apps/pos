@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.categories')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li></a>
                <li><a href="{{ route('dashboard.categories.index') }}"> @lang('site.categories')</li></a>
                <li class="active"> @lang('site.add')</li></a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
{{--            @include('partials._errors')--}}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    <form action="{{ route('dashboard.categories.store') }}" method="post">
                        @csrf
                        @foreach(config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="name">@lang('site.name->' . $locale)</label>
                                <input type="text" name="name->{{ $locale }}" id="name" class="form-control" value="{{ old('name.' . $locale) }}">
                                @error('name->' . $locale)<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        @endforeach
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('site.save')</button>
                        </div>
                    </form> <!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section>
    </div>
@endsection
