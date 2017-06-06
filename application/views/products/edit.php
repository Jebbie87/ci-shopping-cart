<h1 class="page-title"><strong><?= $title ?></strong></h1>

<?php echo validation_errors('<span class="error-text">', '</span>'); ?>

<div class="container">
	<?php
		echo form_open_multipart('products/update');
		echo form_hidden('id', $product['id']);
	?>
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
  		echo form_label('Description');
  		echo form_textarea(array('name' => 'description', 'value' => $product['description'], 'class' => 'form-control', 'placeholder' => 'Product description'));
  	?>
  </div>
  <div class="form-group product-buttons">
	  <?php
	  	echo form_label('Product Image File');
	  	echo form_upload('userfile');
	  ?>
	  <h2>Current Image: </h2>
	  <img class="product-image" src="<?php echo base_url(); echo 'assets/images/products/'; echo $product['product_image'] ?>">
  </div>
  <?php
  	echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default'));
 		echo form_close();
 	?>
</div>
