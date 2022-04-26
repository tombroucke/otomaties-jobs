<table class="table mb-4">
    <?php if ($employmentTypes) : ?>
        <tr>
            <th><?php _e('Employment type', 'otomaties-jobs'); ?></th>
            <td><?php echo esc_html(implode(', ', $employmentTypes)); ?></td>
        </tr>
    <?php endif; ?>
    <?php if ($publicationDate) : ?>
        <tr>
            <th><?php _e('Publication date', 'otomaties-jobs'); ?></th>
            <td><?php echo esc_html(date_i18n(get_option('date_format'), $publicationDate->getTimestamp())); ?></td>
        </tr>
    <?php endif; ?>
    <?php if ($applicationDeadline) : ?>
        <tr>
            <th><?php _e('Application deadline', 'otomaties-jobs'); ?></th>
            <td><?php echo esc_html(date_i18n(get_option('date_format'), $applicationDeadline->getTimestamp())); ?></td>
        </tr>
    <?php endif; ?>
</table>

<?php if ($description && '' != $description) : ?>
    <h3><?php _e('Description', 'otomaties-jobs'); ?></h3>
    <?php echo wp_kses($description, ['a' => [], 'br' => [], 'p' => [], 'em' => [], 'strong' => [], 'ul' => [], 'li' => []]); ?>
<?php endif; ?>

<?php if ($location) : ?>
    <h3><?php _e('Location', 'otomaties-jobs'); ?></h3>
    <p><?php echo esc_html($location); ?></p>
<?php endif; ?>

<?php if ($company) : ?>
    <h3><?php _e('Company', 'otomaties-jobs'); ?></h3>
    <p>
        <?php if ($company->name) : ?>
            <?php echo esc_html($company->name); ?><br>
        <?php endif; ?>
        <?php if ($company->addressStreet) : ?>
            <?php echo esc_html($company->addressStreet); ?> <?php echo esc_html($company->addressNumber); ?><br>
        <?php endif; ?>
        <?php if ($company->addressPostcode) : ?>
            <?php echo esc_html($company->addressPostcode); ?> <?php echo esc_html($company->addressCity); ?><br>
        <?php endif; ?>
    </p>
    <p>
        <?php if ($company->email) : ?>
            <?php echo esc_html($company->email); ?><br>
        <?php endif; ?>
        <?php if ($company->website) : ?>
            <?php echo esc_url($company->website); ?><br>
        <?php endif; ?>
    </p>
<?php endif; ?>

<?php if ($applicationFormShortcode) : ?>
    <?php echo do_shortcode($applicationFormShortcode); ?>
<?php endif; ?>
