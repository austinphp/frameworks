<div class="post-form">
	<?=$this->form->create($post ?: null); ?>
		<?=$this->form->field('id', array('type' => 'hidden', 'label' => ''));?>
		<?=$this->form->field('title');?>
		<?=$this->form->field('teaser', array('type' => 'textarea'));?>
		<?=$this->form->field('body', array('type' => 'textarea'));?>
		<?=$this->form->field('tags');?>
		<?=$this->form->field('deleted', array('type' => 'checkbox'));?>
		
		<?=$this->form->submit('Save'); ?>
	<?=$this->form->end(); ?>
</div>