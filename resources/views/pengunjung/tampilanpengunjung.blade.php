@extends('pengunjung.layout')

@section('content')
<!-- ======= Produk Section ======= -->
<section id="Produk" class="portfolio">
    <div class="container" data-aos="fade-up">
        @include('pengunjung.partials.product')
    </div>
</section>
<!-- End Portfolio Section -->

<!-- ======= Mitra Section ======= -->
<section id="Mitra" class="team section-bg">
    @include('pengunjung.partials.mitra')
</section><!-- End Team Section -->

<!-- ======= Visi & Misi Section ======= -->
<section id="VisiMisi" class="VisiMisi">
    @include('pengunjung.partials.visimisi')
</section><!-- End Visi & Misi Section -->

<!-- ======= Demografi Section ======= -->
<section id="Demografi" class="services section-bg">
    @include('pengunjung.partials.demografi')
</section><!-- End Services Section -->
@endsection