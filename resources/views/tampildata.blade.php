@extends('admin.layout')

@section('content')
<br>
<form action="/updatedata/{{$data->id}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class=" card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Edit Mitra</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                            <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Nama Admin Perusahaan</label>
                            <input type="text" name='namaAdminPt' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->namaAdminPt}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name='jk' aria-label="Default select example">
                                <option selected>{{$data->jk}}</option>
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">No telepon</label>
                            <input type="text" name='notelp' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->notelp}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->email}}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Password</label>
                            <input type="password" name='password' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->password}}">
                        </div> --}}
                        <div class="form-footer pt-5 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Save</button>
                            <a href="/mitra" class="btn btn-secondary btn-default">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection