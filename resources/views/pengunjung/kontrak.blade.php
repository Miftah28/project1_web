@extends('pengunjung.layout')

@section('content')
    <div class="content">
        <div class="row justify-content-md-center mt-5 mb-5">
            <div class="col-lg-11">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Kontrak Saya</h2>
                    </div>
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        @include('admin.partials.flash')
                        <form class="row g-3" action="/kontrakSaya" method="GET">
                            <div class="col-8">
                                <input type="text" class="form-control" name="q" placeholder="Search...">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                        <table class="table table-bordered table-stripped table-responsive mt-2">
                            <thead>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($requests as $request)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>{{ $request->product->name }}</td>
                                        <td>{{ $request->customer->name }}</td>
                                        <td>{{ $request->customer->email }}</td>
                                        <td>{{ $request->customer->telp }}</td>
                                        <td>{{ $request->status == 0 ? 'Proses' : ($request->status == 1 ? 'Berhasil' : 'Batal') }}
                                        </td>
                                        <td>
                                            <a href="/kontrakSaya/download/{{ $request->id }}"
                                                class="btn btn-primary btn-sm">Unduh</a>
                                            @if ($request->status == 0)
                                                <a href="/kontrakSaya/edit/{{ $request->id }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan kontrak ini?')">Batal</a>
                                            @endif
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
                </div>
            </div>
        </div>
    </div>
@endsection
