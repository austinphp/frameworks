<?php
if (isset($success)) {
	$classes = array('failure');
	$message = 'Post failed to update';
	echo $this->view()->render(array('element' => 'alert'), compact('classes', 'message'));
}
echo $this->view()->render(array('element' => 'post.form'), compact('post'));
?>