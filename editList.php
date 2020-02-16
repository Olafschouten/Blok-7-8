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
        <h1>Edit list</h1>
        <form method="post" action="route.php?url=list/update">
            <?php require "datalayer.php";
            $id = $_GET['id'];
            $list = GetList($id);
            ?>
            <label>
                <p>List name: <input name="list_name" type="text" value="<?= $list[0]['list_name'] ?>" required></p>
            </label>
            <input type="submit" value="Edit"/>
        </form>
    </div>
</div>

</body>
</html>

