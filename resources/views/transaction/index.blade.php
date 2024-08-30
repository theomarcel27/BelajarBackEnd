<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form id="searchForm">
        @csrf
        <label for="UserID">UserID:</label>
        <input type="text" id="UserID" name="UserID" required>
        <button type="submit">Cari</button>
    </form>
<br>
    <table border="1" id="combinedData">
        <thead>
            <tr>
                <th>TransactionID</th>
                <th>TransactionDate</th>
                <th>UserID</th>
                <th>UserName</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data akan dimasukkan di sini oleh jQuery -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function() {
            $('#searchForm').on('submit', function(event) {
                event.preventDefault(); // Mencegah reload halaman

                $.ajax({
                    url: "{{ route('transaction.getData') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // Kosongkan tabel sebelumnya
                        $('#combinedData tbody').empty();

                        // Masukkan data gabungan ke tabel
                        $.each(response, function(index, data) {
                            $('#combinedData tbody').append(
                                '<tr><td>' + data.transactionID + '</td><td>' + data.transactionDate + '</td><td>' + data.UserID + '</td><td>' + data.UserName + '</td><td>' + data.Email + '</td></tr>'
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
</body>
</html>