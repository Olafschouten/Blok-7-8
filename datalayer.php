<?php
function dbConnect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "todo_list";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
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
    $query->execute();
    $result = $query->fetchAll();
    $conn = null;
    return $result;
}

function TaskInsert($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("INSERT INTO `task` (task_name, description, status) VALUES (:task_name, :description, :status)");
    $query->execute($data);
    $conn = null;
}

function delete($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("DELETE FROM `task` WHERE id = :id");
    $query->execute([':id' => $id]);
    $conn = null;
}