<?php

use Helpers\CourseDatabaseHelper;
use Objects\Course;
use Helpers\JSONHelper;

include("..\..\..\Helpers\CourseDatabaseHelper.php");
include("..\..\..\Helpers\DatabaseHelper.php");
include("..\..\..\Objects\Course.php");
include("..\..\..\Helpers\JSONHelper.php");

session_start();

$courseID = 0;
$courseName = isset($_GET['courseName']) ? $_GET['courseName'] : die('Error: Name not found.');
$unitCode = isset($_GET['unitCode']) ? $_GET['unitCode'] : die('Error: Unit code not found.');
$course = new Course($courseID, $courseName, $unitCode);
$courseDatabaseHelper = new CourseDatabaseHelper();

if ($_SESSION['admin'] == 1) {
    $courseDatabaseHelper->insertCourse($course);
    $JSONHelper = new JSONHelper();
    $JSONHelper->addCourseData($unitCode);
    header('Location: ../../Courses/CourseMasterView.php?action=created');

} else {
    header('Location: ../../Courses/CourseMasterView.php?action=deny');
}

