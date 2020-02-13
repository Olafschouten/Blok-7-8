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

function getAllLists()
{
    $conn = dbConnect();
    $query = $conn->prepare("SELECT * FROM `lists`");
    $query->execute();
    $result = $query->fetchAll();
    $conn = null;
    return $result;
}

function TaskInsert($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("INSERT INTO `task` (task_name, status) VALUES (:task_name, :status)");
    $query->execute($data);
    $conn = null;
}

function ListInsert($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("INSERT INTO `lists` (list_name) VALUES (:list_name)");
    $query->execute($data);
    $conn = null;
}

function ListDelete($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("DELETE FROM `lists` WHERE id = :id");
    $query->execute([':id' => $id]);
    $conn = null;
}

function TaskDelete($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("DELETE FROM `task` WHERE id = :id");
    $query->execute([':id' => $id]);
    $conn = null;
}

function ListEdit($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("DELETE FROM `lists` WHERE id = :id");
    $query->execute([':id' => $id]);
    $conn = null;
}

function TaskEdit($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("DELETE FROM `lists` WHERE id = :id");
    $query->execute([':id' => $id]);
    $conn = null;
}
