<h1 class="page-title"><?= $title ?></h1>
<h2 class="category-type"><?= $type ?></h2>

<div>
<div>
<?php
	$options = array();

	foreach ($categories as $category) {
		$options[$category['id']] = $category['name'];
	}

	echo form_open('categories');
  echo form_dropdown('category_id', $options);
  echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default'));
 	echo form_close();
?>
</div>
<div class="products">
<?php foreach ($products as $product): ?>

	<div class="product">
		<?php if ($product['quantity'] == 0) : ?>
			<div class="sold-out">Sold out</div>
		<?php endif; ?>
		<a href="<?php echo base_url(); ?>products/<?php echo $product['id'] ?>">
			<img class="product-image" src="<?php echo base_url(); ?>assets/images/products/<?php echo $product['product_image']; ?>">
		</a>
		<p>Name: <?php echo $product['name']; ?></p>
		<p>Price: <?php echo money_format('%.2n', $product['price']); ?></p>
		<p>Description: <?php echo $product['description']; ?></p>
		<p>Quantity: <?php echo $product['quantity']; ?></p>
		<div class="product-buttons">
			<?php
				$hidden = array(
					'id' => $product['id'],
					'price' => $product['price'],
					'name' => $product['name'],
					'description' => $product['description']
				);
				echo form_open('products/add', '', $hidden);
				echo form_submit('', 'Add', ($product['quantity'] == 0 ? 'class="btn btn-default" disabled' : array('class' => 'btn btn-default') ));
				echo form_close();
			?>

			<a href="<?php echo base_url(); ?>products/<?php echo $product['id'] ?>" class="btn btn-default">Details</a>

			<?php
				if ($this->session->userdata('logged_in')) {
					echo form_open('/products/delete/'.$product['id']);
					echo form_submit(array('value' => 'Delete', 'class' => 'btn btn-danger'));
					echo form_close();
				}
			?>
		</div>
	</div>
<?php endforeach; ?>
</div>
