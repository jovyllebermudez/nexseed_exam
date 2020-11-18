<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends CI_Controller {

	public function index()
	{   
        $res=$this->db->select('*')->from('companies')->get()->result_array();
        $pagedata = array('data' => $res);
		$this->load->view('companies',$pagedata);
	}
	public function create()
	{   
		$this->load->view('create_companies');
	}
	public function create_process()
	{   
        $data = array(
            'company_name' => $this->input->post('company_name'),
        );
        $this->db->insert('companies', $data);
        $user_data = array('success' => 'Success');
        $this->session->set_userdata($user_data);
        redirect('companies');
	}
	public function update($id)
	{   
        $res=$this->db->select('*')->where('company_id',$id)->from('companies')->get()->result_array();
        if($res){
            $pagedata = array('data' => $res[0]);
            $this->load->view('update_companies',$pagedata);
        }else{
            $user_data = array('error' => 'Doesnt exist');
            $this->session->set_userdata($user_data);
            redirect('companies');
        }
	}
	public function update_process($id)
	{   
        $this->db->set('company_name', $this->input->post('company_name'));
        $this->db->where('company_id', $id);
        $this->db->from('companies');
        $this->db->update();
        
        $user_data = array('success' => 'Success');
        $this->session->set_userdata($user_data);
        redirect('companies');
	}
	public function delete_process($id)
	{   
        $this->db->delete('companies', array('company_id' => $id));
        redirect('companies');
	}
}
