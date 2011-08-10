<?=$this->form->create();?>
	<?=$this->form->field('username');?>
	<?=$this->form->field('password', array('type' => 'password'));?>
	<?=$this->form->field('confirm', array('type' => 'password'));?>
	<?=$this->form->submit('Register'); ?>
<?=$this->form->end();?>