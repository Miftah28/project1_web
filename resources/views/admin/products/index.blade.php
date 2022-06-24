@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Products</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    <form class="row g-3" action="{{url('admin/products')}}" method="GET">
                        <div class="col-8">
                            <input type="text" class="form-control" name="q" placeholder="Search...">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3"><i class="mdi mdi-magnify"></i></button>
                        </div>
                    </form>
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Name</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                            $i =0;
                            @endphp
                            @forelse ($products as $product)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }}</td>
                                {{-- <td>{{ $product->status = 0 ? "Draft" : ($product->status = 1 ? "Active" : "Inactive")}}</td> --}}
                                <td>
                                    <a href="{{ url('admin/products/'. $product->id .'/edit') }}" class="btn btn-warning btn-sm">edit</a>

                                    {!! Form::open(['url' => 'admin/products/'. $product->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url('admin/products/create') }}" class="btn btn-primary">Add New</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection