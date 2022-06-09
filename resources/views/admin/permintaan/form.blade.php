@extends('admin.layout')

@section('content')
@php
$formTitle = !empty($request)?'Update':'New'
@endphp
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class=" card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{$formTitle}} Request</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash',['$errors' => $errors])
                    @if(!empty($request))
                    {!! Form::model($request, ['url' => ['admin/permintaan',$request->id],'method' =>'PUT', 'enctype' => 'multipart/form-data'])!!}
                    {!! Form::hidden('id')!!}
                    @else
                    {!! Form::open(['url' => ['admin/permintaan'], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('product_id', 'Product') !!}
                        {!! General::selectMultiLevel('product_id', $products, ['class' => 'form-control', 'selected' => !empty(old('product_id')) ? old('product_id') : $productID, 'placeholder' => '-- Choose Product --']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('customer_id', 'Customer') !!}
                        {!! General::selectMultiLevel('customer_id', $customers, ['class' => 'form-control', 'selected' => !empty(old('customer_id')) ? old('customer_id') : $customerID, 'placeholder' => '-- Choose Customer --']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('file', 'File Kontrak (* pdf)') !!}
                        {!! Form::file('file', ['class' => 'form-control-file', 'placeholder' => 'file kontrak']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Set Status --']) !!}
                    </div>
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                        <a href="{{ url('admin/permintaan') }}" class="btn btn-secondary btn-default">Back</a>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection