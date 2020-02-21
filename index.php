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
        <h1>Add list or task</h1>
        <form method="post" action="route.php?url=List/Add">
            <label>
                <p>List name: <input name="list_name" type="text" placeholder="List name" required></p>
            </label>
            <input type="submit" value="Add"/>
        </form>

        <br>

        <form method="post" action="route.php?url=Task/Add">
            <label>
                <p>Task name: <input name="task_name" type="text" placeholder="Task name" required></p>
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
            <h1>Lists and tasks</h1>
            <table id="myTable" class="table table-striped table-dark">

                <tr>
                    <th scope="col" onclick="sortTable(0)">List</th>
                    <th scope="col" onclick="sortTable(1)">Task</th>
                    <th scope="col" onclick="sortTable(2)">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                <?php $tasks = getAllTasks();
                if (!empty($tasks)) {
                    foreach ($tasks as $task) { ?>
                        <tr>
                            <td><?= $task['list_name'] ?>
                                <a type="button" href="route.php?url=List/Edit/<?= $task['list_id'] ?>">Edit</a>
                                <a type="button" href="route.php?url=List/Delete/<?= $task['list_id'] ?>">Delete</a>
                            </td>
                            <td><?= $task['task_name'] ?></td>
                            <td><?= $task['status'] ?></td>
                            <td><a type="button" href="route.php?url=Task/Edit/<?= $task['id'] ?>">Edit</a></td>
                            <td><a type="button" href="route.php?url=Task/Delete/<?= $task['id'] ?>">Delete</a></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <th scope="col">None</th>
                        <th scope="col">None</th>
                        <th scope="col">None</th>
                        <th scope="col">None</th>
                    </tr>
                <?php } ?>
            </table>

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

                function sortTable(n) {
                    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                    table = document.getElementById("myTable");
                    switching = true;
                    //Set the sorting direction to ascending:
                    dir = "asc";
                    /*Make a loop that will continue until
                    no switching has been done:*/
                    while (switching) {
                        //start by saying: no switching is done:
                        switching = false;
                        rows = table.rows;
                        /*Loop through all table rows (except the
                        first, which contains table headers):*/
                        for (i = 1; i < (rows.length - 1); i++) {
                            //start by saying there should be no switching:
                            shouldSwitch = false;
                            /*Get the two elements you want to compare,
                            one from current row and one from the next:*/
                            x = rows[i].getElementsByTagName("TD")[n];
                            y = rows[i + 1].getElementsByTagName("TD")[n];
                            /*check if the two rows should switch place,
                            based on the direction, asc or desc:*/
                            if (dir == "asc") {
                                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                    //if so, mark as a switch and break the loop:
                                    shouldSwitch = true;
                                    break;
                                }
                            } else if (dir == "desc") {
                                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                    //if so, mark as a switch and break the loop:
                                    shouldSwitch = true;
                                    break;
                                }
                            }
                        }
                        if (shouldSwitch) {
                            /*If a switch has been marked, make the switch
                            and mark that a switch has been done:*/
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                            //Each time a switch is done, increase this count by 1:
                            switchcount++;
                        } else {
                            /*If no switching has been done AND the direction is "asc",
                            set the direction to "desc" and run the while loop again.*/
                            if (switchcount == 0 && dir == "asc") {
                                dir = "desc";
                                switching = true;
                            }
                        }
                    }
                }
            </script>
        </div>
    </div>
</div>

</body>
</html>