@extends('owner/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Absensi</h3>

            <form action="{{url('/absensi')}}">
                <div class="row justify-content-between">
                    <div class="col">
                    </div>
                    <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    </div>
                </div>
                <hr>
                <p>Silahkan Pilih Bulan untuk melihat Absensi Karyawan</p>
                <div class="row">
                    <div class="col">
                        <select class="form-select" aria-label="Select Month" name="month">
                            <option selected>Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Enter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</main>

@endsection