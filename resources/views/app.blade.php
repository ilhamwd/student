<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="app.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</head>
<body>
    <div class="container">

        <div class="card">
            <h2>Input siswa</h2>
            <span class="description">Masukkan data yang diperlukan sebagai berikut</span>
            <div style="height: 20px"></div>
            <form id="student_insertion_form">
                <input type="text" placeholder="Nama" required>
                <input type="text" placeholder="NIM" required>
                <input type="date" placeholder="Tanggal lahir" required>
                <button class="submit">Masukkan</button>
            </form>
            <div style="height: 10px"></div>
            <span class="error insert_error"></span>
        </div>
        <div class="card">
            <h2>Data siswa <button class="small" id="refresh_button">Reload</button></h2>
            <span class="description">Data semua siswa</span>
            <div style="height: 20px"></div>
            <table class="data" id="student_data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Tanggal lahir</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>

    <div class="card dialog student_update_dialog">
        <h2>Input siswa</h2>
        <span class="description">Masukkan data yang diperlukan sebagai berikut</span>
        <div style="height: 20px"></div>
            <form id="student_update_form">
                <input type="text" placeholder="Nama" required>
                <input type="text" placeholder="NIM" required>
                <input type="date" placeholder="Tanggal lahir" required>
                <button class="submit">Edit</button>
            </form><br />
            <button class="danger close_update_dialog">Batalkan</button>
            <div style="height: 10px"></div>
            <span class="error"></span>
        </div>
    <div class="overlay"></div>
</body>
</html>