@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Categories</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    <form class="row g-3" action="{{url('admin/categories')}}" method="GET">
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
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                            $i =0;
                            @endphp
                            @forelse($categories as $category)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->parents ? $category->parents->name : ''}}</td>
                                <td>
                                    <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                        <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No record found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add News</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection