<?php
session_start();

if(!$_POST['phone']) {
    header("Location: index.php");
    exit;
} else {
    $myDB = new mysqli("localhost","root","root","test_error");
    $myDB->query("SET NAMES `utf8`");

    $myTable = $myDB->query("SELECT * FROM `login`");
    while($row = $myTable->fetch_assoc()) {
        if($row['phone_number'] == $_POST['phone']) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['phone'] = $row['phone_number'];
            $_SESSION['id'] = $row['id'];
            header("Location: kab.php");
            exit;
        }
    }
    $myTable->data_seek(0);

    header("Location: index.php");
    exit;

    $myDB->close();
}