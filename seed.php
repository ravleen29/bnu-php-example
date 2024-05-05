<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");



//check where we are logged in
if (isset($_SESSION['id'])) {

//build INSERT query
//run query
//x5

$array_students = array(
   
    array(
        "studentid" => "20000001",
        "password" => "test",
        "firstname" => "Sam",
        "lastname" => "Smith",
        "DOB" => "1975-11-12",
        "house" => "25 Victoria Road",
        "town" => "High Wycombe",
        "county" => "Bucks",
        "country" => "UK",
        "postcode" => "HP11 1RT"
    ),
    array(
        "studentid" => "20000002",
        "password" => "test",
        "firstname" => "Michael",
        "lastname" => "Smith",
        "DOB" => "1980-11-22",
        "house" => "28 Victoria Road",
        "town" => "High Wycombe",
        "county" => "Bucks",
        "country" => "UK",
        "postcode" => "HP11 1RT"
    ),
    array(
        "studentid" => "20000003",
        "password" => "test",
        "firstname" => "Jon",
        "lastname" => "Carlson",
        "DOB" => "1973-11-10",
        "house" => "30 Victoria Road",
        "town" => "High Wycombe",
        "county" => "Bucks",
        "country" => "UK",
        "postcode" => "HP11 1RT"
    ),
    array(
        "studentid" => "20000004",
        "password" => "test",
        "firstname" => "John",
        "lastname" => "Carlson",
        "DOB" => "1970-11-10",
        "house" => "32 Victoria Road",
        "town" => "High Wycombe",
        "county" => "Bucks",
        "country" => "UK",
        "postcode" => "HP11 1RT"
    ),
    array(
        "studentid" => "20000005",
        "password" => "test",
        "firstname" => "Jon",
        "lastname" => "Smith",
        "DOB" => "1974-11-10",
        "house" => "23 Victoria Road",
        "town" => "High Wycombe",
        "county" => "Bucks",
        "country" => "UK",
        "postcode" => "HP11 1RT"
    )
);



foreach($array_students as $key => $student_array){

    $studentid = $student_array['studentid'];
    $password = $student_array['password'];
    $firstname = $student_array['firstname'];
    $lastname = $student_array['lastname'];
    $DOB = $student_array['DOB'];
    $house = $student_array['house'];
    $town = $student_array['town'];
    $county = $student_array['county'];
    $country = $student_array['country'];
    $postcode = $student_array['postcode'];

    $sql = "INSERT INTO student (studentid, password, firstname, lastname, DOB, house, town, county, country, postcode) 
    VALUES ('$studentid', '$password', '$firstname', '$lastname', '$DOB', '$house', '$town', '$county', '$country', '$postcode');";
    $result = mysqli_query($conn, $sql);


/*
for($i=0; $i < 5; $i++){

$sql = "INSERT INTO student (firstname, lastname, column3, ...)
VALUES ('jon', 'smith', value3, ...);";


$result = mysqli_query($conn, $sql);

}*/ 

if ($result) {
    echo "Record inserted successfully:  $firstname $lastname<br>";
} else {
    echo "Error inserting record: " . mysqli_error($conn) . "<br>";
}
}
} 

   else {
    echo "You are not logged in.";
}
?>