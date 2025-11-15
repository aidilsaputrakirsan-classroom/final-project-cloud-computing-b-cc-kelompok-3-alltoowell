<h2>Data Booking</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>

    @foreach ($bookings as $b)
    <tr>
        <td>{{ $b['id'] }}</td>
        <td>{{ $b['nama'] }}</td>
        <td>{{ $b['tanggal'] }}</td>
        <td>{{ $b['status'] }}</td>
    </tr>
    @endforeach
</table>

