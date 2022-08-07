<?php

require_once dirname(__FILE__, 2) . "/model/db_config.php";

function insertStudent($name, $email, $phone, $password, $aiub_nid_id, $h_id = "")
{
    $hid = "";
    if (empty($h_id)) {
        $hid = "'$h_id'";
    } else {
        $hid = "NULL";
    }

    $query = "INSERT INTO students (id, name, email, phone, password, aiub_nid_id, h_id) VALUES (NULL, '$name', '$email', '$phone', '$password', '$aiub_nid_id', $hid)";

    // echo '<pre>';
    // var_dump(($query));
    // echo '</pre>';
    // return;


    return execute($query);
}

function getAllStudents()
{
    $query = "SELECT * FROM students";
    $result = get($query);
    return $result;
}

function getStudent($email)
{
    $query = "SELECT * FROM students WHERE email = '$email'";
    $result = get($query);
    // echo '<pre>';
    // var_dump(($result));
    // echo '</pre>';
    if (count($result) === 0)
        return NULL;
    return $result[0];
}
function getStudentbyID($id)
{
    $query = "SELECT * FROM students WHERE id = '$id'";
    $result = get($query);
    // echo '<pre>';
    // var_dump(($result));
    // echo '</pre>';
    if (count($result) === 0)
        return NULL;
    return $result[0];
}

function updateProfile($id, $name, $phone, $aiub_nid_id)
{
    $query = "UPDATE students SET name = '$name', phone = '$phone', aiub_nid_id = '$aiub_nid_id' WHERE id = '$id'";
    return execute($query);
}

function deleteStudent($id)
{
    $query = "DELETE FROM students WHERE id = '$id'";
    return execute($query);
}

function verifyStudent($id)
{
    $query = "UPDATE students SET verify = 1 WHERE id = '$id'";
    return execute($query);
}

function rentHouse($s_id, $h_id)
{
    require_once "HouseController.php";

    if (getHouse($h_id, 0) === NULL) {
        return false;
    }

    if (execute("UPDATE students SET h_id = '$h_id' WHERE id = '$s_id'") && execute("UPDATE houses SET status = 1 WHERE id = '$h_id';")) {
        return true;
    }
    return false;
}

function leaveHouse($s_id, $h_id)
{
    require_once "HouseController.php";

    if (getHouse($h_id, 1) === NULL) {
        return false;
    }
    if (execute("UPDATE students SET h_id = NULL WHERE id = '$s_id'") && execute("UPDATE houses SET status = 0 WHERE id = '$h_id';")) {
        return true;
    }
    return false;
}

function changeStudentPassword($email, $prev_pass, $new_pass)
{
    $student = getStudent($email);
    // echo '<pre>';
    // var_dump($email, $prev_pass, $new_pass, $student, $student['password'] === $prev_pass, $prev_pass);
    // echo '</pre>';
    // return false;
    if ($student['password'] === $prev_pass) {

        $query = "UPDATE students SET password = '$new_pass' WHERE email = '$email'";

        return execute($query);
    }

    return false;
}
