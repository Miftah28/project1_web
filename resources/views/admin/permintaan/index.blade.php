@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Permintaan</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    <form class="row g-3" action="{{url('admin/permintaan')}}" method="GET">
                        <div class="col-8">
                            <input type="text" class="form-control" name="q" placeholder="Search...">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3"><i class="mdi mdi-magnify"></i></button>
                        </div>
                    </form>
                    <table class="table table-bordered table-stripped table-responsive">
                        <thead>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($requests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->product->name }}</td>
                                <td>{{ $request->customer->name }}</td>
                                <td>{{ $request->customer->email }}</td>
                                <td>{{ $request->customer->telp }}</td>
                                <td>{{ $request->status == 0 ? "Proses" : ($request->status == 1 ? "Berhasil" : "Batal") }}</td>
                                <td>
                                    <a href="{{ url('admin/permintaan/download/'. $request->id) }}" class="btn btn-primary btn-sm">Unduh</a>
                                    <a href="{{ url('admin/permintaan/'. $request->id .'/edit') }}" class="btn btn-warning btn-sm">Edit</a>

                                    {!! Form::open(['url' => 'admin/permintaan/'. $request->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $requests->links() }}
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url('admin/permintaan/create') }}" class="btn btn-primary">Add New</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection