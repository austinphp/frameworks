<?php $this->load->view('crud/head'); ?>

        <div id="main">
<h1>Blog</h1>
<br />
<br />
<?php if ($posts){?>
	<?php foreach ($posts as $post){?>
		<br />
		<?=$post->Title?> <span style="font-style:italic">(<?=$post->TimePosted?>)</span>
        <hr />
        <?=$post->Content?>
        <br />
        <br />
        <br />

    <?}?>
<?}?>

<?php echo $austinphp ?>
            <div id="footer">
                <a href="/admin">Admin</a> | <a href="/admin/logout">Log Out</a>
            </div>
        </div>
        
<?php $this->load->view('crud/foot'); ?>        