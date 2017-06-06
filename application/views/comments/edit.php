<h2 class="page-title"><?= $title ?></h2>

<?php
	$hidden = array(
		'id' => $comment['id'],
		'product_id' => $comment['product_id']
	);
?>
<?php echo form_open('/comments/update', '', $hidden); ?>
	<div class="form-group">
	<?php
	  echo form_label('Edit comment');
    echo form_textarea(array('name' => 'comment', 'class' => 'form-control', 'placeholder' => 'Enter new comment', 'value' => $comment['comment']));
    echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default'));
  ?>
	</div>
<?php form_close(); ?>
