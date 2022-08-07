<?php

require_once dirname(__FILE__, 2) . "/model/db_config.php";

function insertAdmin($name, $email, $password)
{
    $query = "INSERT INTO admins (id, name, email, password) VALUES (NULL, '$name', '$email', '$password')";

    // echo '<pre>';
    // var_dump(($query));
    // echo '</pre>';
    // return;

    return execute($query);
}

function getAllAdmins()
{
    $query = "SELECT * FROM admins";
    $result = get($query);
    return $result;
}

function getAdmin($email)
{
    $query = "SELECT * FROM admins WHERE email = '$email'";
    $result = get($query);
    // echo '<pre>';
    // var_dump(($result));
    // echo '</pre>';
    if (count($result) === 0)
        return NULL;
    return $result[0];
}

function updateProfile($id, $name)
{
    $query = "UPDATE admins SET name = '$name' WHERE id = '$id'";
    return execute($query);
}

function getUnverifyStudents()
{
    $query = "SELECT * FROM students WHERE verify = 0";
    $result = get($query);
    // echo '<pre>';
    // var_dump(($result));
    // echo '</pre>';
    if (count($result) === 0)
        return NULL;
    return $result;
}

function getUnverifyHouseOwners()
{
    $query = "SELECT * FROM house_owners WHERE verify = 0";
    $result = get($query);
    // echo '<pre>';
    // var_dump(($result));
    // echo '</pre>';
    if (count($result) === 0)
        return NULL;
    return $result;
}
