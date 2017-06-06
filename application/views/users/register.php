<h1 class="page-title"><strong><?= $title ?></strong></h1>

<?php echo validation_errors('<span class="error-text">', '</span>'); ?>

<div class="container">
	<?php echo form_open('users/register'); ?>
		<div class="form-group">
	  	<?php
	  		echo form_label('Email address');
	      echo form_input(array('name' => 'email', 'class' => 'form-control', 'type' => 'email', 'placeholder' => 'Enter email'))
	    ?>
		</div>
		<div class="form-group">
	  	<?php
	  		echo form_label('Username');
	      echo form_input(array('name' => 'username', 'class' => 'form-control', 'placeholder' => 'Enter username'))
	    ?>
		</div>
		<div class="form-group">
	  	<?php
				echo form_label('Password');
		    echo form_input(array('name' => 'password', 'class' => 'form-control', 'type' => 'password', 'placeholder' => 'Enter password'))
		  ?>
		</div>
		<?php echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default')); ?>
	<?php echo form_close(); ?>
</div>
