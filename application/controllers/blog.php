<?php
class Blog extends CI_Controller
{
	public function _construct()
	{}
	
	public function index()
	{
		$this->load->model('crud/blogmodel', 'AustinModel');
		$data['posts'] = $this->AustinModel->get_ten_entries();
		$data['austinphp'] = "Hello";
    $var = $this->load->view('crud/main', $data, TRUE);
    echo $var;
	}
	
}