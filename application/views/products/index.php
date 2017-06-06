<?php setlocale(LC_MONETARY, 'en_US.UTF-8'); ?>
<h1 class="page-title"><strong><?= $title ?></strong></h1>

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

			<?php if ($this->session->userdata('logged_in') and $this->session->userdata('user_id') === $product['user_id']) : ?>
				<?php echo form_open('/products/delete/'.$product['id']); ?>
					<?php echo form_submit(array('value' => 'Delete', 'class' => 'btn btn-danger')); ?>
					<!-- why doesn't <?php form_close(); ?> work -->
				</form>
			<?php endif; ?>
		</div>
	</div>
<?php endforeach; ?>

