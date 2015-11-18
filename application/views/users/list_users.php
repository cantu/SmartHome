<h2><?php echo $title; ?></h2>
<div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>user</th>
            <th>password</th>
            <th>last login</th>
            <th>info</th>
        </tr>
        <tbody>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['password']; ?></td>
                <td><?php echo $user['last_login']; ?></td>
                <td><a href="<?php echo site_url('users/'.$user['name']); ?>">user info</a></td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
</div>
<br/>
