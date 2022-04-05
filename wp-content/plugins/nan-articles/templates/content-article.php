<main id="main" class="main">
	<div class="banner banner-detail">
		<div class="content">
			<div class="container">
				<div class="page-title"></div>
				<h1 class="page-text"></h1>
			</div>
		</div>
		<div class="banner-image">
			<div class="image-container">
				<img src="<?php print $this->data['image'] ?>" alt="<?php $this->data['image_alt'] ?>">
			</div>
		</div>
	</div>
	<div class="article-details-section">
		<div class="container">
			<div class="article-details-section__wrap">
				<div class="row">
					<div class="col-md-2 col-sm-2 share-section align-right no-mobile">
						<div class="social-icon">
							<div class="social-icon__item">
								<a href="#" class="social-icon__link addthis_button_facebook">
									<i class="icon icon-facebook"></i>
								</a>
								<a href="#" class="social-icon__link addthis_button_email">
									<i class="icon icon-envelope"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<?php print $this->data['breadcrumbs'] ?>
						<div class="container">
							<div class="content">
								<div class="rte">
									<span class="main-article__category"><?php print $this->data['category'] ?></span>
									<h1><?php print $this->data['title'] ?></h1>
									<?php  print $this->data['content'] ?>
								</div>
								<div class="share-bar">
									<div class="share-bar__text">Share this article:</div>
									<div class="social-icon">
										<div class="social-icon__item">
											<a href="#" class="social-icon__link addthis_button_facebook">
												<i class="icon icon-facebook"></i>
											</a>
											<a href="#" class="social-icon__link addthis_button_email">
												<i class="icon icon-envelope"></i>
											</a>
										</div>
									</div>
								</div>
								<div class="footnote">
									<?php print $this->data['references'] ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="other-articles">
		<div class="container">
			<?php print $this->data['other_articles'] ?>
		</div>
	</div>
</main>