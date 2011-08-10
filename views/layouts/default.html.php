<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Austin PHP Meetup CRUD Blog &gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('debug', 'lithium', 'app')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="app">
	<div id="container">
		<div id="header">
			<h1>Austin PHP Meetup CRUD Blog</h1>
			<h2>
				Powered by <?php echo $this->html->link('Lithium', 'http://lithify.me/'); ?>.
			</h2>
		</div>
		<?php
			$admin = \lithium\storage\Session::read('user');
			$admin = $admin['is_admin'];
			if ($admin):
		?>
		<div id="new"><?php echo $this->html->link('New Post', 'Posts::create')?></div>
		<?php endif; ?>
		<div id="content">
			<?php echo $this->content(); ?>
		</div>
		<?php
			$params = $this->_request->params;
			if ($params['controller'] !== 'users' || $params['action'] !== 'login'): ?>
		<div>
		<?php if (!\lithium\security\Auth::check('user')): ?>
			<?php echo $this->html->link('Login', '/login')?> | <?php echo $this->html->link('Register', '/register')?>
		<?php else: ?>
			<?php echo $this->html->link('Logout', '/logout')?>
		<?php
			  endif;
			endif;
		?>
		</div>
		
	</div>
</body>
</html>