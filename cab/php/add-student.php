<?php
    $mysql = new mysqli("localhost", "root", "root", "test");
    $mysql->query("SET NAMES 'utf8'");
    if (isset($_POST['submit'])) {

        $parent_lastname = $_POST['parent_lastname'];
        $parent_firstname = $_POST['parent_firstname'];
        $parent_middlename = $_POST['parent_middlename'];
        $parent_phone = $_POST['parent_phone'];
        $student_lastname = $_POST['student_lastname'];
        $student_firstname = $_POST['student_firstname'];
        $student_middlename = $_POST['student_middlename'];
        $student_phone = $_POST['student_phone'];
        $student_class = $_POST['student_class'];
        $study_format = $_POST['study_format'];
        $group_number = $_POST['group_number'];
        $subject_1 = $_POST['subject_1'];
        $subject_2 = $_POST['subject_2'];

        $mysql->query("INSERT INTO `users_php` (`parent_lastname`, `parent_firstname`, `parent_middlename`,
                                            `parent_phone`, `student_lastname`, `student_firstname`,
                                            `student_middlename`, `student_phone`, `student_class`,
                                            `study_format`, `group_number`, `subject_1`, `subject_2`) 
                                    VALUES($parent_lastname, $parent_firstname, $parent_middlename,
                                            $parent_phone, $student_lastname, $student_firstname,
                                            $student_middlename, $student_phone, $student_class,
                                            $study_format, $group_number, $subject_1, $subject_2)");
    }
    
    header("Location: /cab/add-student.php"); 
    exit(); // всегда пиши exit после редиректа, чтобы код ниже не выполнялся
    $mysql->close();
