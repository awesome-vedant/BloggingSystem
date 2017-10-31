<h1>Welcome to login page</h1>
<form action="<?= base_url('index.php/My_controller/checklogin')?>" method="post">
    Enter Username: <input type="text" name="username2"><b><?= form_error('username2')?></b> <br>
    Enter Password: <input type="password" name="password2"><b><?= form_error('password2')?></b><br>
    <input type="submit" value="submit" name="submit">
</form>

<h1>Sign up here as author</h1>
<form action="<?=base_url('index.php/My_controller/signup')?>" method="post">
    Name: <input type="text" name="fullname"><b><?= form_error('fullname')?></b><br>
    Username: <input type="text" name="username"><b><?= form_error('username')?></b><br>
    password: <input type="password" name="password"><b><?= form_error('password')?></b><br>
<input type="submit" name="submit" value="submit">
    </form>
