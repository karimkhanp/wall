<?php

class Post_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function insert( $data ){
        var_dump($_POST);
         $id =  $this->input->post('id');
         
         $sql = "SELECT id FROM post WHERE id = ? LIMIT 1";
         $result = $this->db->query($sql, array(1)); 
         $data = array(

            'post_title'    => htmlspecialchars($this->input->post('post_title')),
            'post_content'  => htmlspecialchars($this->input->post('post_content')),
            'post_link'     => $this->input->post('post_link')

         );
        
         if($result->num_rows != 0 ){
           
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
