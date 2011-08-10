<?php
if (isset($success)) {
	if ($success) {
		$classes = array('success');
		$message = 'Post updated!';
	} else {
		$classes = array('failure');
		$message = 'Post failed to update';
	}
	echo $this->view()->render(array('element' => 'alert'), compact('classes', 'message'));
}
echo $this->view()->render(array('element' => 'post.form'), compact('post'));
?>