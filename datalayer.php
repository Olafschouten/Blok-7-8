<?php
function dbConnect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "todo_list";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getAllTasks()
{
    $conn = dbConnect();
    $query = $conn->prepare("SELECT * FROM `task`");

    if ($query->execute()) {
        $result = $query->fetchAll();
        $conn = null;
        return $result;
    } else {
        $message = "Oeps! Er is iets fout gegaan, probeer het opnieuw.";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
    }
}

function getTask($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("SELECT * FROM `todo-items` WHERE `id` = :id");

    if ($query->execute([':id' => $id])) {
        $result = $query->fetch();
        $conn = null;
        return $result;
    } else {
        $message = "Oeps! Er is iets fout gegaan, probeer het opnieuw.";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
    }
}

function insert($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("INSERT INTO `task` (list, task, status) VALUES ('" . implode("','", $data) . "')");

    if ($query->execute()) {
        $message = "Succesvol toegevoegd!";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
        $conn = null;
    } else {
        $message = "Oeps! Er is iets fout gegaan, probeer het opnieuw.";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
    }
}

function update($data)
{
    $conn = dbConnect();
    $query = $conn->prepare('UPDATE `task` SET list = :list, task = :task, status = :status WHERE id=:id');

    if ($query->execute([':list' => $data['list'], ':task' => $data['task'], ':user' => $data['user'], ':status' => $data['status'], ':id' => $data['id']])) {
        $message = "Succesvol aangepast!";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
        $conn = null;
    } else {
        $message = "Oeps! Er is iets fout gegaan, probeer het opnieuw.";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
    }
}

function delete($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("DELETE FROM `task` WHERE id = :id");

    if ($query->execute([':id' => $id])) {
        $message = "Succesvol verwijderd!";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
        $conn = null;
    } else {
        $message = "Oeps! Er is iets fout gegaan, probeer het opnieuw.";
        echo "<script type='text/javascript'>alert('$message'); window.location='index.php';</script>";
    }
}