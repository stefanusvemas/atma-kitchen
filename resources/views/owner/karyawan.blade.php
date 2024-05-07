@extends('owner/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Karyawan</h3>

            <div class="row justify-content-between">
                <div class="col">
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('owner/karyawan/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari karyawan...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-25">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Tanggal Bergabung</th>
                        <th>Gaji</th>
                        <th>Bonus</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawan as $item)
                    <tr>
                        <td scope="row">{{$item['nama']}}</td>
                        <td>{{$item['Jabatan']['nama']}}</td>
                        <td>{{$item['tgl_bergabung']}}</td>
                        <td>Rp. {{number_format($item['gaji'],2,",",".")}}</td>
                        <td>Rp. {{number_format($item['bonus'],2,",",".")}}</td>
                        <td><a href="{{url('/owner/karyawan/edit/'.$item['id_karyawan'])}}">Edit</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection