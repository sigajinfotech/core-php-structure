<?php include('include/header.php'); ?>
<?php
$sql = "SELECT * FROM users";
$users = $DAO->select($sql);
?>
<div class="container">
    <h1>Users List</h1>
    <a href="add-user.php">Add User</a>
    <table class="table table-hover">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php foreach ($users as $user){ ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['first_name']; ?></td>
            <td><?php echo $user['last_name']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php include('include/footer.php'); ?>