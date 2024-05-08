<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // check if logged in
    if (isset($_SESSION['id'])) {
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");

        $sql = "SELECT * FROM student";
        $result = mysqli_query($conn, $sql);

        // Form to delete students
        echo "<form action='deletestudents.php' method='POST'>";
        echo "<table border='1'>";
        echo "<tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Images</th></tr>";
        
        // Display students in a table
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row["studentid"]}</td>";
            echo "<td>{$row["firstname"]}</td>";
            echo "<td>{$row["lastname"]}</td>";
            echo "<td>{$row["dob"]}</td>";
            echo "<td>{$row["house"]}</td>";
            echo "<td>{$row["town"]}</td>";
            echo "<td>{$row["county"]}</td>";
            echo "<td>{$row["country"]}</td>";
            echo "<td>{$row["postcode"]}</td>";

            if (!empty($row["image"])) {
               echo "<td><img src='{$row["image"]}' width='100'></td>";
           } else {
               echo "<td>No Image</td>";
           }

           echo "<td><a href='editstudent.php?id={$row['studentid']}'><button type='button'>Edit</button></a></td>";
           echo "<td><input type='checkbox' name='students[]' value='{$row['studentid']}'></td>";
           echo "</tr>";
            
        }
        echo "</table>";

        // Add Student Button
        echo "<a href='addstudent.php'><button type='button'>Add Student</button></a>";
        
        // Delete Student Button with JavaScript confirmation
        echo "<input type='submit' name='deletebtn' value='Delete' onclick='return confirmDelete()'>";
        echo "</form>";

        // JavaScript function for confirmation
        echo "<script>
                function confirmDelete() {
                    return confirm('Are you sure you want to delete selected student record(s)?');
                }
              </script>";

        // Render the template
        echo template("templates/default.php", $data);
    } else {
        header("Location: index.php");
    }

    echo template("templates/partials/footer.php");
?>
