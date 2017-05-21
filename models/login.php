<?php

$alertmsg = "";

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT u.*, p.points, p.totalpoints FROM users u, points p WHERE u.username = '$username'";
    $rows = Query($conn, $sql, 1);
    if (password_verify($password, $rows["password"])) {
        if ($rows["closed"] == 0) {
            if ($rows["type"] == "admin") {
                $_SESSION['user'] = new Admin($rows["id"], $rows["type"], $rows["username"], $rows["description"], $rows["points"], $rows["totalpoints"], $rows["pin"]);
            } else {
                $_SESSION['user'] = new User($rows["id"], $rows["type"], $rows["username"], $rows["description"], $rows["points"], $rows["totalpoints"]);
            }
            $_SESSION['loggedin'] = "1";
            //$alertmsg = createAlert("success", "Woohoo!", "Your login was successful.");
            header("Location: index.php");
        } else {
            $alertmsg = createAlert("warning", "Ohh!", "Your account has been closed.");
        }
    } else {
        $alertmsg = createAlert("warning", "Oops!", "Your login credentials were incorrect, try again.");
    }
}

if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $verifypassword = $_POST['verifypassword'];

    if ($password == $_POST['verifypassword']) {
        $sql = "SELECT username FROM users WHERE username = '$username'";

        $result = Query($conn, $sql);

        if ($result->num_rows == 0) {
            if ($password == $verifypassword) {

                $encpassword = password_hash("$password", PASSWORD_DEFAULT);
                /*$sql = "INSERT INTO users (username, password) VALUES ('$username', '$encpassword')";

                $result = Query($conn, $sql);

                $sql = "INSERT INTO points (username, points, totalpoints) VALUES ('$username', 0, 0)";
                Query($conn, $sql);*/

                $result = Query($conn, "CALL createUser('$username', '$encpassword')");
                if ($result) {
                    $alertmsg = createAlert("success", "Woohoo!", "Your account was created successfully, you can now login.");
                }
            } else {
                $alertmsg = createAlert("danger", "Ohh!", "Something went wrong.");
            }
        } else {
            $alertmsg = createAlert("warning", "Oops!", "Username '$username' already exists.");
        }
    } else {
        $alertmsg = createAlert("warning", "Oops!", "Your passwords don't match.");
    }
}
?>
