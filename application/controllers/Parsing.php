<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parsing extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		// Your own constructor code
		$this->load->model('Parsing_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function index()
	{
		redirect('parsing/v1');
	}

	public function v1()
	{
		
		$this->load->view('create');
	}

	public function v2()
	{
		$this->load->view('create2');
	}

	public function store()
	{	
		$data['chat'] = $this->input->post('chat');
		$this->load->view('create', $data);
	}

	public function store2()
	{	
		$data['chat'] = $this->input->post('chat');
		$this->load->view('create2', $data);
	}

}

