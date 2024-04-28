<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi Akun</title>
</head>

<body>
    <p>
        Halo <b>{{ $details['nama'] }}</b>!
    </p>

    <p>
        Anda ingin melakukan ganti password akun dengan menggunakan email ini.
    </p>

    <p>
        Berikut adalah data anda:
    </p>

    <table>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{ $details['nama'] }}</td>
        </tr>

        <tr>
            <td>Website</td>
            <td>:</td>
            <td>{{ $details['website'] }}</td>
        </tr>


    </table>

    <center>
        <h3>
            Buka Link di bawah untuk melakukan verifikasi akun.
        </h3>
        <b style="color: blue">{{ $details['url'] }}</b>
    </center>

    <p>
        Terima kasih telah melakukan registrasi.
    </p>
</body>

</html>