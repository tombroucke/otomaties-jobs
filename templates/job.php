<?php if (!empty($meta)) : ?>
<table class="table">
    <tbody>
        <?php foreach ($meta as $metaItem) : ?>
        <tr>
            <th scope="row"><?php esc_html_e($metaItem['label']); ?></th>
            <td><?php esc_html_e($metaItem['value']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php if (isset($description) && $description && '' != $description) : ?>
    <h2><?php _e('Description', 'otomaties-jobs'); ?></h2>
    <?php
        $allowedHtml = apply_filters('otomaties_jobs_job_content_allowed_html', [
            'a' => ['href' => [], 'title' => [], 'target' => []],
            'br' => [],
            'em' => [],
            'h1' => [],
            'h2' => [],
            'h2' => [],
            'h4' => [],
            'h5' => [],
            'h6' => [],
            'ul' => [],
            'ol' => [],
            'li' => [],
            'p' => [],
            'strong' => []
        ]);
        echo wp_kses($description, $allowedHtml);
        ?>
<?php endif; ?>

<?php if (isset($location) && $location) : ?>
    <h2><?php _e('Location', 'otomaties-jobs'); ?></h2>
    <p><?php echo wp_kses($location, ['br' => []]); ?></p>
<?php endif; ?>

<?php if (isset($applicationFormShortcode) && $applicationFormShortcode) : ?>
    <?php do_action('otomaties_jobs_before_application_form'); ?>
    <?php echo do_shortcode($applicationFormShortcode); ?>
    <?php do_action('otomaties_jobs_after_application_form'); ?>
<?php endif; ?>
