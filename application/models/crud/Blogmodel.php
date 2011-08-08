<?php
class Blogmodel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_ten_entries()
	{
		$sql = "SELECT * FROM crud_posts ORDER BY CrudPostsId DESC;";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
		   return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	public function insert_post($postTitle, $postContent)
	{
		$time = date('m-d-y H:i:s');
		$sql = "INSERT INTO `llbblcom_dev`.`crud_posts` (
						`CrudPostsId` ,
						`Title` ,
						`Content` ,
						`Approved` ,
						`TimeUpdated` ,
						`TimePosted`
						)
						VALUES (
						NULL , '$postTitle', '$postContent', '1',CURRENT_TIMESTAMP , '$time'
					); ";
		$this->db->query($sql);
		
	}
	
	public function update_post($postId, $postTitle, $postContent)
	{
		$sql = "UPDATE `crud_posts` SET `Title`='$postTitle', `Content` = '$postContent' WHERE `crud_posts`.`CrudPostsId` = $postId;";
		$this->db->query($sql);
	}
	
	public function delete($id)
	{
		$sql = "DELETE FROM crud_posts WHERE CrudPostsId=".intval($id);
		return $this->db->query($sql);		
	}
}