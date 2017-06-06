<h1 class="page-title"><?= $title ?></h1>
<h2 class="category-type"><?= $type ?></h2>
<?php
	$options = array();
	foreach ($categories as $category) {
		$options[$category['id']] = $category['name'];
	}
?>
<div>
<div>
<?php echo form_open('categories'); ?>
	<?php echo form_dropdown('category_id', $options); ?>
	<?php echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default')); ?>
<?php echo form_close(); ?>
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
				 echo form_submit(array('value' => 'Add', 'class' => 'btn btn-default'));
				?>
				<!-- why doesn't <?php form_close(); ?> work -->
			</form>

			<a href="<?php echo base_url(); ?>products/<?php echo $product['id'] ?>" class="btn btn-default">Details</a>

			<?php if ($this->session->userdata('logged_in')) : ?>
				<?php echo form_open('/products/delete/'.$product['id']); ?>
					<?php echo form_submit(array('value' => 'Delete', 'class' => 'btn btn-danger')); ?>
					<!-- why doesn't <?php form_close(); ?> work -->
				</form>
			<?php endif; ?>
		</div>
	</div>
<?php endforeach; ?>
</div>
