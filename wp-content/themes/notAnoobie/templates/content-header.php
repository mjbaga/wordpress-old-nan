<div class="mobile-menu">
	<div class="mobile-menu__wrap">
		<button class="btn btn--arrow">
			<i class="icon icon-back"></i>
		</button>
		<?php print $data->mobile_legal_navigation ?>
		<?php print $data->copyright; ?>
	</div>
</div>
<div class="mobile-overlay"></div>
<header class="main-header">
	<div class="header-sticky">
		<div class="container">
			<div class="menu-wrap mobile-only">
				<button class="js-mobile-menu">
					<span class="visuallyhidden">Toggle mobile menu</span>
					<i class="icon icon-menu"></i>
				</button>
			</div>
			<div class="logo-wrap">
				<a href="/">
					<img src="<?php print $data->logo1 ?>" alt="notAnoobie Logo" class="svg is-white">
					<img src="<?php print $data->logo2 ?>" alt="notAnoobie Logo" class="svg is-coloured">
				</a>
			</div>
			<div class="nav-wrap">
				<div class="navigation desktop-only">
					<div class="nav">
						<div class="nav-container">
							<nav>
								<?php print $data->primary_navigation; ?>
							</nav>
						</div>
					</div>
				</div>
				<div class="search-wrap">
					<button><i class="icon icon-search"></i><span class="vh">Search</span></button>
				</div>
			</div>
		</div>
		<div class="search-bar__wrap">
			<?php print $data->header_search ?>
		</div>
	</div>
</header>
<div class="scroll-wrap">