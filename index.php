<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bg-dark">
<div class="d-flex justify-content-center">
    <div class="w-75 bg-white p-4">
        <form method="post" action="insert.php?action=insert">
            <label>
                <select name="status">
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
                <br>
                <input name="list" type="text" placeholder="list">
                <br>
                <input name="task" type="text" placeholder="task">
            </label>

            <input type="submit" value="Add"/>
        </form>

        <hr>

        <div class="p-3">
            <h1>Tasks list</h1>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">List</th>
                    <th scope="col">Task</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                <?php
                require "datalayer.php";
                $tasks = getAllTasks();

                foreach ($tasks

                as $task) {
                ?>
                <tbody>
                <tr>
                    <th scope="row"><?= $task['id'] ?></th>
                    <td><?= $task['list'] ?></td>
                    <td><?= $task['task'] ?></td>
                    <td><?= $task['status'] ?></td>
                    <td><a type="button" href="edit.php?id=<?= $task['id'] ?>">Edit</a></td>
                    <td><a type="button" href="delete.php?action=delete?id=<?= $task['id'] ?>">Delete</a></td>
                </tr>
                </tbody>
                <?php
                }
                ?>
                </thead>
            </table>
        </div>
    </div>
</div>

<button type="button">remove</button>

</body>
</html>