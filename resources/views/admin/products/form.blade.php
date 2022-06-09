@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($product) ? 'Update' : 'New'
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-3">
            @include('admin.products.product_menus')
        </div>
        <div class="col-lg-9">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Product</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($product))
                    {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('type') !!}
                    @else
                    {!! Form::open(['url' => 'admin/products']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('mitra_id', 'Mitra') !!}
                        {!! General::selectMultiLevel('mitra_id', $mitras, ['class' => 'form-control', 'selected' => !empty(old('mitra_id')) ? old('mitra_id') : $mitraID, 'placeholder' => '-- Choose Mitra --']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sku', 'Kode') !!}
                        {!! Form::text('sku', time(),['class' => 'form-control', 'placeholder' => 'sku','readonly'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('category_ids', 'Category') !!}
                        {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('short_description', 'Short Description') !!}
                        {!! Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' => 'short description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Set Status --']) !!}
                    </div>
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                        <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection