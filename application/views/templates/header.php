<html>
	<head>
		<title>Simple CI/PHP Shopping Cart</title>
		<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	</head>
	<body>

		<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo base_url(); ?>products">Codeignite</a>
			</div>
			<div id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_url(); ?>products">Home</a></li>
					<li class="categories"><a href="<?php echo base_url(); ?>categories">Categories</a></li>
					<?php if ($this->session->userdata('logged_in')) : ?>
						<li><a href="<?php echo base_url(); ?>products/create">Add a product</a></li>
					<?php endif; ?>

					<?php if (!$this->session->userdata('logged_in')) : ?>
						<li><a href="<?php echo base_url(); ?>users/register">Register</a></li>
						<li><a href="<?php echo base_url(); ?>users/login">Login</a></li>
					<?php endif; ?>

				</ul>
				<ul class="nav navbar-nav navbar-right">
				<?php if ($this->session->userdata('logged_in')) : ?>
					<li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>
				<?php endif; ?>
					<li><a>Currency</a></li>
						<?php
							$options = array();

							foreach (array_keys($currencies) as $currency) {
								$options[$currency] = $currencies[$currency].' ('. $currency.')';
							};

							echo form_open('currencies');
							echo form_dropdown('currency', $options);
							echo form_submit(array('value' => 'Submit'));
							echo form_close();
						?>
					<li><a href="<?php echo base_url(); ?>carts">My cart (<?php echo $this->cart->total_items(); ?>)</a></li>
			</div>
		</div>
	</nav>

		<div class="flex-container">

			<?php if ($this->session->flashdata('user_registered')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('login_failed')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_logged_in')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_logged_in').'</p>'; ?>
      <?php endif; ?>

       <?php if ($this->session->flashdata('user_logged_out')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_logged_out').'</p>'; ?>
      <?php endif; ?>

       <?php if ($this->session->flashdata('created_comment')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('created_comment').'</p>'; ?>
      <?php endif; ?>

       <?php if ($this->session->flashdata('deleted_comment')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('deleted_comment').'</p>'; ?>
      <?php endif; ?>

       <?php if ($this->session->flashdata('edited_comment')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('edited_comment').'</p>'; ?>
      <?php endif; ?>

       <?php if ($this->session->flashdata('order_submitted')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('order_submitted').'</p>'; ?>
      <?php endif; ?>
