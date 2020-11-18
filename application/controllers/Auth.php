<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	// public function index()
	// {
	// 	// echo "hello";
	// 	// exit();
	// 	$this->load->view('login_view');

	// }
	public function login()
	{
		$this->load->view('login_view');
	}
	public function register()
	{
		$this->load->view('register_view');
	}

	public function login_process(Type $var = null)
	{
		
		$res=$this->db->select('*')
		->where('username',$this->input->post('username'))
		->where('password',$this->input->post('password'))
		->from('users')
		->get()->result_array();
		
		// $asd=$this->MyModel->get_('users');
		// echo '<pre>';
		// print_r($res);
		// echo '</pre>';
		if($res){
			$user_data = array('user_data' => $res[0]);
			$this->session->set_userdata($user_data);
			redirect('home');
		}else{
			$user_data = array('error' => 'Incorrect username or password');
			$this->session->set_userdata($user_data);
			redirect('auth/login');
		}
	}
	public function register_process(Type $var = null)
	{
		if($res){
			$user_data = array('error' => 'Username already exist');
			// $this->session->set_userdata($user_data);
			// redirect('auth/login');
		}else{
			// $user_data = array('user_data' => $res[0]);
			// $this->session->set_userdata($user_data);
			// redirect('home');
			
			$data = array(
					'username' => $this->input->post('username'),
					'name' => $this->input->post('name'),
					'password' => $this->input->post('password'),
			);
			$this->db->insert('users', $data);
			$user_data = array('success' => 'Success');
			$this->session->set_userdata($user_data);
			redirect('auth/login');
		}
	}
}
