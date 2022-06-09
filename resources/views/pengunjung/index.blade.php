@extends('pengunjung.layout')
@section('content')
<!--================Category Product Area =================-->
<section>
    <div class="container-fluid">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <form class="row g-3" action="/productCustomer" method="GET">
                            <div class="col-10">
                                <input type="text" class="form-control" name="q" placeholder="Search...">
                            </div>
                            <div class="col-auto ms-auto">
                                <button type="submit" class="btn btn-primary"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @forelse($products as $row)
                    <div class="col-lg-4 col-md-6 mt-4 portfolio-item filter-app">
                        <div class="card" style="height: 25rem;">
                            <img src="{{ asset('storage/'.$row->path) }}" class="card-img-top" alt="..." height="200px">
                            <div class="card-body">
                                <h5 class="card-title">{{$row->name}}</h5>
                                <p class="text">{{$row->short_description}}</p>
                                <a href="{{url('/postproduk?id='.$row->id)}}" class="btn btn-primary">Detail Product</a>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="card-body">
                        No record found
                    </div>
                    @endforelse
                </div>
                <div class="mt-2">
                    {{ $products->links() }}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets cat_widgets">
                        <div class="card">
                            <div class="card-header">
                                Category Product
                            </div>
                            <div class="card-body">
                                <form action="/productCustomer" method="GET">
                                    <ul class="list">

                                        @foreach ($categories as $category)
                                        @if($category->parent_id == 0)
                                        <li>
                                            <a href="{{url('/productCustomer?id='.$category->id)}}">{{ $category->name }}</a>
                                            @php
                                            $id = $category->id;
                                            @endphp

                                            @foreach ($categories as $child)
                                            @if($child->parent_id == $id)
                                            <ul class="list">
                                                <li>
                                                    <a href="{{url('/productCustomer?id='.$child->id)}}">{{ $child->name }}</a>
                                                </li>
                                            </ul>
                                            @endif
                                            @endforeach

                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>

        <!-- GENERATE PAGINATION PRODUK -->
    </div>
</section>
<!--================End Category Product Area =================-->
@endsection