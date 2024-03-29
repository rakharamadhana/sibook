<?php

if ($this->userauth->loggedin()) {
	$menu[1]['text'] = img('assets/images/ui/link_controlpanel.gif', FALSE, 'hspace="4" align="top" alt=" "') . 'Control Panel';
	$menu[1]['href'] = site_url('controlpanel');
	$menu[1]['title'] = 'Tasks';

	if($this->userauth->is_level(ADMINISTRATOR)){ $icon = 'user_administrator.gif'; } else { $icon = 'user_teacher.gif'; }
	$menu[3]['text'] = img('assets/images/ui/logout.gif', FALSE, 'hspace="4" align="top" alt=" "') . 'Logout';
	$menu[3]['href'] = site_url('logout');
	$menu[3]['title'] = 'Log out of classroombookings';
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Craig A Rodway">
		<title>SIBOOK | <?= html_escape($title) ?></title>
		<!-- <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/style.css') ?>"> -->
		<link rel="stylesheet" type="text/css" media="print" href="<?= base_url('assets/print.css') ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/sorttable.css') ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/datepicker.css') ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/semantic.min.css') ?>">
		
		<!-- FAVICON to be Changed
		<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/brand/apple-touch-icon.png') ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/brand/favicon-32x32.png') ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/brand/favicon-16x16.png') ?>">
		<link rel="shortcut icon" href="<?= base_url('assets/brand/favicon.ico') ?>">
		-->

		<link rel="manifest" href="<?= base_url('assets/brand/site.webmanifest') ?>">
		<link rel="mask-icon" href="<?= base_url('assets/brand/safari-pinned-tab.svg') ?>" color="#ff6400">
		<meta name="msapplication-TileColor" content="#ff6400">
		<meta name="msapplication-config" content="<?= base_url('assets/brand/browserconfig.xml') ?>">
		<meta name="theme-color" content="#ff6400">
		<script>
		var h = document.getElementsByTagName("html")[0];
		(h ? h.classList.add('js') : h.className += ' ' + 'js');
		var Q = [];
		var BASE_URL = "<?= base_url() ?>";
		</script>
	</head>
	<body style="">
		<!-- Header/Navbar -->
		<div class="ui inverted fluid menu" style='border-radius:0;'>
			<a href="<?php echo site_url('controlpanel') ?>" class="header item">
				<img class="logo" src="assets/images/logo.png">
				<span style='margin-left: 10px;'>YBPMMD | SIBOOK</span>
			</a>
			
			<!-- If user login -->
			<?php if($this->userauth->loggedin()) { ?>
			<div class="right menu">
				<div class="ui simple dropdown item">
					<?php
						$output = html_escape(strlen($this->userauth->user->displayname) > 1 ? $this->userauth->user->displayname : $this->userauth->user->username);
						echo "<span>{$output}</span>";
					?>
					<i class="dropdown icon"></i>
					<div class="menu">
						<div class="header">Option</div>
						<?php
							$i=0;
							if(isset($menu)){
								foreach( $menu as $link ){
									echo '<a class="item" href="'.$link['href'].'" title="'.$link['title'].'">'.$link['text'].'</a>';
									if( $i < count($menu)-1 )
									echo '<div class="divider"></div>';
									$i++;
								}
							}
						?>
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- Close if -->
		</div>

		<!-- Middle -->
		<div class='middle'>
			<?php if (isset($midsection)): ?>
				<div class="mid-section" align="center">
					<h1 style="font-weight:normal"><?php echo $midsection ?></h1>
				</div>
			<?php endif; ?>
		</div>

		<!-- Main -->
		<div class="ui main text container" style='margin-bottom: 100px;'>
			<?php if(isset($showtitle)){ echo '<h2>'.html_escape($showtitle).'</h2>'; } ?>
			<?php echo $body ?>
		</div>
		
		<!-- Footer -->
		<div class="ui inverted vertical footer fluid segment">
			<div class="ui center aligned container">
				<div class="ui stackable inverted divided grid">
					<div class="eight wide column">
						<h4 class="ui inverted header">Menu</h4>
						<?php
							if (isset($menu)) {
								foreach( $menu as $link ) {
									echo "\n".'<a href="'.$link['href'].'" title="'.$link['title'].'">'.$link['text'].'</a>'."\n";
									echo img('assets/images/blank.png', FALSE, 'width="16" height="10" alt=" "');
								}
							} else {
								echo "<span>Mohon login untuk melihat menu</span>";
							}
						?>
					</div>
					<div class="eight wide column">
						<h4 class="ui inverted header">SIBOOK</h4>
						<p>Sistem Informasi Booking Ruangan YBPMMD</p>
					</div>
				</div>
				<div class="ui inverted section divider"></div>
				<span style="font-size:90%;color:#678; line-height: 2">
					<span>Supported by</span>
					<a href="https://www.classroombookings.com/" target="_blank">CRBS</a> ver <?= VERSION ?>.
					&copy; <?= date('Y') ?>
					<br />
					<!-- Load time: <?php echo $this->benchmark->elapsed_time() ?> seconds. -->
				</span>
			</div>
		</div>	
		
		<!-- Scripts -->
		<?php
		$scripts = array();
		$scripts[] = base_url('assets/js/prototype.lite.js');
		$scripts[] = base_url('assets/js/util.js');
		$scripts[] = base_url('assets/js/sorttable.js');
		$scripts[] = base_url('assets/js/datepicker.js');
		$scripts[] = base_url('assets/js/semantic.min.js');
		// $scripts[] = base_url('assets/js/imagepreview.js');

		foreach ($scripts as $script)
		{
			echo "<script type='text/javascript' src='{$script}'></script>\n";
		}

		?>

		<script>
		(function() {
			if (typeof(window['Q']) !== "undefined") {
				for (var i = 0, len = Q.length; i < len; i++) {
					Q[i]();
				}
			}
		})();
		</script>
	</body>
</html>
