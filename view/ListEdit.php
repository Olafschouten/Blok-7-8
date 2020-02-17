<!-- /view/ListEdit.php -->

<div class="w-75 bg-white p-4">
    <h1>Edit list</h1>
    <form method="post" action="route.php?url=List/Update">
        <input name="id" type="hidden" value="<?= $list['id'] ?>">
        <label>
            <p>List name: <input name="list_name" type="text" value="<?= $list['list_name'] ?>" required></p>
        </label>
        <input type="submit" value="Edit"/>
    </form>
</div>

