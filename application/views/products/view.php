<?php setlocale(LC_MONETARY, 'en_US.UTF-8'); ?>
<div class="single-product">
	<div class="single-product-container">
		<div class="single-product-image">
		<img class="product-view-image" src="<?php echo base_url(); ?>assets/images/products/<?php echo $product['product_image']; ?>">
		</div>
		<div class="single-product-information">
			<h3><strong>Product name:</strong></h3><h4> <?php echo $product['name']; ?></h4>
			<h3><strong>Product price:</strong></h3><h4> <?php echo money_format('%.2n', $product['price']); ?></h4>
			<h3><strong>Product description:</strong></h3> <span><?php echo $product['description']; ?></span>
		</div>
		<?php if ($this->session->userdata('logged_in') and $this->session->userdata('user_id') == $product['user_id']) : ?>
			<a href="<?php echo base_url(); ?>products/edit/<?php echo $product['id']; ?>" class="btn btn-default">Edit product</a>
			<?php
				echo form_open('/products/delete/'.$product['id']);
				echo form_submit(array('value' => 'Delete', 'class' => 'btn btn-danger'));
				echo form_close();
			?>
		<?php endif; ?>
	</div>

	<div class="comment-container">
	<h2>Comments</h2>
		<?php if($comments) : ?>
			<?php foreach ($comments as $comment) : ?>
				<div class="well">
				<?php if ($comment['user_id'] === $this->session->userdata('user_id')) : ?>
					<div class="product-buttons">
						<a href="<?php echo base_url(); ?>comments/edit/<?php echo $comment['id']; ?>" class="btn btn-default">Edit</a>
						</form>
						<?php
							echo form_open('/comments/delete/'.$comment['id']);
							echo form_hidden('product_id', $product['id']);
							echo form_submit(array('value' => 'Delete', 'class' => 'btn btn-danger'));
							echo form_close();
						?>
					</div>
				<?php endif; ?>
					<?php $datestring = '%M %d %Y - %h:%i %A'; ?>
					<h5><strong><?php echo $comment['name']; ?>: </strong><?php echo $comment['comment']; ?></h5>
					<h6><strong><?php echo mdate($datestring, strtotime($comment['created_at'])); ?></strong></h6>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<h2>No comments yet!</h2>
		<?php endif; ?>
	</div>

	<div class="enter-comment-container">

		<?php echo validation_errors('<span class="error-text">', '</span>'); ?>

		<h2>Add comment</h2>
			<div class="form-group">
				<?php
					echo form_open('/comments/create/'.$product['id']);
				  echo form_label('Enter name');
		      echo form_input(array('name' => 'name', 'class' => 'form-control', 'placeholder' => 'Enter name'));
				  echo form_label('Enter comment');
		      echo form_textarea(array('name' => 'comment', 'class' => 'form-control', 'placeholder' => 'Enter comment'));
					echo form_hidden('id', $product['id']);
		      echo form_submit(array('value' => 'Submit', 'class' => 'btn btn-default'));
		    ?>
			</div>
		</form>
	</div>

</div>
