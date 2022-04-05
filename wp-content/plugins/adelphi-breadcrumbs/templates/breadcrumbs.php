<div class="container">
	<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs__list">
		<?php foreach( $data->breadcrumbs as $i => $b ): ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumbs__item">
			<?php if( !empty( $b['link'] ) ): ?>
				<a href="<?php print $b['link']; ?>" itemprop="item" class="breadcrumbs__link">
					<span itemprop="name"><?php print $b['title']; ?></span>
					<meta itemprop="position" content="<?php print $i ?>">
				</a>
			<?php else: ?>
				<span itemprop="item" class="breadcrumbs__link is-active">
					<span itemprop="name"><?php print $b['title']; ?></span>
					<meta itemprop="position" content="<?php print $i ?>">
				</span>
			<?php endif; ?>
		<?php endforeach; ?>
	</ol>
</div>