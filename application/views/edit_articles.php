Article to be Edited<form action="<?=base_url('index.php/My_controller/change_article')?>" method="post"><table>
    
<?php
foreach($article as $art){
echo "<tr><td><input type='text' name='title' value='".$art->title."'></td><td><input type='text' name='content' value='".$art->content."'><input type='hidden' name='id' value='".$art->article_id."'></td>";    
}
?>
        
   
</table>
<input type="submit" value="submit" name="submit">
     </form>