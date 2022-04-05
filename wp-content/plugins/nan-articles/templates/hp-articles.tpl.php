<div class="container">
	<div class="main-article">
		<h2 class="section-title"><?php print $this->data['most_read_label'] ?></h2>
		<?php if(!empty($this->data['most_read'])): ?>
			<a href="<?php print $this->data['most_read']['url'] ?>" class="card-link">
				<div class="main-article__image image">
					<?php echo $this->data['most_read']['thumbnail'] ?>
				</div>
				<div class="content">
					<span class="main-article__category category"><?php print $this->data['most_read']['category'] ?></span>
					<h3 class="main-article__title"><?php print $this->data['most_read']['title'] ?></h3>
				</div>
			</a>
		<?php endif ?>
	</div>
	<div class="articles-listing">
		<h2 class="section-title"><?php print $this->data['articles_label'] ?></h2>
		<div class="articles-listing__list">
			<?php if(!empty($this->data['articles'])): ?>
				<?php foreach ($this->data['articles'] as $article): ?>
					<a href="<?php print $article['url'] ?>" class="card-link">
						<div class="article-thumbnail clearfix">
							<div class="image">
								<?php print $article['thumbnail'] ?>
							</div>
							<div class="content">
								<span class="article-thumbnail__category category">
									<?php print $article['category'] ?>
								</span>
								<h3 class="article-thumbnail__title">
									<?php print $article['title'] ?>
								</h3>
							</div>
						</div>
					</a>
				<?php endforeach ?>
			<?php endif ?>
			<a href="<?php print $this->data['view_all_link'] ?>" class="readmore">
				<span class="readmore__text">View all articles</span><i class="icon icon-arrow-right"></i>
			</a>
		</div>
	</div>
</div>