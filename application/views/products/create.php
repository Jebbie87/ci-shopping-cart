<h1 class="page-title"><strong><?= $title ?></strong></h1>

<?php echo validation_errors('<span class="error-text">', '</span>'); ?>

<div class="container">
	<?php echo form_open_multipart('products/create'); ?>
	  <div class="form-group">
      <?php
	    	echo form_label('Product Name');
	      echo form_input(array('name' => 'name', 'class' => 'form-control', 'placeholder' => 'Product name'));
    	?>
	  </div>
	  <div class="form-group">
      <?php
	    	echo form_label('Price');
	      echo form_input(array('name' => 'price', 'class' => 'form-control', 'placeholder' => 'Product price', 'type' => 'number'));
	    ?>
	  </div>
	  <div class="form-group">
      <?php
	    	echo form_label('Product Quantity');
	      echo form_input(array('name' => 'quantity', 'class' => 'form-control', 'placeholder' => 'Quantity', 'type' => 'number'));
	    ?>
	  </div>
	  <div class="form-group">
      <?php
		  	$options = array();

				foreach ($categories as $category) {
					if ($category['id'] != 1) {
						$options[$category['id']] = $category['name'];
					}
				}
	    	echo form_label('Product Category');
	  		echo form_dropdown('category_id', $options, 1, 'class="form-control"');
	    ?>
	  </div>
	  <div class="form-group">
      <?php
	    	echo form_label('Product Description');
	      echo form_textarea(array('name' => 'description', 'class' => 'form-control', 'placeholder' => 'Product description'));
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
