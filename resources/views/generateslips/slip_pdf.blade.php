<!DOCTYPE html>
<html>
<head>
    <title>{{ $caller_name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: 'freeserif', 'normal';
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container mt-3">

        <div class="card">
            <div class="card-header text-center">
               <b><h3>Slip (स्लिप)</h3></b>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <th>Slip Date & Time (स्लिप तारीख आणि वेळ)</th>
                        <td>{{ $slip_date }} / {{ $slip_time }}</td>
                    </tr>
                    <tr>
                        <th>Caller Name (कॉलरचे नाव)</th>
                        <td>{{ $caller_name }}</td>
                    </tr>
                    <tr>
                        <th>Caller Mobile No (कॉलर मोबाईल क्र)</th>
                        <td>{{ $caller_mobile_no }}</td>
                    </tr>
                    <tr>
                        <th>Incident Location (घटनेचे ठिकाण)</th>
                        <td>{{ $incident_location_address }}</td>
                    </tr>
                    <tr>
                        <th>LandMark (लँडमार्क)</th>
                        <td>{{ $land_mark }}</td>
                    </tr>
                    <tr>
                        <th>Incident Reason (घटनेचे कारण)</th>
                        <td>{{ $incident_reason }}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
