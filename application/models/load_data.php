<?php
class load_data extends CI_Model{
    public function verify($username,$password){
        $this->load->database();
        $query = $this->db->where(['username'=>$username,'password'=>$password])->get('user');
        if($query->num_rows()){
            $id = $query->row()->id;
           return $id;
            
        }
        else{
            return false;
        }
        

    }
    public function nums($userID){
        $this->load->database();
        $query = $this->db->where(['user_id'=>$userID])->get('articles'); 
        return $query->num_rows();
    }
    public function fetch_article($userID,$limit,$offset){
        $this->load->database();
        $query = $this->db->where(['user_id'=>$userID])->limit($limit,$offset)->get('articles');
        if($query->num_rows()){
            return $query->result();
        }
        else{
            return -1;
        }
        
    }
    public function check_username($username){
        $this->load->database();
        $query = $this->db->where(['username'=>$username])->get('user');
        if($query->num_rows()){
            return true;
        }
        else{
            return false;
        }
    }
    public function delete($id){
        $this->load->database();
        $this->db->where('article_id',$id);
        $this->db->delete('articles');
        return true;
    }
    public function edit($article_id){
        $this->load->database();
        $query = $this->db->where(['article_id'=>$article_id])->get('articles');
        if($query->num_rows()){
            return $query->result();
        }
    }
    public function change_article($id,$title,$content){
        
    $data = array(
    'title' => $title,
        'content' => $content
    );
        $this->load->database();
        $this->db->where('article_id',$id);
        $this->db->update('articles',$data);
        return true;
    }
    public function add_art($user_id,$title,$content){
        $this->load->database();
        $data = array(
            'user_id' => $user_id,
            'title' => $title,
            'content' => $content
        );
        $this->db->insert('articles',$data);
        return true;
        
    }
    public function add_user($name,$username,$password){
        $this->load->database();
        $data = array(
        'fullname'=>$name,
            'username'=>$username,
            'password'=>$password
        );
        if($this->db->insert('user',$data)){
            return true;
        }
        else{
            return false;
        }
    }
}
?>