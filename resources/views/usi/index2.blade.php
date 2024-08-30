<!DOCTYPE html>
<html>
<head>
    <title>Custom SQL Server Data</title>
</head>
<body>
    <h1>Custom SQL Server Data</h1>
    <table border="1" id="dataTable">
        <tr>
            <th>UserID</th>
            <th>UserName</th>
            <th>Email</th>
        </tr>
        @php
            $userArray = json_decode($userData, true);
        @endphp
        @foreach($userArray as $item)
        <tr>
            <td>{{ $item['UserID'] }}</td> 
            <td>{{ $item['UserName'] }}</td>
            <td>{{ $item['Email'] }}</td>
        </tr>
        @endforeach
    </table>
<br>
    <form id="addDataForm">
        @csrf
        <label for="UserID">UserID:</label>
        <input type="text" id="UserID" name="UserID" required>

        <label for="UserName">UserName:</label>
        <input type="text" id="UserName" name="UserName" required>

        <label for="Email">Email:</label>
        <input type="text" id="Email" name="Email" required>

        <label for="Level">Level:</label>
        <input type="text" id="Level" name="Level" required>

        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password" required>

        <button type="submit">Add Data</button>
    </form>
    <br>
    <div id="statusMessage"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addDataForm').on('submit', function(event) {
                event.preventDefault(); // Mencegah reload halaman

                $.ajax({
                    url: "{{ route('usi.addUser') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // Tampilkan pesan sukses
                        $('#statusMessage').html('<p>' + response.message + '</p>');

                        // Tambahkan data baru ke tabel
                        var newRow = '<tr><td>' + response.data.UserID + '</td><td>' + response.data.UserName + '</td><td>' + response.data.Email + '</td></tr>';
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