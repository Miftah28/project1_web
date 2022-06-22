    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Membuat Laporan EXCEL Dengan Laravel</h4>
            <h6><a target="_blank">DATA MITRA YANG BERKERJA SAMA DENGAN BUMDES TULUNGAGUNG</a>
        </h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nama Admin Pt</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($mitra as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->namaAdminPt }}</td>
                    <td>{{ $p->jk }}</td>
                    <td>{{ $p->notelp }}</td>
                    <td>{{ $p->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
