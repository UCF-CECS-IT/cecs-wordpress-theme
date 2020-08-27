<?php
$image      = false;
$title_elem = ( is_home() || is_front_page() ) ? 'h1' : 'span';

$menu_container_class = 'collapse navbar-collapse';
if ( ! $image ) {
	$menu_container_class = $menu_container_class . ' align-self-lg-stretch';
}

$menu = wp_nav_menu( array(
	'container'       => 'div',
	'container_class' => $menu_container_class,
	'container_id'    => 'sub-menu',
	'depth'           => 0,
	'echo'            => false,
	'fallback_cb'     => 'bs4Navwalker::fallback',
	'menu_class'      => 'nav navbar-nav ml-md-auto',
	'theme_location'  => 'sub-menu',
	'walker'          => new bs4Navwalker()
) );
?>

<nav id="sub-menu-nav" class="navbar navbar-toggleable-md navbar-custom<?php echo $image ? ' py-2 py-sm-4 navbar-inverse header-gradient' : ' navbar-light bg-primary'; ?>" role="navigation" aria-label="Site navigation">
	<div class="container w-100 d-flex flex-row flex-nowrap justify-content-lg-center justify-content-between">
		<!-- <<?php echo $title_elem; ?> class="mb-0">
			<a class="navbar-brand mr-lg-5" href="<?php echo get_home_url(); ?>"><?php echo bloginfo( 'name' ); ?></a>
		</<?php echo $title_elem; ?>> -->

		<?php if ( $menu ): ?>
		<button class="navbar-toggler ml-auto align-self-start collapsed" type="button" data-toggle="collapse" data-target="#sub-menu" aria-controls="sub-menu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-text">Navigation</span>
			<span class="navbar-toggler-icon"></span>
		</button>

		<?php echo $menu; ?>
		<?php endif; ?>
	</div>
</nav>