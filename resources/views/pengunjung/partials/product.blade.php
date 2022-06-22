<div class="section-title">
    <h2>Kategori Produk</h2>
    <div>
        <ul>
            <p><i class="ri-check-double-line"></i> DIBAWAH INI DAFTAR BEBERAPA KATEGORI YANG DAPAT KAMI SEDIAKAN.
            </p>
            <p><i class="ri-check-double-line"></i> SEMUA PERMINTAAN DILAYANI SECARA MANUAL DENGAN CARA
                MENGHUBUNGKAN KAMI LANGSUNG.</p>
            <p><i class="ri-check-double-line"></i> JIKA ADA YANG DILUAR DAFTAR INI, SILAKAN HUBUNGI
                KAMI UNTUK MENYEDIAKAN KEBUTUHAN ANDA.
            </p>
            <p><i class="ri-check-double-line"></i> TERIMA KASIH TELAH IKUT BERPARTISIPASI MEMBANGUN
                DESA KAMI.</li>
        </ul>
    </div>
</div>

<!-- <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
    <li data-filter="*" class="filter-active">All</li>
    @forelse($categories as $row)
    <li data-filter=".filter-app">{{ $row->name }}</li>
    @empty
    @endforelse
</ul> -->

<div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
    @forelse($categories as $row)
    <div class="col-lg-4 col-md-6 mt-4 portfolio-item filter-app">
        <div class="card" style="height: 19rem;">
            <img src="{{ asset('storage/'.$row->path) }}" class="card-img-top" alt="..." height="200px">
            <div class="card-body">
                <h5 class="card-title">{{$row->name}}</h5>
                <!-- <p class="text">{{$row->short_description}}</p> -->
                <a href="/productCustomer" class="btn btn-primary">Show Product</a>
            </div>
        </div>
    </div>

    @empty
    No record found
    @endforelse
</div>