@extends('pengunjung.layout')
@section('content')
    @foreach ($produk as $row)
        <div class="container">
            @include('admin.partials.flash')
            <div class="card mb-3 mt-4">
                <img src="{{ asset('storage/' . $row->path) }}" class="card-img" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $row->name }}</h5>
                    <p class="card-text">{{ $row->short_description }}</p>
                    @guest
                        <p>Bila anda ingin membuat kontrak dengan kami silakan <a
                                href="{{ route('register') }}">registrasi</a>/<a href="{{ route('login') }}">Login</a>
                            terlebih dahulu lalu membuat kontrak permintaan.</p>
                    @else
                        @forelse ($r as $p)
                        @empty
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Buat Kontrak
                            </button>
                        @endforelse
        @endif
        <a href="/productCustomer" class="d-block mt-3">Back</a>
        </div>
        </div>
        </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Membuat Kontrak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        {!! Form::open(['url' => ['kontraksaya/create'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {!! Form::hidden('product_id', $row->id, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('file', 'File Kontrak (* pdf)') !!}
                            {!! Form::file('file', ['class' => 'form-control-file', 'placeholder' => 'file kontrak']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endsection
