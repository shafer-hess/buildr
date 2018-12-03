<?php

    #GET Username from form
    $id = $_GET['delete'];

    #Set up database
    $buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
    if ($buildr->connect_errno) {
        printf("Connection to database failed: %s\n", $buildr->connect_error);
        exit();
    }

    #Create Query to check if user exists in table
    $check_query = "SELECT * FROM models WHERE id = \"$id\"";

    if($user = $buildr->query($check_query)) {
        if($row = $user->fetch_array()) {
            #User exists, perform delete query
            $delete_query = "DELETE FROM models WHERE id = \"$id\"";
            if($result = $buildr->query($delete_query)) {
                header('Location: dashboard.html#model');

            } else {
                header('Location: dashboard.html#model');
            }
        }
    } else {
        header('Location: dashboard.html#model');      
    }
?>
