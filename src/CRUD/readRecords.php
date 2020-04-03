<?php
include 'database.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
// if it was redirected from delete.php
if ($action == 'deleted') {
    echo "<div class='alert alert-success' id='message'>Record was deleted.</div>";
}

if ($action == 'deny') {
    echo "<div class='alert alert-success' id='message'>You don't have permission to edit the database.</div>";
}


if ($action == 'created') {
    echo "<div class='alert alert-success' id='message'>User record was created.</div>";
}

echo "Filter by course code: ";
echo "<select id='ClassList' class='selectpicker list' name='ClassList' onChange='changeClasses()'>";
echo"<option selected='selected' name='All'>All</option>";
$querySubjects = "SELECT DISTINCT subject FROM enrollments";
$stmt = $dbh->prepare($querySubjects); //issue
$stmt ->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $item = $row['subject'];
    echo"<option name='$item' value=$item>'$item'</option>";
}
echo "</select>";
//end of select
//search for user
echo  "<div class='topnav'>
       <input class='form-control' id='searchBar' type='text' placeholder='Search for user...' onkeyup='findUser()'>
       <div class='createHold'><button class='btn btn-success' onclick='showCreate()'>Create New User</button></div>
       </div>";

//add create button
//echo "<div class='btnCreate'><button class='btn' onclick='showCreate()'>Create User</button></div>";


$data = "SELECT * FROM enrollments";
$stmt = $dbh->prepare($data); //issue
$stmt ->execute();
$numRows = $stmt->rowCount();

if ($numRows>0){
    //code to create database table
    echo"<div class='scrollit'>";
    echo "<table id='tableData' class='table table-hover table-responsive table-bordered'>";
    //start table
    //creating our table heading

    echo "<tr>";
    //add echos for table fields from database
    echo "<th>Student Number</th>";
    echo "<th>Name</th>";
    echo "<th>Surname</th>";
    echo "<th>Subject</th>";
    echo "<th>Expiry Date</th>";
    echo "</tr>";


    //add table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        //create new table row per record
        echo "<tr>";
        echo "<td>{$row['studentNo']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['surname']}</td>";
        echo "<td>{$row['subject']}</td>";
        echo "<td>{$row['expiryDate']}</td>";

        $user = $row['studentNo'];
        $sub = $row['subject'];
        $arr = array($user,$sub);
        $sendVar = json_encode($arr);
        //issue in returning 2 variables to javascript

        //add more columns for td
        echo "<td>";
        // read one record for this user
        echo "<a href='ReadOne.php?studentNo={$row['studentNo']}' class='btn btn-info m-r-1em'>Read</a>";

        // link for deleting this user
        echo "<a onclick='showDelete({$sendVar});' class='btn btn-danger'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}

