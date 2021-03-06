<?php

use Helpers\EnrollmentDatabaseHelper;
use Helpers\TextHelper;

include("..\..\Helpers\EnrollmentDatabaseHelper.php");
include("..\..\Helpers\TextHelper.php");
include("..\..\Helpers\DatabaseHelper.php");
include("..\..\Objects\Enrollment.php");

session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Enrollment Edit</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

</head>
<body>
<!-- container -->
<div class="container">

    <div class="page-header">
    </div>
    <!--logout button-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">COMS3-MISIS</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#" onclick="showEnrollments()">Enrollments</a></li>
                    <li><a href="#" onclick="showCourses()">Courses</a></li>
                    <li><a href="#" onclick="showLog()">Log</a></li>
                    <li><a href="#" onclick="showMoodleCourses()" >Moodle Courses</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" onclick="logout()">Logout</a></li>
                </ul>

            </div>
        </div>
    </nav>

    <div>
        <?php
        $studentNo = isset($_GET['studentNo']) ? $_GET['studentNo'] : die('Error: User not found.');
        $unitCode = isset($_GET['unitCode']) ? $_GET['unitCode'] : die('Error: Unit code not found.');
        $enrollmentDatabaseHelper = new EnrollmentDatabaseHelper();
        $enrollment = $enrollmentDatabaseHelper->getEnrollment($studentNo, $unitCode);
        $textHelper = new TextHelper();
        echo "<h1 class='text-center'>Enrollment Edit: {$enrollment->getStudentNo()} - {$enrollment->getUnitCode()}</h1>" ?>
    </div>

    <!-- HTML read one record table will be here -->
    <!--we have our html table here where the record will be displayed-->
    <table id="table" class='table table-hover table-responsive '>
        <tr>
            <td>Name</td>
            <td><input id="name" class="form-control" type="text"
                       value="<?php echo $textHelper->getSpecialChars($enrollment->getName()) ?>"/></td>
        </tr>
        <tr>
            <td>Surname</td>
            <td><input id="surname" class="form-control" type="text"
                       value="<?php echo $textHelper->getSpecialChars($enrollment->getSurname()) ?>"/></td>
        </tr>
        <tr>
            <td>Class Section</td>
            <td>
                <?php
                // echo $code;
                switch ($enrollment->getClassSection()) {
                    case 'A':
                        echo '<select class="selectpicker" id="classSection"">
                                                <option value="A" selected>A</option>
                                                <option value="B" >B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                 </select>';
                        break;
                    case 'B':
                        echo '<select class="selectpicker" id="classSection">
                                                <option value="A">A</option>
                                                <option value="B" selected>B</option>
                                                <option value="C" >C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                 </select>';
                        break;
                    case 'C':
                        echo '<select class="selectpicker" id="classSection">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C" selected>C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                 </select>';
                        break;
                    case 'D':
                        echo '<select class="selectpicker" id="classSection">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D" selected>D</option>
                                                <option value="E">E</option>
                                                 </select>';
                        break;
                    case 'E':
                        echo '<select class="selectpicker" id="classSection">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E" selected>E</option>
                                                 </select>';
                        break;
                }

                ?>

        </tr>
        <tr>
            <td>Session</td>
            <td>
                <?php
                switch ($enrollment->getSession()) {
                    case 'SM1':
                        echo '<select class="selectpicker" id="session">
                                                    <option value="SM1" selected>SM1</option>
                                                    <option value="SM2">SM2</option></option>
                                               </select>';
                        break;
                    case 'SM2':
                        echo '<select class="selectpicker" id="session">
                                                    <option value="SM1">SM1</option>
                                                    <option value="SM2" selected>SM2</option></option>
                                               </select>';
                        break;
                }

                ?>

            </td>
        </tr>
        <tr>
            <td>Expiry Date</td>
            <td>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' id="expiryDate" class="form-control"
                           value="<?php echo $textHelper->getSpecialChars($enrollment->
                           getExpiryDate()); ?>" readonly/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <?php
                switch ($enrollment->getStatus()) {
                    case 'ENROLLED':
                        echo '<select class="selectpicker" id="status">
                                                    <option value="ENROLLED" selected>ENROLLED</option>
                                                    <option value="UNENROLLED">UN-ENROLLLED</option></option>
                                               </select>';
                        break;
                    case 'UNENROLLED':
                        echo '<select class="selectpicker" id="status">
                                                    <option value="ENROLLED">ENROLLED</option>
                                                    <option value="UN-ENROLLED" selected>UN-ENROLLLED</option></option>
                                               </select>';
                        break;
                }

                ?>

            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" onclick="doUpdate()" class="btn btn-primary">Update record</button>
                <a href='EnrollmentMasterView.php' class='btn btn-danger'>Back to Moodle users</a>
            </td>
        </tr>
    </table>


</div> <!-- end .container -->

<style>
    body {
        background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
    }

    #table {
        background-color: white;
    }
</style>

<script>


    $(function () {
        $('#datetimepicker1').datetimepicker({
            defaultDate: new Date(),
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true,
            ignoreReadonly: true
        });
    });

    function doUpdate() {
        if (isBlank()[0]) {
            var msg = isBlank()[1];
            alert(msg);
        } else {
            var id = 'id=' + <?php echo(json_encode($enrollment->getId()))?> +'&';
            var studentNo = 'studentNo=' + <?php echo(json_encode($enrollment->getStudentNo()))?> +'&';
            var name = 'name=' + document.getElementById("name").value + '&';
            var surname = 'surname=' + document.getElementById("surname").value + '&';
            var subject = 'subject=' + <?php echo(json_encode($enrollment->getSubject()))?> +'&';
            var unitCode = 'unitCode=' + <?php echo(json_encode($enrollment->getUnitCode()))?> +'&';
            var session = 'session=' + document.getElementById("session").value + '&';
            var classSection = 'classSection=' + document.getElementById("classSection").value + '&';
            var expiryDate = 'expiryDate=' + document.getElementById("expiryDate").value + '&';
            var status = 'status=' + document.getElementById('status').value;

            //send to php edit script
            window.location.href = '../WebAPI/Enrollments/EnrollmentUpdate.php?' + id + studentNo + name + surname + subject + unitCode + session + classSection + expiryDate + status;
        }
    }

    function isBlank() {
        var name = document.getElementById("name").value;
        var surname = document.getElementById("surname").value;

        //null checks
        if (name === "") {
            document.getElementById("name").focus();
            return [true, "Please insert a name."];
        }
        if (surname === "") {
            document.getElementById("surname").focus();
            return [true, "Please insert a surname."];
        }

        //TODO improve input validation
        //checking valid name and surname with certain special characters
        var format = /[ `!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?~0123456789]/;

        if (format.test(name) || name.length < 3) {
            document.getElementById("name").focus();
            return [true, "Please insert a valid name."]
        }
        //surnames can have spaces
        var format2 = /[`!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?~0123456789]/;
        if (format2.test(surname) || surname.length < 3) {
            document.getElementById("surname").focus();
            return [true, "Please insert a valid surname."]
        }
        return [false, "none"];
    }

</script>

<script>

    function showUpdate() {
        window.location.href = '../Sidebar/UpdateCourse.php';
    }

    function showCourses() {
        window.location.href = '../Courses/CourseMasterView.php';
    }

    function showLog() {
        window.location.href = '../Log/LogMasterView.php';
    }

    function showMoodleCourses() {
        window.location.href = "../Sidebar/UpdateCourse.php";
    }

    function logout() {
        window.location.href = "../WebAPI/Logout/logout.php";
    }
</script>

</body>
</html>