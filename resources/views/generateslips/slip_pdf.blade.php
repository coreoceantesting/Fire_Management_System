<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $caller_name }}</title>
    <style>
        body {
            font-family: 'freeserif', 'normal';
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            margin: 3rem;
        }

        .card {
            border: 1px solid #000;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            background-color: #fff;
            text-align: center;
            padding: 0.5rem;
            border-bottom: 1px solid #000;
        }

        .card-body table {
            width: 98%;
            border-collapse: collapse;
            /*margin-bottom: 20px;*/
            margin: 10px;
        }

        th, td {
/*            border: 1px solid #000;*/
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="card">
            <div class="card-header">
                <img src="https://upload.wikimedia.org/wikipedia/en/9/97/Panvel_Municipal_Corporation.png" alt="logo" width="150" height="100">
               <h4>पनवेल महानगरपालिका अग्निशमन सेवा</h4> 
                <h5>Slip (स्लिप)</h5>
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
</body>
</html>
