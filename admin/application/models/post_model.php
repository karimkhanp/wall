<?php

class Post_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function get_all(){
        
        
        $result = $this->db->get('post')->result();
        return $result;
    }
    public function insert( $image_link = '' ){
       
         $id =  $this->input->post('id');
         
         $sql = "SELECT id FROM post WHERE id = ? LIMIT 1";
         $result = $this->db->query($sql, array($id)); 
         $data = array(

            'post_title'    => htmlspecialchars($this->input->post('Post_title')),
            'post_content'  => htmlspecialchars($this->input->post('Post_content')),
            'post_link'     => $this->input->post('Post_link'),
           
         );
         
         
         if($result->num_rows != 0 ){
            if($image_link != ''){
                 $data['post_image'] = $image_link;
                }
            $result = $this->db->update('post', $data , array( 'id' => $id ));
         }
        else{
            $data['id'] = $id;
            $result = $this->db->insert('post', $data); 
        }
        return $result;
        die($data);
    }
}
?>
