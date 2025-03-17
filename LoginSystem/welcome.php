<?php

include_once("./connection.php");

$get_users_query = "SELECT * FROM user";

$get_users_result = $conn->query($get_users_query);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_user'])) {
    $id = $_POST['id'];

    $delete_users_query = "DELETE FROM user WHERE id = '$id'";

    $conn->query(query: $delete_users_query);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100svh;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
            padding: 10px;
        }

        .confirmation {
            position: absolute;
            background-color: brown;
            z-index: 10;
        }
    </style>
</head>

<body>
    <h1>Welcome</h1>

    <!-- <div class="confirmation" style="display: none;">
        <h1>Are you sure?</h1>
        <button class="cancel">Cancel</button>
        <button type='submit' style='padding: 5px 20px 5px 20px; background-color: crimson; color: white; border: none'
            class='delete'>Delete</button>
    </div> -->


    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact No.</th>
            <th>Username</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($get_users_result->num_rows > 0) {
            while ($row = $get_users_result->fetch_assoc()) {
                echo " <tr>
                       <td>{$row['id']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                    <td style='display: flex; gap: 5px; align-items: center'>
                        <form method='POST' class='delete_form' onsubmit='return confirmSubmit()'>
                            <input type='hidden' name='id' value='{$row['id']}'/>
                            <button type='submit' 
                            style='padding: 5px 20px 5px 20px; background-color: crimson; color: white; border: none'
                            name='delete_user' id='delete_button' >Delete</button>
                        </form>
                            <form action='edit_user.php' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'/>
                            <button
                            name='edit_user'
                                  style='padding: 5px 20px 5px 20px; background-color: yellow; text-decoration: none'
                               >Edit</button>
                        </form>    
                    </td>
                   </tr> ";
            }

        }
        ?>
    </table>

    <a href="login.php">Logout</a>

    <script>
        function confirmSubmit(){
           return confirm("Are you sure to delete this user?")
        }
    </script>
</body>

</html>