@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Bahan Baku Yang kurang</h3>

            <div class="row justify-content-between">
                <div class="col">

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Kekurangan Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bahanBakuKurang as $bbk)
                    <tr>
                        <td scope="row">{{$bbk['nama']}}</td>
                        <td>{{$bbk['stok']}}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection