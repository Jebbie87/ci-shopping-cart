<h1 class="page-title"><strong><?= $title ?></strong></h1>

<?php echo validation_errors('<span class="error-text">', '</span>'); ?>

<div class="container">
<?php echo form_open('products/update'); ?>
	<?php echo form_hidden('id', $product['id']); ?>
  <div class="form-group">
    <?php
    	echo form_label('Product Name');
      echo form_input(array('name' => 'name', 'value' => $product['name'], 'class' => 'form-control', 'placeholder' => 'Product name'))
    ?>
  </div>
  <div class="form-group">
  	<?php
  		echo form_label('Product Price');
      echo form_input(array('name' => 'price', 'value' => $product['price'], 'class' => 'form-control', 'type' => 'number', 'placeholder' => 'Product price'))
    ?>
  </div>
  <div class="form-group">
  	<?php
  		echo form_label('Description');
  		echo form_textarea(array('name' => 'description', 'value' => $product['description'], 'class' => 'form-control', 'placeholder' => 'Product description'));
  	?>
  </div>
  <div class="form-group">
	  <?php
	  	echo form_label('Product Image File');
	  	echo form_upload('userfile');
	  ?>
  </div>
  <?php echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default')); ?>
<?php echo form_close(); ?>
</div>
