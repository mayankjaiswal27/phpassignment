<?php
require 'User.php';
function selectAll(PDO $pdo, string $table, string $class)
{
    $statement = $pdo->prepare('select * from ' . $table);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS, $class);
}
function connectToDb()
{
    $pdo = new PDO(
        'mysql:host=127.0.0.1;port=3307;dbname=user_data',
        'root',
        '',
    );
    return $pdo;
}
$pdo = connectToDb();
$data = selectAll($pdo, 'user', 'User');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entries</title>
    <link rel="stylesheet" href="table.css">

</head>

<body>
    <a href="form.html" style="position: absolute; top: 10px; left: 10px;"><img src="Images/back.png" alt="back" class="back"></a>
    <p style="position: absolute; top: 48px; left: 18px;">back</p>
    <table border="1" class="table">

        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>City</th>
        </tr>
        <?php

        foreach ($data as $user) {
            echo '<tr>';
            echo '<td>';
            echo $user->id;
            echo '</td>';
            echo '<td>';
            echo $user->name;
            echo '</td>';
            echo '<td>';
            echo $user->email;
            echo '</td>';
            echo '<td>';
            echo $user->gender;
            echo '</td>';
            echo '<td>';
            echo $user->city;
            echo '</td>';
            echo '</tr>';
        }
        ?>

    </table>

</body>

</html>