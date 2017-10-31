Add new Article Here<br>
<form action="<?= base_url('index.php/My_controller/add_new_article')?>" method="post">
<input type="text" name="title"><br>
    <textarea rows="10" cols="20" name="content"></textarea><br>
    <input type="submit" name="submit" value="submit">
</form>