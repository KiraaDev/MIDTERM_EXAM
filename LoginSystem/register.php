<?php
include_once("./connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['insert'])) {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $contact_number = $_POST['contact_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($first_name) || empty($last_name) || empty($contact_number) || empty($username) || empty($password)) {
        echo 'All fields are required!';

    } else {
        $check_username_sql = "SELECT username FROM user WHERE username = '$username'";

        $check_username_result = $conn->query($check_username_sql);

        if ($check_username_result->num_rows > 0) {
            echo "Username already exists";

        } else {

            $insert_user_sql = "INSERT INTO user (first_name, last_name, contact_number, username, password) VALUES ('$first_name', '$last_name' , '$contact_number', '$username', '$password')";

            $conn->query($insert_user_sql);

            header("Location: login.php");
            exit();
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100svh;
            flex-direction: column;
        }

        .form-control {
            margin: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.6);
            width: 400px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
            padding: 25px;
            border-radius: 8px;
        }

        .title {
            font-size: 28px;
            font-weight: 800;
        }

        .input-field {
            position: relative;
            width: 100%;
        }

        .input {
            margin-top: 15px;
            width: 100%;
            outline: none;
            border-radius: 8px;
            height: 45px;
            border: 1.5px solid #ecedec;
            background: transparent;
            padding-left: 10px;
        }

        .input:focus {
            border: 1.5px solid #2d79f3;
        }

        .input-field .label {
            position: absolute;
            top: 25px;
            left: 15px;
            color: #ccc;
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: 2;
        }

        .input-field .input:focus~.label,
        .input-field .input:valid~.label {
            top: 5px;
            left: 5px;
            font-size: 12px;
            color: #2d79f3;
            background-color: #ffffff;
            padding-left: 5px;
            padding-right: 5px;
        }

        .submit-btn {
            margin-top: 30px;
            height: 55px;
            background: #f2f2f2;
            border-radius: 11px;
            border: 0;
            outline: none;
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(180deg, #363636 0%, #1b1b1b 50%, #000000 100%);
            box-shadow: 0px 0px 0px 0px #ffffff, 0px 0px 0px 0px #000000;
            transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
            cursor: pointer;
        }

        .submit-btn:hover {
            box-shadow: 0px 0px 0px 2px #ffffff, 0px 0px 0px 4px #0000003a;
        }
    </style>
</head>

<body>

    <form class="form-control" action="" method="POST">
        <p class="title">Register</p>
        <div class="input-field">
            <input required class="input" type="text" name="fname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname'] ?>" />
            <label class="label" for="input">Enter First Name</label>
        </div>
        <div class="input-field">
            <input required class="input" type="text" name="lname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname'] ?>" />
            <label class="label" for="input">Enter Last Name</label>
        </div>
        <div class="input-field">
            <input required class="input" type="number" name="contact_number" value="<?php if(isset($_POST['contact_number'])) echo $_POST['contact_number'] ?>" />
            <label class="label" for="input">Enter Contact Number</label>
        </div>
        <div class="input-field">
            <input required class="input" type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" />
            <label class="label" for="input">Enter Username</label>
        </div>
        <div class="input-field">
            <input required class="input" type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" />
            <label class="label" for="input">Enter Password</label>
        </div>
        <input type="submit" value="Sign In" name="insert" class="submit-btn" />
        <div>
            <p>Already have an account?</p><a href="login.php">Login</a>
        </div>
    </form>
</body>

</html>