<div class="row">
	<div class="other-articles__title">
		<h2><?php print $this->data['heading'] ?></h2>
		<div class="article-cards cards clearfix">
			<?php if(!empty($this->data['articles'])): ?>
				<?php foreach($this->data['articles'] as $article): ?>
					<div class="cards__wrap">
						<a href="<?php print $article['url'] ?>" class="card-link">
							<div class="image-text-card">
								<div class="image-text-card__item has-match-height">
									<div class="image">
										<?php print $article['thumbnail'] ?>
									</div>
									<div class="content">
										<span class="category">
											<?php print $article['category'] ?>
										</span>
										<h3 class="title">
											<?php print $article['title'] ?>
										</h3>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</div>
	</div>
</div>