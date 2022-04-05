<main id="main" class="main">
	<div class="banner">
		<div class="content">
			<div class="container">
				<div class="page-title"><?php print $this->data['title'] ?></div>
				<h1 class="page-text"><?php print $this->data['hero_heading'] ?></h1>
			</div>
		</div>
		<div class="banner-image">
			<div class="image-container">
				<?php print $this->data['hero_image'] ?>
			</div>
		</div>
	</div>
	<div class="cat-bar-container">
		<div class="container">
			<div class="cat-bar space-around">
				<div class="cat-icon">
					<div class="cat-icon__item">
						<a href="<?php print $this->data['url'] ?>" class="cat-icon__link <?php print $this->data['category'] == 'all' ? 'active' : '' ?>">
							<i class="icon icon-all"></i>
							<span class="cat-icon__title">All</span>
						</a>
					</div>
				</div>
				<?php if(!empty($this->data['categories'])): ?>
					<?php foreach ($this->data['categories'] as $i => $cat): ?>
						<div class="cat-icon">
							<div class="cat-icon__item">
								<a href="<?php print $this->data['url'] ?>?cat=<?php print $cat['id'] ?>" class="cat-icon__link <?php print $this->data['category'] == $cat['id'] ? 'active' : ''; ?>">
									<i class="icon <?php print $cat['icon'] ?>"></i>
									<span class="cat-icon__title"><?php print $cat['title'] ?></span>
								</a>
							</div>
						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="listing-area">
		<?php print $this->data['breadcrumbs'] ?>
		<div class="filters clearfix">
			<div class="container">
				<div class="search-filter">
					<form action="<?php print $this->data['url'] ?>" method="GET" name="search-articles">
						<label for="siteSearch" class="visuallyhidden">Search</label>
						<input type="hidden" name="cat" value="<?php print $this->data['category'] ?>">
						<input id="siteSearch" placeholder="<?php print $this->data['cattext'] ?>" name="term" value="<?php print $this->data['term'] ?>">
						<button type="submit" class="btn-search"><span class="visuallyhidden">Submit search</span><i class="icon-search"></i></button>
					</form>
				</div>
				<div class="filter-group">
					<label for="age-filter" class="input-select-label">Filter by:</label>
					<select name="age-filter" class="input-select age-filter">
						<option value="all">For all ages</option>
						<option value="preschool">Preschool</option>
						<option value="preteens">Pre-teens</option>
						<option value="teens">Teens</option>
					</select>
				</div>
			</div>
		</div>
		<div class="results-text clearfix">
			<div class="container">
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="article-cards" data-api="/wp-json/articles/latest" data-toload="0" data-nextstart="0" data-itemleft="10" data-posttype="<?php print $this->data['post_type'] ?>" data-category="<?php print $this->data['category'] ?>">
				</div>
				<script id="articlesList" type="text/x-dot-template">
					{{~ it:article:index }}
						<div class="col-md-4 col-sm-6 col-xs-6">
							<a href="{{=article.url}}" class="card-link">
								<div class="image-text-card">
									<div class="image-text-card__item has-match-height">
										<div class="image">
											{{=article.thumbnail}}
										</div>
										<div class="content">
											<span class="category">{{=article.category}}</span>
											<h3 class="title">{{=article.title}}</h3>
										</div>
									</div>
								</div>
							</a>
						</div>
					{{~}}
				</script>
			</div>
		</div>
	</div>
</main>