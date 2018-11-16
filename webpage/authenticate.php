<?php
        #                                 ===== USAGE =====
        #               POST or GET "username" and "password" forms to "IPv4 address"/loginAuthentication.php

        session_start();
        $_SESSION['error'] = 0;

        # use $_GET for URL data
        $username = $_GET["username"];
        $password = $_GET["password"];

        # use $_POST for other form data
        #$username = $_POST["username"];
        #$password = $_POST["password"];

        #printf("Attempting to login to %s with input password %s\n", $username, $password);

        $buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
        if ($buildr->connect_errno) {
                printf("Connection to database failed: %s\n", $buildr->connect_error);
                exit();
        }

        if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
                if ($row = $result->fetch_array()) {
                        #printf("User exists... Verifying passwords...\n");
                        $hashed_pass = $row['password'];
                        #printf("Returned hash: %s\n", $hashed_pass);
                        if (password_verify($password, $hashed_pass)) {
                                #echo "Password is valid!\n";
                                $fullResult = $row['email'] . "-" . $row['firstName'] . "-" . $row['lastName'];
                                #echo $fullResult;
                                session_destroy();
                                header('Location: dashboard.html');
                        } else {
                                #echo "Invalid password!\n";
                                $_SESSION['error'] = 1;
                                header('Location: login.html');
                        }
                        $result->close();
                } else {
                        #echo 2; # user was not found
                        $_SESSION['error'] = 1;
                        header('Location: login.html');
                        $result->close();
                }
        }
        $buildr->close();
?>