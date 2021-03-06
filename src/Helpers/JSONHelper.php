<?php

namespace Helpers;

use Objects\Enrollment;

class JSONHelper
{

    /**
     * @param string $unitCode
     * @return bool
     */
    function updateCourseData(string $unitCode)
    {
        $enrollmentDatabaseHelper = new EnrollmentDatabaseHelper();
        $data = self::getVirtusCourseJSON($unitCode);
//        $enrollmentDatabaseHelper->deleteAllCourseEnrollments($unitCode);
        return self::parseEnrollmentJSON($data);
    }

    /**
     * @param string $unitCode
     * @return mixed
     */
    function getVirtusCourseJSON(string $unitCode)
    {
        $url = 'http://wims-service-user:w!im5-5erv1s-u5er@127.0.0.1:3128/wits-wims-services/wims/student/unitStudents/';
        $url = $url . $unitCode . '/';
        return json_decode(file_get_contents($url), true);
    }

    /**
     * @param array $json
     * @return bool
     */
    function parseEnrollmentJSON(array $json)
    {
        $success = false;
        $enrollmentDatabaseHelper = new EnrollmentDatabaseHelper();
        foreach ($json as $enrollmentJSON) {
            $enrollment = new Enrollment(0, $enrollmentJSON['studentNumber'], $enrollmentJSON['firstName'],
                $enrollmentJSON['surname'], $enrollmentJSON['subject'], $enrollmentJSON['unitCode'],
                $enrollmentJSON['sessionCode'], $enrollmentJSON['classSection'], $enrollmentJSON['expiryDate'],
                $enrollmentJSON['unitStatus']);

            $enrollmentDatabaseHelper->insertUniqueEnrollment($enrollment);
            $enrollmentDatabaseHelper->insertTempEnrollment($enrollment);
            $success = true;
        }
        $obsoleteEnrollments = $enrollmentDatabaseHelper->getAllEnrollmentsWhereNotInTemp();
        foreach ($obsoleteEnrollments as $obsoleteEnrollment) {
            $enrollmentDatabaseHelper->deleteEnrollment($obsoleteEnrollment['studentNumber'], $obsoleteEnrollment['unitCode']);
        }
        $enrollmentDatabaseHelper->deleteAllTempEnrollments();
        return $success;
    }

    /**
     * @param string $unitCode
     * @return bool
     */
    function addCourseData(string $unitCode)
    {
        $data = self::getVirtusCourseJSON($unitCode);
        return self::parseEnrollmentJSON($data);
    }

    /**
     * @param string $unitCode
     * @param string $courseId
     * @return bool
     */
    function addCourseDataTemp(string $unitCode)
    {
        $data = self::getVirtusCourseJSON($unitCode);
        return self::parseEnrollmentTempJSON($data);
    }

    /**
     * @param array $json
     * @return bool
     */
    function parseEnrollmentTempJSON(array $json)
    {
        $success = false;
        $enrollmentDatabaseHelper = new EnrollmentDatabaseHelper();
        foreach ($json as $enrollmentJSON) {
            $enrollment = new Enrollment(0, $enrollmentJSON['studentNumber'], $enrollmentJSON['firstName'],
                $enrollmentJSON['surname'], $enrollmentJSON['subject'], $enrollmentJSON['unitCode'],
                $enrollmentJSON['sessionCode'], $enrollmentJSON['classSection'], $enrollmentJSON['expiryDate'],
                $enrollmentJSON['unitStatus']);

            $enrollmentDatabaseHelper->insertTempEnrollment($enrollment);
            $success = true;
        }
        $obsoleteEnrollments = $enrollmentDatabaseHelper->getAllEnrollmentsWhereNotInTemp();
        foreach ($obsoleteEnrollments as $obsoleteEnrollment) {
            $enrollmentDatabaseHelper->deleteEnrollment($obsoleteEnrollment['studentNumber'], $obsoleteEnrollment['unitCode']);
        }
        return $success;
    }
}