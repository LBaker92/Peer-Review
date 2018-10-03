<?php
include_once '../lib/gateways/GatewayHandler.class.php';

$gateHandler = new GatewayHandler();

echo "<h1>STUDENT TABLE GATEWAY TESTS</h1>";

$studentgate = $gateHandler->getStudentGate();

echo "<h3>findById(1)</h3>";
$student = $studentgate->findById(1);
print_r($student);
echo "<br>";

echo "<h3>findById(2)</h3>";
$student = $studentgate->findById(3);
print_r($student);
echo "<br>";

echo "<h3>findAll()</h3>";
$students = $studentgate->findAll();
if (!empty($students)) {
    foreach($students as $student) {
        print_r($student);
        echo "<br>";
    }
}
else {
    echo "<br>";
}

echo "<h3>findByEmail()</h3>";
$student = $studentgate->findByEmail("lbaker38@kent.edu");
print_r($student);
echo "<br>";

echo "<h1>TESTING INSTRUCTOR GATEWAY</h1>";

$instructorGate = $gateHandler->getInstructorGate();

echo "<h3>findByID(1)</h3>";
$instructor = $instructorGate->findById(1);
print_r($instructor);
echo "<br>";

echo "<h3>findByEmail(lbaker38@kent.edu)</h3>";
$instructor = $instructorGate->findByEmail("lbaker38@kent.edu");
print_r($instructor);
echo "<br>";

echo "<h3>findAll()</h3>";
$instructors = $instructorGate->findAll();
if (!empty($instructors)) {
    foreach($instructors as $instructor) {
        print_r($instructor);
        echo "<br>";
    }
}

echo "<h1> ADMIN SETTINGS GATEWAY </h1>";

$settinggate = $gateHandler->getAdminSettingsGate();

echo "<h3>getAllSettings()</h3>";
$settings = $settinggate->getAllSettings();
var_dump($settings);
echo "<br>";

echo "<h3>GetRosterLoaded()</h3>";
$roster_loaded = $settinggate->getRosterLoaded();
var_dump($roster_loaded);


?>