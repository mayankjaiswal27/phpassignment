<?php
require 'User.php';
function connectToDb()
{
    $pdo = new PDO(
        'mysql:host=127.0.0.1;port=3307;dbname=user_data',
        'root',
        '',
    );
    return $pdo;
}

function insertAll(PDO $pdo, string $table, string $class)
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $gender = ($_POST['gender']);
    $city = $_POST['city'];
    if ((ctype_alpha($fname)) && (ctype_alpha($lname)) && (filter_var($email, FILTER_VALIDATE_EMAIL)) && (!empty($gender)) && (!($city == ""))) {
        $statement = $pdo->prepare("INSERT INTO $table (Name, Email, Gender, City) VALUES ('$fname $lname', '$email','$gender','$city')");
        $statement->execute();
        echo 'Congratulations! ' . $fname . ' ' . $lname . '. Your Data has been successfully processed and added to the database.';
        echo '<br>';
        echo 'The details entered by you are as follows: ';
        echo '<br>';
        echo 'Name: ' . $fname . ' ' . $lname;
        echo '<br>';
        echo 'Email Address: ' . $email;
        echo '<br>';
        echo 'Gender: ' . $gender;
        echo '<br>';
        echo 'City: ' . $city;
        echo '<br>';
        echo '<a href="form.html">Back</a>';
        echo '<br>';
        echo '<a href="table.php">View Data Entries</a>';
        return $statement->fetchAll(PDO::FETCH_CLASS, $class);
    } else {
        if ((!(ctype_alpha($fname))) && (!(ctype_alpha($lname)))) {
            echo '<script> alert("Invalid Name")</script>';
            echo '<a href="form.html">Back to form</a>';
        } 
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            echo '<script> alert("Invalid Email")</script>';
            echo '<a href="form.html">Back to form </a>';
        }
        if (empty($gender)) {
            echo '<script> alert("Gender cannot be empty")</script>';
            echo '<a href="form.html">Back to form</a>';
        }
        if ($city == "") {
            echo '<script> alert("Please select a city")</script>';
            echo '<a href="form.html">Back to form</a>';
        }
    }
}
$pdo = connectToDb();
$tasks = insertAll($pdo, 'user', 'User');
