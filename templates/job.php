<table class="table">
    <?php if (isset($employmentTypes) && $employmentTypes) : ?>
        <tr>
            <th><?php _e('Employment type', 'otomaties-jobs'); ?></th>
            <td><?php esc_html_e(implode(', ', $employmentTypes)); ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($publicationDate) && $publicationDate) : ?>
        <tr>
            <th><?php _e('Publication date', 'otomaties-jobs'); ?></th>
            <td><?php esc_html_e($publicationDate->format(get_option('date_format'))); ?></td>
        </tr>
    <?php endif; ?>
    <?php if (isset($applicationDeadline) && $applicationDeadline) : ?>
        <tr>
            <th><?php _e('Application deadline', 'otomaties-jobs'); ?></th>
            <td><?php esc_html_e($applicationDeadline->format(get_option('date_format'))); ?></td>
        </tr>
    <?php endif; ?>
</table>

<?php if (isset($description) && $description && '' != $description) : ?>
    <h2><?php _e('Description', 'otomaties-jobs'); ?></h2>
    <?php echo wp_kses($description, ['a' => ['href' => [], 'title' => [], 'target' => []], 'br' => [], 'em' => [], 'h1' => [], 'h2' => [], 'h2' => [], 'h4' => [], 'h5' => [], 'h6' => [], 'ul' => [], 'ol' => [], 'li' => [], 'p' => [], 'strong' => []]); ?>
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
