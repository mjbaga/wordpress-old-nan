<main id="main" class="main">
	<div class="banner-wrap">
		<div class="banner">
			<div class="content">
				<div class="container">
					<div class="page-title"></div>
					<h1 class="page-text"><?php print $data->banner_text ?></h1>
				</div>
			</div>
			<div class="banner-image">
				<div class="image-container">
					<img src="<?php print $data->banner ?>" alt="<?php print $data->banner_alt ?>">
				</div>
			</div>
		</div>
		<div class="search-homepage">
			<div class="container">
				<div class="row">
					<form action="<?php print $data->articles_page ?>" method="GET" name="search-articles">
						<select name="cat" class="input-select searchbox-select col-md-3 col-sm-12 col-xs-12">
							<option value="all" data-display="All Categories">All Categories</option>
							<?php if(!empty($data->article_categories)): ?>
								<?php foreach($data->article_categories as $cat): ?>
									<option value="<?php print $cat['id'] ?>"><?php print $cat['title'] ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
						<input placeholder="What are you looking for?" name="term" class="input-text searchbox-input col-md-7 col-sm-12 col-xs-12">
						<button class="btn searchbox-btn col-md-2 col-sm-12 col-xs-12">
							<div><i class="icon icon-search"></i><span>Search</span></div>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="topics">
		<div class="container clearfix">
			<div class="articles">
				<h3 class="heading"><?php print $data->articles_heading ?></h3>
				<p class="subtext"><?php print $data->articles_text ?></p>
				<div class="quick-links">
					<?php if(!empty($data->article_categories)): ?>
						<?php foreach($data->article_categories as $cat): ?>
							<div class="cat-icon">
								<div class="cat-icon__item">
									<a href="<?php print $data->articles_page ?>?cat=<?php print $cat['id'] ?>" class="cat-icon__link">
										<i class="icon <?php print $cat['icon'] ?>"></i>
										<span class="cat-icon__title"><?php print $cat['title'] ?></span>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="section-image"><img src="<?php print ASSETS_URL ?>/notAnoobie/images/temp/topic-img.jpg"></div>
	</div>
	<div class="articles-section clearfix">
		<?php print $data->articles ?>
	</div>
	<div class="tips clearfix">
		<?php print $data->tip_of_the_day ?>
		<div class="resources">
			<div class="container">
				<?php if(!empty($data->discoverables)): ?>
					<div class="cards">
						<?php foreach($data->discoverables as $disc): ?>
							<div class="cards__wrap">
								<a href="<?php print $disc['link'] ?>" class="card-link">
									<div class="image-text-card">
										<div class="image-text-card__item has-match-height">
											<div class="image">
												<img src="<?php print $disc['image']['url'] ?>" alt="<?php $disc['title'] ?>">
											</div>
											<div class="content">
												<h3 class="title">
													<?php print $disc['title'] ?>
												</h3>
												<p class="desc">
													<?php print $disc['description'] ?>
												</p>
												<span class="readmore">
													<span class="readmore__text">Find out more</span>
													<i class="icon icon-arrow-right"></i>
												</span>
											</div>
										</div>
									</div>
								</a>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
	<?php if(!empty($data->stories)): ?>
		<div class="stories-section clearfix">
			<div class="container">
				<h2 class="section-title">Success Stories</h2>
				<div class="stories-carousel">
					<div class="stories-carousel__text carousel-match">
						<?php foreach($data->stories as $story): ?>
							<div class="slide">
								<div class="stories-carousel__item">
									<div class="text">
										<blockquote>
											<span class="item-text"><?php print $story['excerpt'] ?></span>
										</blockquote>
										<a class="btn cta is-reverse" href="<?php print $story['url'] ?>" target="_self"><span><span class="btn__text">Read More</span></span>
										</a>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
					<div class="stories-carousel__image carousel-match">
						<?php foreach($data->stories as $story): ?>
							<div class="slide">
								<div class="image">
									<?php print $story['thumbnail'] ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<a href="<?php print $data->all_stories_link ?>" class="readmore">
					<span class="readmore__text">View all Stories</span>
					<i class="icon icon-arrow-right"></i>
				</a>
			</div>
		</div>
	<?php endif ?>
</main>