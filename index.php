<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Organisasi XXX</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="app">
        <select id="monthSelect" onchange="loadData()">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>

        <div id="calendar" class="calendar"></div>

        <script src="script.php"></script>
    </div>
</body>
</html>

