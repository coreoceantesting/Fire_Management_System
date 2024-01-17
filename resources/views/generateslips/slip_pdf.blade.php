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

        table, th, td {
  border: 1px solid black;
}
  </style>
</head>
<body>
    <div class="container mt-3">

      <div class="card">
        <div class="card-header">
          Slip
        </div>
        <div class="card-body">
          <ul>
            <li>Slip Date(स्लिप तारीख) : {{ $slip_date }}</li>
            <li>Caller Name(कॉलरचे नाव) : {{ $caller_name }}</li>
            <li>Caller Mobile No(कॉलर मोबाईल क्र) : {{ $caller_mobile_no }}</li>
            <li>Incident Location(घटनेचे ठिकाण) : {{ $incident_location_address }}</li>
            <li>LandMark(लँडमार्क) : {{ $land_mark }}</li>
            <li>Incident Reason(घटनेचे कारण) : {{ $incident_reason }}</li>
          </ul>
        </div>
      </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
