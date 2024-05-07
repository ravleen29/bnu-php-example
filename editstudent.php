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
        // Check if an image is uploaded
        if (isset($_FILES['studentimage']) && $_FILES['studentimage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "uploads/";
            // Create the uploads directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = uniqid() . '_' . basename($_FILES["studentimage"]["name"]);
            $uploadPath = $uploadDir . $fileName;
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["studentimage"]["tmp_name"], $uploadPath)) {
                // Build the SQL query to update student details
                $sql = "UPDATE student SET password='$password', firstname='$firstname', lastname='$lastname', dob='$dob', house='$house', town='$town', county='$county', country='$country', postcode='$postcode', image='$uploadPath' WHERE studentid='$studentid'";
                // Execute the query
                $result = mysqli_query($conn, $sql);
                // Check if the query was successful
                if ($result) {
                    echo "Student updated successfully.";
                } else {
                    echo "Error updating student: " . mysqli_error($conn);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            // If no image is uploaded, update student details without image
            $sql = "UPDATE student SET password='$password', firstname='$firstname', lastname='$lastname', dob='$dob', house='$house', town='$town', county='$county', country='$country', postcode='$postcode' WHERE studentid='$studentid'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "Student updated successfully.";
            } else {
                echo "Error updating student: " . mysqli_error($conn);
            }
        }
    }
} else {
    // Fetch the student data based on the ID passed in the URL
    if (isset($_GET['id'])) {
        $studentid = $_GET['id'];
        $sql = "SELECT * FROM student WHERE studentid='$studentid'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Populate the form fields with the fetched student data
            $password = $row['password'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $dob = $row['dob'];
            $house = $row['house'];
            $town = $row['town'];
            $county = $row['county'];
            $country = $row['country'];
            $postcode = $row['postcode'];
            // Display the form
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Student</title>
            </head>
            <body>
                <h1>Edit Student</h1>
                <form action="editstudent.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value="<?php echo $password; ?>" required><br>
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" required><br>
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" required><br>
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" value="<?php echo $dob; ?>" required><br>
                    <label for="house">House:</label>
                    <input type="text" name="house" id="house" value="<?php echo $house; ?>" required><br>
                    <label for="town">Town:</label>
                    <input type="text" name="town" id="town" value="<?php echo $town; ?>" required><br>
                    <label for="county">County:</label>
                    <input type="text" name="county" id="county" value="<?php echo $county; ?>" required><br>
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" value="<?php echo $country; ?>" required><br>
                    <label for="postcode">Postcode:</label>
                    <input type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" required><br>
                    <label for="studentimage">Student Image:</label>
                    <input type="file" name="studentimage" id="studentimage"><br>
                    <input type="submit" value="Update Student">
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Student ID not specified.";
    }
}
?>
