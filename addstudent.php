<?php
    // Include necessary PHP files
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve form data if available
        $studentid = isset($_POST['studentid']) ? $_POST['studentid'] : '';
        $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
        $house = isset($_POST['house']) ? $_POST['house'] : '';
        $town = isset($_POST['town']) ? $_POST['town'] : '';
        $county = isset($_POST['county']) ? $_POST['county'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : '';


        // Check if all fields are filled
        if (!$studentid || !$password || !$firstname || !$lastname || !$dob || !$house || !$town || !$county || !$country || !$postcode) {
            echo "All fields are required.";
        } else {
            // Build the SQL query to insert student details
            $sql = "INSERT INTO student (studentid, password, firstname, lastname, dob, house, town, county, country, postcode) 
                    VALUES ('$studentid', '$password', '$firstname', '$lastname', '$dob', '$house', '$town', '$county', '$country', '$postcode')";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check if the query was successful
            if ($result) {
                echo "Student added successfully.";
            } else {
                echo "Error adding student: " . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Student</title>
<script>
// JavaScript function to show confirmation dialog
function confirmAddStudent() {
    // Display a confirmation dialog
    var confirmMsg = "Are you sure you want to add this student?";
    return confirm(confirmMsg);
}
</script>
</head>
<body>

<form action="addstudent.php" method="post" onsubmit="return confirmAddStudent();">
    <label for="studentid">Student ID:</label>
    <input type="text" name="studentid" id="studentid" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>
    <label for="firstname">First Name:</label>
    <input type="text" name="firstname" id="firstname" required><br>
    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" id="lastname" required><br>
    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" required><br>
    <label for="house">House:</label>
    <input type="text" name="house" id="house" required><br>
    <label for="town">Town:</label>
    <input type="text" name="town" id="town" required><br>
    <label for="county">County:</label>
    <input type="text" name="county" id="county" required><br>
    <label for="country">Country:</label>
    <input type="text" name="country" id="country" required><br>
    <label for="postcode">Postcode:</label>
    <input type="text" name="postcode" id="postcode" required><br>
    <input type="submit" value="Add Student">
</form>

</body>
</html>

