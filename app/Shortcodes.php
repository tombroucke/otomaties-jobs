<?php
namespace Otomaties\Jobs;

/**
 * WordPress shortcodes
 */
class Shortcodes
{

    /**
     * Shortcode callback
     *
     * @param  array $atts The shortcut attributes.
     * @return string
     */
    public function jobs()
    {
        $args = [
            'post_type' => 'job',
            'posts_per_page' => -1
        ];
        $posts = new \WP_Query($args);
		ob_start();
		if($posts->have_posts()) {
			while($posts->have_posts()) {
				$posts->the_post();
				include(__DIR__ . '/../templates/content-job.php');
			}
		}
		wp_reset_postdata();
		return apply_filters('jobs_html', ob_get_clean(), $posts);
    }
}
