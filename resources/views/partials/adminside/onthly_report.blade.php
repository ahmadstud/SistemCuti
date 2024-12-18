{{-- File: resources/views/pdf/all_applications.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Keseluruhan Permohonan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h3>Senarai Keseluruhan Permohonan</h3>
    <table>
        <thead>
            <tr>
                <th>BIL</th>
                <th>NAMA</th>
                <th>JAWATAN</th>
                <th>TARIKH MULA</th>
                <th>TARIKH AKHIR</th>
                <th>JUMLAH HARI</th>
                <th>ULASAN</th>
                <th>JENIS CUTI</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allApplications as $index => $application)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $application->user->name }}</td>
                <td>{{ $application->user->role == 'staff' ? 'Staf' : 'Pegawai' }}</td>
                <td>{{ \Carbon\Carbon::parse($application->start_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($application->end_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($application->start_date)->diffInDays(\Carbon\Carbon::parse($application->end_date)) + 1 }}</td>
                <td>{{ $application->reason }}</td>
                <td>{{ $selectedLeaveTypes[$application->id] ?? 'Tiada Cuti Dipilih' }}</td>
                <td>{{ ucfirst($application->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
