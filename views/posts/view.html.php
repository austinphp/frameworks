<div class="post">
<?php 
	$admin = \lithium\storage\Session::read('user');
	$admin = $admin['is_admin'];
	if($admin): ?>
    <div class="actions">
    	<a href="/posts/edit/<?=$post->id?>">Edit</a> | 
	    <a href="/posts/delete/<?=$post->id?>">Delete</a>
    </div>
    <?php endif; ?>
    <h3><?=$post->title?></h3>
    <p class="timestamp">Posted: <?=date("n-d-Y H:i:s", strtotime($post->created))?> by <strong><?=$post->user->username?></strong></p>
    <p class="body"><?php print nl2br($post->body)?></p>
    <a name="comments"></a>
    <fieldset id="comments">
    	<legend>Comments</legend>
    	<?php
    		if (count($post->comments) > 0):
    			foreach($post->comments as $comment):
    	?>
    	<div class="comment">
    		<?php if ($admin || \lithium\storage\Session::read('user.id') === $comment->user_id):?>
    			<div class="actions">
    				<a href="/comments/delete/<?=$comment->id?>">Delete</a>
    			</div>
    		<?php endif;?>
    		<p class="timestamp">Posted: <?=date("n-d-Y H:i:s", strtotime($comment->created))?> by <strong><?=$comment->user->username?></strong></p>
    		<p class="body"><?=$comment->comment?></p>
    	</div>
    	<?php
    			endforeach;
    		else:
		?>
		<div class="comment">
			There are no comments yet. Be the first!
		</div>
		<?php
			endif;
			if (\lithium\storage\Session::check('user')):
    	?>
    	<?=$this->form->create(null, array(
    		'url' => '/comments/create',
    	))?>
    		<?=$this->form->field('post_id', array(
    			'type' => 'hidden',
    			'value' => $post->id,
    			'label' => ''
    		));?>
    		<?=$this->form->field('comment', array('type' => 'textarea'));?>
    		<?=$this->form->submit('Add Comment');?>
    	<?=$this->form->end();?>
    	<?php
    		else:
    	?>
    	Please <a href="/users/login">Login</a> to comment on this post.
    	<?php endif;?>
    </fieldset>
</div>