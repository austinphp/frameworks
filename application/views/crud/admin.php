
<?php $this->load->view('crud/head'); ?>

<div id="main">
	
	<h2>Admin Index</h2>
	
	<div id="adminMenu"><a href="/admin/create">New Post</a></div>
	<?php echo $table; ?>
	
	<div class="clear"></div>
    <div id="footer">
        <a href="/admin">Admin</a> | <a href="/admin/logout">Log Out</a>
    </div>
</div>
        
<?php $this->load->view('crud/foot'); ?>        