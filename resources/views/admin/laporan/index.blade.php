@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="container">
                        <center>
                            <h5>Membuat Laporan EXCEL Dengan Laravel</h4>
                                <h6><a target="_blank">DATA MITRA YANG BERKERJA SAMA DENGAN BUMDES TULUNGAGUNG</a>
                            </h5>
                        </center>
                        <br />
                        <a href="{{ route('cetak') }}" class="btn btn-primary" target="_blank">CETAK EXCELL</a>
                        <table class='table table-bordered mt-2'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($data as $mitra)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $mitra->name }}</td>
                                        <td>{{ $mitra->namaAdminPt }}</td>
                                        <td>{{ $mitra->jk }}</td>
                                        <td>{{ $mitra->notelp }}</td>
                                        <td>{{ $mitra->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
