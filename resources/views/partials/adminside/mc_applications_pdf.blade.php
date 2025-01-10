<!DOCTYPE html>
<html>
<head>
    <title>MC Applications PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>MC Applications List</h1>
    <table>
        <thead>
            <tr>
                <th>Bil</th>
                <th>Nama</th>
                <th>Jenis Cuti</th>
                <th>Tarikh Cuti</th>
                <th>Ulasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $application->user->name }}</td>
                    <td>{{ $application->leave_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($application->start_date)->format('d/m/Y') }} sehingga {{ \Carbon\Carbon::parse($application->end_date)->format('d/m/Y') }}</td>
                    <td>{!! $application->reason ?? '<p class="text-m text-secondary">Tiada ulasan</p>' !!}</td>
                    <td>{{ $application->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
