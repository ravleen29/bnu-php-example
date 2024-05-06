<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Check if student data is received via POST
    if (isset($_POST['students']) && !empty($_POST['students'])) {
        // Loop over each student ID received via POST
        foreach ($_POST['students'] as $student_id) {
            // Sanitize the student ID to prevent SQL injection
            $student_id = mysqli_real_escape_string($conn, $student_id);
            // Build the SQL query to delete the student
            $sql = "DELETE FROM student WHERE studentid = '$student_id'";
            // Execute the query
            $result = mysqli_query($conn, $sql);
            // Check if the query was successful
            if ($result) {
                echo "Student with ID $student_id deleted successfully.<br>";
            } else {
                echo "Error deleting student with ID $student_id: " . mysqli_error($conn) . "<br>";
            }
        }
    } else {
        echo "No student selected for deletion.<br>";
    }
    // Redirect to student.php after processing
    header("Location: student.php");
} else {
    // Redirect to index.php if the user is not logged in
    header("Location: index.php");
}
?>
