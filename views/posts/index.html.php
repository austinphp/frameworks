<?php
$admin = \lithium\storage\Session::read('user');
$admin = $admin['is_admin'] === 1;
if($admin):
?>
<div id="new"><a href="/posts/create">New Post &raquo;</a></div>
<?php
endif;
foreach($posts as $post):?>
<div class="post">
	<?php if($admin): ?>
    <div class="actions">
    	<a href="/posts/edit/<?=$post->id?>">Edit</a> | 
	    <a href="/posts/delete/<?=$post->id?>">Delete</a>
    </div>
    <?php endif; ?>
    <h3><a href="/post/<?=$post->slug?>"><?=$post->title?></a></h3>
    <p class="timestamp">Posted: <?=date("n-d-Y H:i:s", strtotime($post->created))?> by <strong><?=$post->user->username?></strong></p>
    <p class="short-desc"><?=nl2br($post->teaser)?></p>
    <p class="comments"><a href="/post/<?=$post->slug?>#comments"><?=$post->comments;?> Comment<?=($post->comment->comments !== 1 ? 's' : '')?></a>
</div>
<?php endforeach;?>