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
        <h1>Edit task</h1>
        <form method="post" action="route.php?url=task/update">
            <?php require "datalayer.php";
            $id = $_GET['id'];
            $task = GetTask($id);
            ?>
            <label>
                <p>Task name: <input name="task_name" type="text" value="<?= $task[0]['task_name'] ?>" required></p>
                <br>
                <p>Status: <select name="status" required>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                    </select></p>
                <?php $lists = GetAllLists(); ?>
                <p>In list: <select name="list_id" required>
                        <?php foreach ($lists as $list) { ?>
                            <option value="<?php echo $list['id']; ?>"><?php echo $list['list_name']; ?></option>
                        <?php } ?>
                    </select></p>
            </label>
            <input type="submit" value="Edit"/>
        </form>
    </div>
</div>

</body>
</html>