<?php

class Admin extends CI_Controller
{
	public function _construct()
	{}
	
	public function index()
	{
		$this->load->library('table');
		
		$query = $this->db->query('SELECT * FROM crud_posts');
		
		$this->table->set_heading('Edit',	'Title',	'Content',	'Approved',	'TimeUpdated');
		foreach($query->result() as $posts)
		{
			$edit = "<a href='/admin/edit/$posts->CrudPostsId'>Edit - $posts->CrudPostsId</a>";
			$tableData = $this->table->add_row($edit, $posts->Title, $posts->Content, $posts->Approved, $posts->TimeUpdated);
		}
		
		$data['table'] = $this->table->generate($tableData);
		
		$this->load->view('crud/admin', $data);
	}
	
	public function edit($id = NULL)
	{	
		$url = 'save';			
		$data['title'] = "Edit";
		
		$this->load->helper('form');
		
		if(!empty($id))
		{
					$query = $this->db->query("SELECT * FROM crud_posts WHERE CrudPostsId=$id");
					$row = $query->row();
		}
		
		$attributes = array('class' => 'myform', 'id' => 'crudEdit');
		$form = form_open("admin/$url", $attributes);
		
		$formData = array(
				'name' => 'postTitle',
        'maxlength'   => '100',
        'size'        => '20',
        'style'       => 'width:50%',
        'value'				=> "$row->Title",
      );
		
		$form .= form_label('Post title', 'postTitle');
		$form .= form_input($formData);
		
		$formData = array(
				'name' 				=> 'postContent',
        'rows'   => '25',
        'cols'        => '60',
        'style'       => 'width:50%',
        'value'				=> "$row->Content",
      );
		
		$form .= form_label('Post Content', 'postContent');		
		$form .= form_textarea($formData);
		
		$form .= form_hidden('postId', $id);
		
		$form .= form_submit('editSubmit', 'Submit');		
		
		
		$data['form'] = $form;
		$this->load->view('crud/editcreate', $data);
	}

	public function create()
	{
		$url = 'insert';
		$data['title'] = "Create";
		
		$this->load->helper('form');
		

		$attributes = array('class' => 'myform', 'id' => 'crudEdit');
		$form = form_open("admin/$url", $attributes);
		
		$formData = array(
				'name' => 'postTitle',
        'maxlength'   => '100',
        'size'        => '20',
        'style'       => 'width:50%',
        'value'				=> "",
      );
		
		$form .= form_label('Post title', 'postTitle');
		$form .= form_input($formData);
		
		$formData = array(
				'name' 				=> 'postContent',
        'rows'   => '25',
        'cols'        => '60',
        'style'       => 'width:50%',
        'value'				=> "",
      );
		
		$form .= form_label('Post Content', 'postContent');		
		$form .= form_textarea($formData);
		
		$form .= form_submit('editSubmit', 'Submit');		
		
				
		$data['form'] = $form;
		$this->load->view('crud/editcreate', $data);
	}
	
	public function save()
	{
		$this->load->model('crud/blogmodel');
		
	  foreach($_POST AS $key => $value) {	
	      ${$key} = mysql_real_escape_string($value);
	  }
	  
	  //var_dump($_POST);
		if (!empty($postId))
		{
			$this->blogmodel->update_post($postId, $postTitle, $postContent);
		}
		
		redirect("/admin/edit/$postId", 'location');
	}

	public function insert()
	{
		$this->load->model('crud/blogmodel');
		
	  foreach($_POST AS $key => $value) {	
	      ${$key} = mysql_real_escape_string($value);
	  }
		
		$this->blogmodel->insert_post($postTitle, $postContent);
		
		redirect('/admin', 'location');
	}
	
	public function delete($id =NULL)
	{
		$res = false;
		$this->load->model('crud/blogmodel');
		
		if(!empty($id))
		{
			$res = $this->blogmodel->delete($id);
		}
		
		if($res)
		{
			redirect('/admin', 'location');
		}
		else
		{
			echo "FAIL";
		}
		
		
	}
	
	public function logout()
	{
		$this->load->view('crud/logout');
	}
	
	private function formHelper($url, $postId)
	{
		$this->load->helper('form');
		
		if(!empty($postId))
		{
					$query = $this->db->query("SELECT * FROM crud_posts WHERE CrudPostsId=$postId");
					$row = $query->row();
		}
		
		$attributes = array('class' => 'myform', 'id' => 'crudEdit');
		$form = form_open("admin/$url", $attributes);
		
		$formData = array(
				'name' => 'postTitle',
        'maxlength'   => '100',
        'size'        => '20',
        'style'       => 'width:50%',
        'value'				=> "$row->Title",
      );
		
		$form .= form_label('Post title', 'postTitle');
		$form .= form_input($formData);
		
		$formData = array(
				'name' 				=> 'postContent',
        'rows'   => '25',
        'cols'        => '60',
        'style'       => 'width:50%',
        'value'				=> "$row->Content",
      );
		
		$form .= form_label('Post Content', 'postContent');		
		$form .= form_textarea($formData);
		
		$form .= form_hidden('postId', $postId);
		
		$form .= form_submit('editSubmit', 'Submit');
		
		return $form;
	}
		
}