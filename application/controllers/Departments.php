<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

	public function index()
	{   
        $res=$this->db->select('*')->from('departments')->get()->result_array();
        $pagedata = array('data' => $res);
		$this->load->view('departments',$pagedata);
	}
	public function create()
	{   
		$this->load->view('create_departments');
	}
	public function create_process()
	{   
        $data = array(
            'department_name' => $this->input->post('department_name'),
        );
        $this->db->insert('departments', $data);
        $user_data = array('success' => 'Success');
        $this->session->set_userdata($user_data);
        redirect('departments');
	}
	public function update($id)
	{   
        $res=$this->db->select('*')->where('department_id',$id)->from('departments')->get()->result_array();
        if($res){
            $pagedata = array('data' => $res[0]);
            $this->load->view('update_departments',$pagedata);
        }else{
            $user_data = array('error' => 'Doesnt exist');
            $this->session->set_userdata($user_data);
            redirect('departments');
        }
	}
	public function update_process($id)
	{   
        $this->db->set('department_name', $this->input->post('department_name'));
        $this->db->where('department_id', $id);
        $this->db->from('departments');
        $this->db->update();
        
        $user_data = array('success' => 'Success');
        $this->session->set_userdata($user_data);
        redirect('departments');
	}
	public function delete_process($id)
	{   
        $this->db->delete('departments', array('department_id' => $id));
        redirect('departments');
	}
}
