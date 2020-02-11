<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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


<button type="button">edit</button>
<button type="button">remove</button>

<div class="col-8" style="background: black">

</div>

<?php
if (isset($_POST['submit'])) {
    $status = $_POST['status'];
    $list = $_POST['list'];
    $task = $_POST['task'];

    $data = [
        $status,
        $list,
        $task
    ];

    addForm($data);
}
?>
</body>
</html>