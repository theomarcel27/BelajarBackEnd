<!DOCTYPE html>
<html>
<head>
    <title>Data Usi</title>
    
</head>
<body>
    <h1>Data Usi</h1>
    @php
        $userID = session('userID');
        $password = session('password');
        $level = session('level');
    @endphp

<label>User ID: {{ $userID }}</label><br>
<label>Level: {{ $level }}</label><br>
    <!-- Form untuk menambahkan data -->
    <form id="addDataForm">
        @csrf
        <label for="a">a:</label>
        <input type="text" id="a" name="a" required>

        <button type="submit">Add Data</button>
    </form>

    <div id="statusMessage"></div> <!-- Untuk menampilkan pesan status -->

    <h2>Existing Data</h2>
    <table border="1" id="dataTable">
        <tr>
            <th>a</th>
        </tr>
        @php
            // Dekode JSON menjadi array PHP
            $usiArray = json_decode($usiData, true);
        @endphp

        @foreach($usiArray as $data)
        <tr>
            <td>{{ $data['a'] }}</td> <!-- Sesuaikan dengan field yang ada -->
        </tr>
        @endforeach
    </table>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addDataForm').on('submit', function(event) {
                event.preventDefault(); // Mencegah reload halaman

                $.ajax({
                    url: "{{ route('usi.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // Tampilkan pesan sukses
                        $('#statusMessage').html('<p>' + response.message + '</p>');

                        // Tambahkan data baru ke tabel
                        var newRow = '<tr><td>' + response.data.a + '</td></tr>';
                        $('#dataTable').append(newRow);

                        // Kosongkan form
                        $('#addDataForm')[0].reset();
                    },
                    error: function(xhr) {
                        // Tampilkan pesan error
                        $('#statusMessage').html('<p>Error: ' + xhr.responseJSON.message + '</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>
