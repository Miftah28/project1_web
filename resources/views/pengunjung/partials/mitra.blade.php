<div class="container" data-aos="fade-up">
    <div class="section-title">
        <h2>Mitra</h2>
    </div>
    <div class="row">
        @forelse($mitras as $row)
        <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                <div class="pic"><img src="assets/img/team/user.png" class="img-fluid" alt="">
                </div>
                <div class="member-info">
                    <h4>{{ $row->name }}</h4>
                    <span>{{ $row->namaAdminPt }}</span>
                    <p>Email : {{ $row->email }}</p>
                    <p>Kontak : {{ $row->notelp }}</p>
                </div>
            </div>
        </div>
        @empty
        No record found
        @endforelse
    </div>
    <div class="mt-2">
        {{ $mitras->links() }}
    </div>
</div>