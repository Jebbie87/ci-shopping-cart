<div class="container">
<?php echo form_open('users/login'); ?>
	<h1 class="text-center"><?php echo $title; ?></h1>

	<?php echo validation_errors('<span class="error-text">', '</span>'); ?>

	<div class="form-group">
		<?php
			echo form_label('Enter email');
			echo form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'Enter email', 'type' => 'email'));
		?>
	</div>

	<div class="form-group">
		<?php
			echo form_label('Enter password');
			echo form_input(array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter password', 'type' => 'password'));
		?>
	</div>

	<?php echo form_submit(array('value' => 'Login', 'class' => 'btn btn-primary btn-block')); ?>
<?php echo form_close(); ?>
</div>
