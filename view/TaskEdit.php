<!-- /view/TaskEdit.php -->

<div class="w-75 bg-white p-4">
    <h1>Edit task</h1>
    <form method="post" action="route.php?url=Task/Update">
        <label>
            <input name="id" type="hidden" value="<?= $task['id'] ?>">
            <p>Task name: <input name="task_name" type="text" value="<?= $task['task_name'] ?>" required></p>
            <br>
            <p>Status: <select name="status" required>
                    <?php if ($task['status'] === 'open') {
                        ?>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <?php
                    } else {
                        ?>
                        <option value="closed">Closed</option>
                        <option value="open">Open</option>
                        <?php
                    } ?>

                </select></p>
            <?php $lists = GetAllLists();

            $listName = GetList($task['list_id']); ?>
            <p>In list: <select name="list_id" required>
                    <option value="<?php echo $listName['id']; ?>"><?php echo $listName['list_name']; ?></option>
                    <?php foreach ($lists as $list) {
                        if ($listName['list_name'] != $list['list_name']) {
                            ?><option value="<?php echo $list['id']; ?>"><?php echo $list['list_name']; ?></option><?php
                        }
                    } ?>
                </select></p>
        </label>
        <input type="submit" value="Edit"/>
    </form>
</div>