
<?php $this->load->view('crud/head'); ?>

<div id="main">
	
	<h2>CRUD <?php echo $title; ?></h2>

	<?php echo $form; ?>
	
	<div class="clear"></div>
    <div id="footer">
        <a href="/admin">Admin</a> | <a href="/admin/logout">Log Out</a>
    </div>
</div>
        
<?php $this->load->view('crud/foot'); ?>        