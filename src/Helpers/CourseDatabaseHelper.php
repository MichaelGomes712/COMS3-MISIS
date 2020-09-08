<?php


namespace Helpers;

use Objects\Course;

class CourseDatabaseHelper
{

    /**
     * @param Course $course
     */
    public static function insertCourse(Course $course)
    {
        $databaseHelper = new DatabaseHelper("coms3-misis");
        $databaseHelper->query("INSERT INTO courses (courseID, unitCode, courseName, syncFrequency) VALUES (:courseID, :unitCode, :courseName, :updateFrequency) ");
        $databaseHelper->bind(':courseID', $course->getCourseID());
        $databaseHelper->bind(':unitCode', $course->getUnitCode());
        $databaseHelper->bind(':courseName', $course->getCourseName());
        $databaseHelper->bind(':updateFrequency', $course->getUpdateFrequency());
        $databaseHelper->execute();
    }

    /**
     * @return array|int
     */
    public static function getAllCourses()
    {
        $databaseHelper = new DatabaseHelper("coms3-misis");
        $databaseHelper->query("SELECT DISTINCT * FROM courses ORDER BY unitCode, courseName");
        $result = $databaseHelper->resultSet();
        if ($databaseHelper->rowCount() == 0) {
            return 0;
        } else {
            return $result;
        }
    }

    /**
     * @return array|int
     */
    public static function getCourseList()
    {
        $databaseHelper = new DatabaseHelper("coms3-misis");
        $databaseHelper->query("SELECT DISTINCT unitCode FROM courses");
        $result = $databaseHelper->resultSet();
        if ($databaseHelper->rowCount() == 0) {
            return 0;
        } else {
            return $result;
        }
    }

    /**
     * @param $unitCode
     */
    public static function deleteCourse($unitCode)
    {
        $databaseHelper = new DatabaseHelper("coms3-misis");
        $databaseHelper->query("DELETE FROM courses WHERE unitCode = :unitCode");
        $databaseHelper->bind(':unitCode', $unitCode);
        $databaseHelper->execute();
    }

    /**
     * @param $ID
     */
    public static function deleteCourseWithID($ID)
    {
        $databaseHelper = new DatabaseHelper("coms3-misis");
        $databaseHelper->query("DELETE FROM courses WHERE courseID = :ID");
        $databaseHelper->bind(':ID', $ID);
        $databaseHelper->execute();
    }

    /**
     * @param $unitCode
     * @return int|Course
     */
    public static function getCourse($unitCode)
    {
        $databaseHelper = new DatabaseHelper("coms3-misis");
        $databaseHelper->query("SELECT * FROM courses WHERE unitCode = :unitCode LIMIT 0,1");
        $databaseHelper->bind(':unitCode', $unitCode);
        $course = $databaseHelper->single();
        if ($databaseHelper->rowCount() === 0) {
            return 0;
        }
        $newCourse = new Course($course['unitCode'], $course['courseID']);
        $newCourse->setCourseName($course['courseName']);
        return $newCourse;
    }

    /**
     * @param Course $course
     */
    public static function updateCourse(Course $course)
    {
        $databaseHelper = new DatabaseHelper("coms3-misis");
        $databaseHelper->query("UPDATE courses SET courseName = :courseName, courseID  = :courseID, syncFrequency = :updateFrequency WHERE (unitCode = :unitCode)");
        $databaseHelper->bind(':unitCode', $course->getUnitCode());
        $databaseHelper->bind(':courseID', $course->getCourseID());
        $databaseHelper->bind(':courseName', $course->getCourseName());
        $databaseHelper->bind(':updateFrequency', $course->getUpdateFrequency());
        $databaseHelper->execute();
    }
}