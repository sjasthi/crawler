<?php
require "header.php";
require "data_table_support.php";

// ============== Variables ==============

// Bring in DB support.
require "db_fns.php";

// Column headers.
$col1 = "Name";
$col2 = "Email";

// Title.
$title = "User Admin";

// DB table used for this screen.
$dbTable = "users";

// Support for the 'DELETE' operation.
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if (isset($_GET['target_id'])) {
    $target_id = $_GET['target_id'];
}
$identity_column_name = "email";

// ============== Operations ==============

// Handle deleting items.
if (isset($action) && $action == "delete" && isset($target_id)) {

    // Connect to DB.
    $connect = db_connect();
    $connect->set_charset("utf8");
    if (mysqli_connect_errno()) {
        echo "<p>Error creating database connection: </p>";
        exit;
    }

    // Run delete query.
    $query = "DELETE FROM $dbTable WHERE $identity_column_name = '" . $target_id . "';";
    $re = $connect->query($query);
    if (!$re) {
        echo "An error occurred during the delete operation :{";
        exit;
    }
}

?>

<!-- HTML -->
<!DOCTYPE html>
<html>

<!-- Title -->
<title><?php echo $title; ?></title>

<!-- Table -->

<body class="body_background" style="line-height: 2.8">
    <div id="wrap">
        <div class="container">

            <!-- Table title -->
            <h3><?php echo $title; ?></h3>

            <table id="myDataTable" cellpadding="0" cellspacing="0" class="display table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <!-- Setting up columns -->
                        <?php
                        if (isset($col1)) {
                            echo "<th>$col1</th>";
                        }
                        if (isset($col2)) {
                            echo "<th>$col2</th>";
                        }
                        if (isset($col3)) {
                            echo "<th>$col3</th>";
                        }
                        ?>

                        <!-- Always display action column -->
                        <th>Action</th>

                    </tr>

                </thead>
                <tbody>

                    <!-- Load data -->
                    <?php

                    // Accessing DB...
                    $dbcn = db_connect();
                    $dbcn->set_charset("utf8");
                    if (mysqli_connect_errno()) {
                        echo "<p>Error creating database connection: </p>";
                        exit;
                    }

                    // Query DB.
                    $sql = "SELECT * FROM " . $dbTable;
                    $result = $dbcn->query($sql);
                    if (!$result) {
                        echo "Cannot Create Database";
                        exit;
                    }

                    // If 1 or more results returned...
                    $numRows = $result->num_rows;
                    if ($numRows > 0) {

                        // ...Print results as rows in the table.
                        for ($i = 0; $i < $numRows; $i++) {
                            $row = $result->fetch_array();
                            $name = $row[1] . ', ' . $row[0];
                            $email = $row[2];

                            print "
                                <tr>
                                    <td >$name</td>
                                    <td >$email</td>
                                    <td class='edit'><a href='edit_user.php?edit=$email&t=users'>edit</a> | <a href='user_admin.php?action=delete&target_id=$email'>delete</a></td>
                                </tr>";
                        }
                    }
                    // If no results were found in the DB...
                    else
                        echo "No results were found.";
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>