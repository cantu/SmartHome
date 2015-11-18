<h2><?php echo $title; ?></h2>
<div>
    <?php if( is_object($user)){?>
    <ul>
        <li><?php echo 'id: '.$user->id;?></li>
        <li><?php echo 'name: '.$user->name; ?></li>
        <li><?php echo 'password: '.$user->password; ?></li>
        <li><?php echo 'last_login: '.$user->last_login; ?></li>
        <li><a href="<?php echo site_url('users/'.$user->name); ?>">user info</a></li>
    </ul>
    <?php }else{echo"none!";} ?>

<br/>
