<html>
    <head>
        <title>Laravel PDF</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
        <a href="{{ route('user.pdf') }}">
        <button class='btn btn-primary'>Generate PDF</button>
        </a>
        <br>
        <div class="card-body">
            <table class="table-static table-bordered table-hovered " align="center" rules="all" border="1px" style="width: 95%;">
                <thead>
                <tr>
                    <th scope="column">No</th>
                    <th scope="column">Name</th>
                    <th scope="column">Tanggal Pengaduan</th>
                    <th scope="column">Permasalahan</th>
                    <th scope="column">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->tgl_pengaduan}}</td>
                        <td>{{$item->isi_laporan}}</td>
                        <td>{{$item->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>