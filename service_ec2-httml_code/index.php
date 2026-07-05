<?php
$host = "datashield.cjoe0msqqk4v.ap-south-2.rds.amazonaws.com";
$user = "admin";
$password = "Sharath1";
$db = "datashield";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM metadata ORDER BY upload_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>DataShield Metadata Service</title>

<style>

body{
    font-family: Arial, sans-serif;
    background:#f4f7fa;
    margin:0;
}

.header{
    background:#0b5ed7;
    color:white;
    padding:25px;
    text-align:center;
}

.container{
    width:95%;
    margin:30px auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:8px;
    box-shadow:0px 0px 10px rgba(0,0,0,.2);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#0b5ed7;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:nth-child(even){
    background:#f8f8f8;
}

tr:hover{
    background:#eaf2ff;
}

.footer{
    text-align:center;
    margin:30px;
    color:gray;
    font-size:14px;
}

</style>

</head>

<body>

<div class="header">
<h1>DataShield Metadata Service</h1>
<p>Secure Metadata Dashboard</p>
</div>

<div class="container">

<div class="card">

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Department</th>
    <th>Address</th>
    <th>Upload Time</th>
</tr>

<?php

if($result && $result->num_rows > 0){

    while($row = $result->fetch_assoc()){

        echo "<tr>";

        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["phone"]."</td>";
        echo "<td>".$row["department"]."</td>";
        echo "<td>".$row["address"]."</td>";
        echo "<td>".$row["upload_time"]."</td>";

        echo "</tr>";
    }

}else{

    echo "<tr><td colspan='7'>No Metadata Found</td></tr>";

}

$conn->close();

?>

</table>

</div>

</div>

<div class="footer">
IT SkillNest - DataShield Project -2026
</div>

</body>
</html>