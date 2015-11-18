<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/create'); ?>

<label for="name">Name</label>
<input type="input" name="name" /><br />

<label for="password">Text</label>
<input type="password" name="password"/><br />

<input type="submit" name="submit" value="Create new user" />

</form>