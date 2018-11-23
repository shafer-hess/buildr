<?php

    ############# TODO: echo divs on html page on reload #############

    session_start();
    $_SESSION['error'] = -1;

    #GET Username from form
    $username = $_GET['username'];

    #Set up database
    $buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
    if ($buildr->connect_errno) {
        printf("Connection to database failed: %s\n", $buildr->connect_error);
        exit();
    }

    #Create Query to check if user exists in table
    $check_query = "SELECT * FROM user WHERE username = \"$username\"";

    if($user = $buildr->query($check_query)) {
        if($row = $user->fetch_array()) {
            #User exists, perform delete query
            $delete_query = "DELETE FROM user WHERE username = \"$username\"";
            if($result = $buildr->query($delete_query)) {
                $_SESSION['error'] = 0;
                header('Location: dashboard.html#users');

            } else {
                $_SESSION['error'] = 1;
                header('Location: dashboard.html#users');
            }
        }
    } else {
        $_SESSION['error'] = 2;
        header('Location: dashboard.html#users');      
    }
?>