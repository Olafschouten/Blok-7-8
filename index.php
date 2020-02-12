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
            <label class="p-3">
                <input class="m-1" name="list_name" type="text" placeholder="List name" required>
            </label>
            <input type="submit" value="Add"/>
        </form>

        <form method="post" action="route.php?url=task/add">
            <label class="p-3">
                <input class="m-1" name="task_name" type="text" placeholder="Task name" required>
                <br>
                <select class="m-1" name="status" required>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
                <!--                value="--><? //= $_POST['task_name'] ?><!--"-->
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
                    <th scope="col">Task</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                <?php
                require "datalayer.php";
                $tasks = getAllTasks();

                if (!empty($tasks)) {
                    foreach ($tasks as $task) {
                        ?>
                        <tbody>
                        <tr>
                            <th scope="row"><?= $task['id'] ?></th>
                            <td><?= $task['task_name'] ?></td>
                            <td><?= $task['status'] ?></td>
                            <td><a type="button" href="id=<?= $task['id'] ?>">Edit</a></td>
                            <td><a type="button" href="route.php?url=task/task/<?= $task['id'] ?>">Delete</a></td>
                        </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    ?>
                    <tbody>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">None</th>
                        <th scope="col">None</th>
                    </tr>
                    </tbody>
                    <?php
                }
                ?>
                </thead>
            </table>

            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lists</th>
                    <th></th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                <?php
                $lists = getAllLists();


                if (!empty($lists)) {
                foreach ($lists

                as $list) {
                //                echo $list['list_name'];
                ?>
                <tbody>
                <tr>
                    <th scope="row"><?= $list['id'] ?></th>
                    <td><?= $list['list_name'] ?></td>
                    <td></td>
                    <td><a type="button" href="id=<?= $list['id'] ?>">Edit</a></td>
                    <td><a type="button" href="route.php?url=list/delete/<?= $list['id'] ?>">Delete</a></td>
                </tr>
                </tbody>

                <?php
                }
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