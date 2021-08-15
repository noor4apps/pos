@extends('layouts.dashboard.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.products')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li></a>
                <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</li></a>
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
                    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="category">@lang('site.categories')</label>
                            <select name="category_id" id="category" class="form-control">
                                <option value="">---</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        @foreach(config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="name">@lang('site.name->' . $locale)</label>
                                <input type="text" name="name->{{ $locale }}" id="name" class="form-control" value="{{ old('name->' . $locale) }}">
                                @error('name->' . $locale)<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="form-group">
                                <label for="description">@lang('site.description->' . $locale)</label>
                                <textarea type="text" name="description->{{ $locale }}" id="description" class="form-control ckeditor">{{ old('description->' . $locale) }}</textarea>
                                @error('description->' . $locale)<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="image-product">@lang('site.image')</label>
                            <input type="file" name="image" id="image-product" class="image form-control">
                            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/default.png') }}" id="image-preview" class="img-thumbnail img-responsive" style="width: 75px">
                        </div>

                        <div class="form-group">
                            <label for="purchase_price">@lang('site.purchase_price')</label>
                            <input type="number" name="purchase_price" id="purchase_price" class="form-control" value="{{ old('purchase_price') }}">
                            @error('purchase_price')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="sale_price">@lang('site.sale_price')</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control" value="{{ old('sale_price') }}">
                            @error('sale_price')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="stock">@lang('site.stock')</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
                            @error('stock')<small class="text-danger">{{ $message }}</small>@enderror
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
