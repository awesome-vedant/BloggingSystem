<h1>Welcome to th elogin page</h1><br>
user id <b><?= $this->session->userdata('userid');?></b><br>
<?php
if($error== true){
    echo "No records Exists .. please add a new articles";
}
else if($article_row){
?>
<table cellspacing="20">
<tr><th>Article Id</th><th>Title</th><th>Content</th></tr>
<?php
    foreach($article_row as $article){
        echo "<tr><td>".$article->article_id."</td><td>".$article->title."</td><td>".$article->content."</td><td><a href='".base_url('index.php/My_controller/edit/').$article->article_id."'>Edit</a></td><td><a href='".base_url('index.php/My_controller/delete/').$article->article_id."'>Delete</a></td></tr>";
        
    }
    
}
?>
</table>
<a href="<?= base_url('index.php/My_controller/add_article')?>">Add new article</a>
<a href="<?= base_url('index.php/My_controller/logout')?>">Log out</a>
<br>
<?= $this->pagination->create_links()?>
<?php
    $CI =& get_instance();
$CI->load->library('calendar');

echo $CI->calendar->generate();
   ?>