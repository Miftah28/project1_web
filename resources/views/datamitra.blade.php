@extends('admin.layout')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Data Mitra</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    <form class="row g-3" action="/mitra" method="GET">
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
                            <th>Nama PT</th>
                            <th>Nama Admin PT</th>
                            <th>Jenis Kelamin</th>
                            <th>No telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php
                            $i =0;
                            @endphp
                            @forelse($data as $row)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->namaAdminPt}}</td>
                                <td>{{$row->jk}}</td>
                                <td>{{$row->notelp}}</td>
                                <td>{{$row->email}}</td>
                                <td class="text-center">
                                    <form action="/delete/{{$row->id}}" method="POST">

                                        <a class="btn btn-warning btn-sm" href="/tampilkandata/{{$row->id}}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No record found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
                <div class="card-footer text-right">
                    <a href="/tambahmitra" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection