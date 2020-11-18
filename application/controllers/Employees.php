<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	public function index()
	{   
        $res=$this->db->select('*')->from('employees')->get()->result_array();
        $pagedata = array('data' => $res);
		$this->load->view('employees',$pagedata);
	}
	public function create()
	{   
		$this->load->view('create_employees');
	}
	public function create_process()
	{   
        $data = array(
            'employee_name' => $this->input->post('employee_name'),
        );
        $this->db->insert('employees', $data);
        $user_data = array('success' => 'Success');
        $this->session->set_userdata($user_data);
        redirect('employees');
	}
	public function update($id)
	{   
        $res=$this->db->select('*')->where('employee_id',$id)->from('employees')->get()->result_array();
        if($res){
            $pagedata = array('data' => $res[0]);
            $this->load->view('update_employees',$pagedata);
        }else{
            $user_data = array('error' => 'Doesnt exist');
            $this->session->set_userdata($user_data);
            redirect('employees');
        }
	}
	public function update_process($id)
	{   
        $this->db->set('employee_name', $this->input->post('employee_name'));
        $this->db->where('employee_id', $id);
        $this->db->from('employees');
        $this->db->update();
        
        $user_data = array('success' => 'Success');
        $this->session->set_userdata($user_data);
        redirect('employees');
	}
	public function delete_process($id)
	{   
        $this->db->delete('employees', array('employee_id' => $id));
        redirect('employees');
	}
}
