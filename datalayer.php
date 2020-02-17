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

// ----------------- Get All -----------------

function getAllTasks()
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT task.lists_id, lists.list_name, task.task_name, task.status, task.id
FROM task
INNER JOIN lists
ON task.lists_id = lists.id");
    $query->execute();
    $result = $query->fetchAll();
    $conn = null;
    return $result;
}

function getAllLists()
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT * 
FROM lists");
    $query->execute();
    $result = $query->fetchAll();
    $conn = null;
    return $result;
}

// ----------------- Insert -----------------

function TaskInsert($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("
INSERT INTO task (task_name, status, list_id) 
VALUES (:task_name, :status, :list_id)");
//    '".implode("','", $data)."'
    $query->execute($data);
    $conn = null;
}

function ListInsert($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("
INSERT INTO lists (list_name) 
VALUES (:list_name)");
    $query->execute($data);
    $conn = null;
}

// ----------------- Delete -----------------

function ListDelete($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("
DELETE FROM lists
WHERE id = :id");
    $query->execute([':id' => $id]);
    $conn = null;
}

function TaskDelete($id)
{
    $conn = dbConnect();
    $query = $conn->prepare("
DELETE FROM task 
WHERE id = :id");
    $query->execute([':id' => $id]);
    $conn = null;
}

// ----------------- Get -----------------

function GetList($id)
{
    $conn = dbConnect();
    $query = $conn->prepare('
SELECT * FROM lists WHERE `id` = :id');
    $query->execute([':id' => $id]);
    $result = $query->fetchAll();
    $conn = null;
    return $result;
}

function GetTask($id)
{
    $conn = dbConnect();
    $query = $conn->prepare('
SELECT * FROM task WHERE id = :id');
    $query->execute([':id' => $id]);
    $result = $query->fetchAll();
    $conn = null;
    return $result;
}

// ----------------- Update -----------------

function ListUpdate($id)
{
    $conn = dbConnect();
    $query = $conn->prepare('
UPDATE lists 
SET list_name = :list_name 
WHERE id=:id');
    $query->execute([':id' => $id]);
    $conn = null;
}

function TaskUpdate($id)
{
    $conn = dbConnect();
    $query = $conn->prepare('
UPDATE task 
SET task_name = :task_name 
WHERE id=:id');
    $query->execute([':id' => $id]);
    $conn = null;
}

// ----------------- Get specific tasks -----------------

function GetTaskFormList($id)
{
    $conn = dbConnect();
    $query = $conn->prepare('
SELECT * 
FROM task 
WHERE lists_id=:lists_id');
    $query->execute([':lists_id' => $id]);
    $conn = null;
}