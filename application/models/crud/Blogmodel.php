<?php
class Blogmodel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_ten_entries()
	{}
	
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
		$sql = "UPDATE `crud_posts` SET `Title`='$postTitle', `Content` = '$postContent' WHERE `crud_posts`.`CrudPostsId` = $postId;"
		$this->db->query($sql);
		
	}
	
}