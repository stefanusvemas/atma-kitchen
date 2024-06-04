@extends('admin.index')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Pengajuan Penarikan Saldo</h3>

            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Jumlah Penarikan</th>
                        <th scope="col">No Rek</th>
                        <th scope="col">Bank</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawals as $withdrawal)
                    <tr>
                        <td>{{ $withdrawal->customer->nama }}</td>
                        <td>{{ $withdrawal->jumlah_penarikan }}</td>
                        <td>{{ $withdrawal->no_rek }}</td>
                        <td>{{ $withdrawal->bank }}</td>
                        <td>
                            <form action="{{ url('admin/penarikan-saldo/konfirmasi/'. $withdrawal->id_penarikan) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="foto_bukti" class="form-control-file" onchange="document.getElementById('konfirmasiBtn').disabled = !this.value;">
                                <button id="konfirmasiBtn" type="submit" class="btn btn-success" disabled>Konfirmasi</button>
                            </form>
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection