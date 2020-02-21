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
SELECT task.list_id, lists.list_name, task.task_name, task.status, task.id
FROM task
INNER JOIN lists
ON task.list_id = lists.id");
    $query->execute();
    $conn = null;
    return $query->fetchAll();
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
SELECT * FROM lists
WHERE `id` = :id');
    $query->execute([':id' => $id]);
    $result = $query->fetch();
    $conn = null;
    return $result;
}

function GetTask($id)
{
    $conn = dbConnect();
    $query = $conn->prepare('
SELECT * FROM task
WHERE id = :id');
    $query->execute([':id' => $id]);
    $result = $query->fetch();
    $conn = null;
    return $result;
}

// ----------------- Update -----------------

function ListUpdate($data)
{
    $conn = dbConnect();
    $query = $conn->prepare('
UPDATE lists 
SET list_name = :list_name 
WHERE id=:id');
    $query->execute([':list_name' => $data['list_name'], ':id' => $data['id']]);
    $conn = null;
}

function TaskUpdate($data)
{
    $conn = dbConnect();
    $query = $conn->prepare('
UPDATE task 
SET task_name = :task_name 
WHERE id=:id');
    $query->execute([':task_name' => $data['task_name'], ':id' => $data['id']]);
    $conn = null;
}

// ----------------- Get specific tasks -----------------

function GetTasksFromList($id)
{
    $conn = dbConnect();
    $query = $conn->prepare('
SELECT * 
FROM task 
WHERE list_id=:list_id');
    $query->execute([':list_id' => $id]);
    $conn = null;
    return $query->fetchAll();
}

// ----------------- Error message -----------------

function showErrorMessage($msg)
{
    echo '<script type="javascript">alert("' . $msg . '")</script>';
}