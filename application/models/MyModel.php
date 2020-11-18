<?php
class MyModel extends CI_Model{
    
    public function get_($table){
        $query = $this->db->get($table);
        return $query->result();
    }

    public function test(Type $var = null)
    {
        
        // $query = $this->db->get('users');
        
		// echo '<pre>';
		// print_r($query);
		// echo '</pre>';
        echo "ok";
    }
    public function insert_()
    {    
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        );
        return $this->db->insert('products', $data);
    }
    public function update_($table,$id) 
    {
        $data=array(
            'title' => $this->input->post('title'),
            'description'=> $this->input->post('description')
        );
        if($id==0){
            return $this->db->insert($table,$data);
        }else{
            $this->db->where('id',$id);
            return $this->db->update($table,$data);
        }        
    }
}
?>