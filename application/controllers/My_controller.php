<?php
class My_controller extends CI_Controller {
    public function index(){
        $this->load->library('session');
        if($this->session->has_userdata('userid')){
         $userid = $this->session->userdata('userid');
                   $this->load->model('load_data');
             $this->load->library('pagination');
        $config = [
            'base_url' => base_url('index.php/My_controller/checklogin'),
            'per_page' => 3,
            'total_rows' => $this->load_data->nums($userid),
        ];
            $this->pagination->initialize($config); 
                   $article['article_row'] = $this->load_data->fetch_article($userid,$config['per_page'],$this->uri->segment(3));
                   if($article){
                       $article['error'] = false;
                       $this->load->view('dashboard',$article);
                   }
             }
                   else{
                       $this->load->view('login');
                   }
   
    }
    public function signup(){
        $submit = $this->input->post('submit');
        if(isset($submit)){
            $name = $this->input->post('fullname');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fullname','Name','required|alpha|max_length[30]');
            $this->form_validation->set_rules('username','User Name','required|alpha_numeric|max_length[40]');
            $this->form_validation->set_rules('password','Password','required|max_length[40]');
            if($this->form_validation->run()== false){
                $this->load->view('login');
            }else{
            $this->load->model('load_data');
            if($this->load_data->check_username($username)){
                echo "username already exists";
                echo "<a href='".base_url('index.php/My_controller/')."'>Sign up again</a>";
            }
            else{
            if($this->load_data->add_user($name,$username,$password)){
                echo "user added";
                echo "<a href='".base_url('index.php/My_controller/')."'>Login</a>";
            }
            else{
                echo "retry";
            }
            
        }
        }
        }else{
            $this->checklogin();
        }
        
    }
    public function checklogin(){
        
         $this->load->library('session');
        if($this->session->has_userdata('userid')){
         $userid = $this->session->userdata('userid');
                   $this->load->model('load_data');
            $this->load->library('pagination');
        $config = [
            'base_url' => base_url('index.php/My_controller/checklogin'),
            'per_page' => 3,
            'total_rows' => $this->load_data->nums($userid),
        ];
            $this->pagination->initialize($config); 
                   $article['article_row'] = $this->load_data->fetch_article($userid,$config['per_page'],$this->uri->segment(3));
                   if($this->load_data->fetch_article($userid,$config['per_page'],$this->uri ->segment(3)) != -1){
                       $article['error'] = false;
                       $this->load->view('dashboard',$article);
                   }
             else{
                       $article['error'] = true;
                       $this->load->view('dashboard',$article);
                   }
             }
                   else{
                       
        $submit = $this->input->post("submit");
        if(isset($submit)){
            $username = $this->input->post("username2");
            $password = $this->input->post("password2");
             $this->load->library('form_validation');  
            $this->form_validation->set_rules('username2','User Name','required|alpha_numeric|max_length[40]');
            $this->form_validation->set_rules('password2','Password','required|max_length[40]');
            if($this->form_validation->run()== false){
                $this->load->view('login');
            }else{
            $this->load->model('load_data');
           if($id = $this->load_data->verify($username,$password)){
               $this->load->library('session');
               $this->session->set_userdata('userid',$id);
               if($this->session->has_userdata('userid')){
                   $this->load->library('pagination');
               $this->load->model('load_data');
        $config = [
            'base_url' => base_url('index.php/My_controller/checklogin'),
            'per_page' => 3,
            'total_rows' => $this->load_data->nums($id),
        ];
               $this->pagination->initialize($config); 
                   $userid = $this->session->userdata('userid');
                   $this->load->model('load_data');
                   $article['article_row'] = $this->load_data->fetch_article($userid,$config['per_page'],$this->uri->segment(3));
                   if($this->load_data->fetch_article($userid,$config['per_page'],$this->uri->segment(3)) != -1){
                       $article['error'] = false;
                       $this->load->view('dashboard',$article);
                   }
                   else{
                       $article['error'] = true;
                       $this->load->view('dashboard',$article);
                   }
               }
               else{
                   echo "sessio failed";
               }
           }
        }
        }
        else{
            return redirect(base_url('index.php/My_controller/'));
        }
    }
         }
    public function logout(){
        $this->load->library('session');
        $this->session->unset_userdata('userid');
$this->load->view('login');
    }
    public function edit(){
       $article_id = $this->uri->segment(3);
       $this->load->model('load_data');
       if($articles['article'] = $this->load_data->edit($article_id)){
           $this->load->view('edit_articles',$articles);
       }
    }
     public function delete(){
        $article_id = $this->uri->segment(3);
         $this->load->model('load_data');
         if($this->load_data->delete($article_id)){
             redirect(base_url('index.php/My_controller'));
         }
         
    }
    public function change_article(){
        $submit = $this->input->post("submit");
        if(isset($submit)){
            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $this->load->model('load_data');
            if($this->load_data->change_article($id,$title,$content)){
                $this->checklogin();
            }
            else{
                echo "not updated";
            }
            
            
        }
    }
    public function add_article(){
        $this->load->view('new_article');
    }
    
   public function add_new_article(){
       $submit = $this->input->post("submit");
        if(isset($submit)){
             $this->load->library('session');
            $user_id = $this->session->userdata('userid');
            $title = $this->input->post('title');
            $content = $this->input->post('content');
        $this->load->model('load_data');
       if($this->load_data->add_art($user_id,$title,$content)){
           $this->checklogin();
       }
            else{
                echo "data not inserted";
            }
    }
       else{
           $this->checklogin();
       }
}
}
?>