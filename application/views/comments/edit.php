<h2 class="page-title"><?= $title ?></h2>

<div class="form-group">
	<?php
		$hidden = array(
			'id' => $comment['id'],
			'product_id' => $comment['product_id']
		);
		echo form_open('/comments/update', '', $hidden);
	  echo form_label('Edit comment');
	  echo form_textarea(array('name' => 'comment', 'class' => 'form-control', 'placeholder' => 'Enter new comment', 'value' => $comment['comment']));
	  echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default'));
		echo form_close();
	?>
</div>
