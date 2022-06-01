<table class="table">
    <?php if ($employmentTypes) : ?>
        <tr>
            <th><?php _e('Employment type', 'otomaties-jobs'); ?></th>
            <td><?php esc_html_e(implode(', ', $employmentTypes)); ?></td>
        </tr>
    <?php endif; ?>
    <?php if ($publicationDate) : ?>
        <tr>
            <th><?php _e('Publication date', 'otomaties-jobs'); ?></th>
            <td><?php esc_html_e($publicationDate->format(get_option('date_format'))); ?></td>
        </tr>
    <?php endif; ?>
    <?php if ($applicationDeadline) : ?>
        <tr>
            <th><?php _e('Application deadline', 'otomaties-jobs'); ?></th>
            <td><?php esc_html_e($applicationDeadline->format(get_option('date_format'))); ?></td>
        </tr>
    <?php endif; ?>
</table>

<?php if ($description && '' != $description) : ?>
    <h3><?php _e('Description', 'otomaties-jobs'); ?></h3>
    <?php echo wp_kses($description, ['a' => [], 'br' => [], 'em' => [], 'h1' => [], 'h2' => [], 'h3' => [], 'h4' => [], 'h5' => [], 'h6' => [], 'ul' => [], 'ol' => [], 'li' => [], 'p' => [], 'strong' => []]); ?>
<?php endif; ?>

<?php if ($location) : ?>
    <h3><?php _e('Location', 'otomaties-jobs'); ?></h3>
    <p><?php echo wp_kses($location, ['br' => []]); ?></p>
<?php endif; ?>

<?php if ($applicationFormShortcode) : ?>
    <?php echo do_shortcode($applicationFormShortcode); ?>
<?php endif; ?>
