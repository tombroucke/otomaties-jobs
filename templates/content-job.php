<article class="job">
	<div class="entry__content">
		<header class="entry__header">
			<h2 class="entry__title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry__summary">
			<?php the_excerpt(); ?>
		</div>
		<div class="entry__footer d-flex justify-content-between mt-2">
			<div class="small">
				<?php get_the_category_list( ',' ); ?>
			</div>
			<div class="entry__read-more">
				<a class="btn btn-secondary" href="<?php echo get_permalink(); ?>#job-apply">
					<?php _e( 'Apply', 'otomaties-jobs' ); ?>
				</a>
				<a class="btn btn-primary" href="<?php echo get_permalink(); ?>">
					<?php _e( 'Read more', 'otomaties-jobs' ); ?>
				</a>
			</div>
		</div>
	</div>
</article>
