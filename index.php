<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TODO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bg-dark">
<div class="d-flex justify-content-center">
    <div class="w-75 bg-white p-4">
        <h1>Add list and task</h1>
        <form method="post" action="route.php?url=list/add">
            <label>
                <p>List name: <input name="list_name" type="text" placeholder="List name" required></p>
            </label>
            <input type="submit" value="Add"/>
        </form>

        <form method="post" action="route.php?url=task/add">
            <label>
                <p>Task name: <input name="task_name" type="text" placeholder="Task name" required></p>
                <br>
                <p>Status: <select name="status" required>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                    </select></p>
                <?php require "datalayer.php";
                $lists = GetAllLists(); ?>
                <p>In list: <select name="list_id" required>
                        <?php foreach ($lists as $list) { ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['list_name']; ?></option>
                        <?php } ?>
                    </select></p>
            </label>
            <input type="submit" value="Add"/>
        </form>

        <hr>

        <div class="p-3">
            <h1>Tasks</h1>
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
                <?php $tasks = getAllTasks();
//                var_dump($tasks);
                if (!empty($tasks)) {
                foreach ($tasks

                as $task) { ?>
                <tbody>
                <tr>
                    <th scope="row"><?= $task['id'] ?></th>
                    <td><?= $task['list_name'] ?></td>
                    <td><?= $task['task_name'] ?></td>
                    <td><?= $task['status'] ?></td>
                    <td><a type="button" href="editTask.php?id=<?= $task['id'] ?>">Edit</a></td>
                    <td><a type="button" href="route.php?url=task/task/<?= $task['id'] ?>">Delete</a></td>
                </tr>
                </tbody>
                <?php }
                } else { ?>
                    <tbody>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">None</th>
                        <th scope="col">None</th>
                        <th scope="col">None</th>
                        <th scope="col">None</th>
                    </tr>
                    </tbody>
                <?php } ?>
                </thead>
            </table>

            <hr>

            <?php
            foreach ($lists as $list) {
                ?>
                <button class="accordion"><?= $list['list_name'] ?></button>
                <div class="panel" style="display: none">
                    <?php

                    $test = GetTaskFromList($list['id']);
                    var_dump($test);
                    ?>
                </div>

                <hr>
                <?php
            }
            ?>

            <script>
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function () {
                        this.classList.toggle("active");
                        var panel = this.nextElementSibling;
                        if (panel.style.display === "block") {
                            panel.style.display = "none";
                        } else {
                            panel.style.display = "block";
                        }
                    });
                }
            </script>

            <h1>Lists</h1>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lists</th>
                    <th></th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                <?php $lists = getAllLists();

                if (!empty($lists)) {
                foreach ($lists

                as $list) { ?>
                <tbody>
                <tr>
                    <th scope="row"><?= $list['id'] ?></th>
                    <td><?= $list['list_name'] ?></td>
                    <td></td>
                    <td><a type="button" href="editList.php?id=<?= $list['id'] ?>">Edit</a></td>
                    <td><a type="button" href="route.php?url=list/delete/<?= $list['id'] ?>">Delete</a></td>
                </tr>
                </tbody>

                <?php }
                } ?>
                </thead>
            </table>
        </div>
    </div>
</div>

</body>
</html>