<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if ($successMessage) : ?>
    <div class="alert alert-success">
        <p class="mb-0"><?php echo $successMessage; ?></p>
    </div>
<?php endif; ?>
<form class="otomaties-jobs-publish-form" action="" method="POST">
    <?php do_action('otomaties_jobs_before_publish_form'); ?>
    <?php do_action('otomaties_jobs_before_publish_form_title'); ?>
    <h2><?php _e('Job information', 'otomaties-jobs'); ?></h2>
    <?php do_action('otomaties_jobs_after_publish_form_title'); ?>
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="job_employment_type" class="form-label"><?php _e('Employment type', 'otomaties-jobs'); ?></label>
                <select name="job_employment_type" id="job_employment_type" class="form-select">
                    <option value="">- <?php _e('Select', 'otomaties-jobs'); ?> -</option>
                    <?php foreach ($jobTypes as $jobType) : ?>
                        <option value="<?php esc_attr_e($jobType->slug); ?>"><?php esc_html_e($jobType->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="job_title" class="form-label"><?php _e('Title', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="job_title" id="job_title" placeholder="<?php _e('Title', 'otomaties-jobs'); ?>" value="<?php esc_html_e($jobTitle); ?>" required>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="job_description" class="form-label"><?php _e('Description', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <textarea name="job_description" id="job_description" cols="30" rows="10" placeholder="<?php _e('Description', 'otomaties-jobs'); ?>" class="form-control" required><?php echo wp_kses($jobDescription, ['p' => [], 'br' => [], 'strong' => [], 'em' => [], 'h1' => [], 'h2' => [], 'h3' => [], 'h4' => [], 'h5' => [], 'h6' => [], 'ul' => [], 'ol' => [], 'li' => []]); ?></textarea>
            </div>
        </div>
    </div>
    <h2><?php _e('Address', 'otomaties-jobs'); ?></h2>
    <div class="row">
        <div class="col-sm-8">
            <div class="mb-3">
                <label for="address_street" class="form-label"><?php _e('Street', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="address_street" id="address_street" placeholder="<?php _e('Street', 'otomaties-jobs'); ?>" value="<?php esc_html_e($addressStreet); ?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="address_street_number" class="form-label"><?php _e('Number', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="address_street_number" id="address_street_number" placeholder="<?php _e('Number', 'otomaties-jobs'); ?>" value="<?php esc_html_e($addressStreetNumber); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="address_postcode" class="form-label"><?php _e('Postcode', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="address_postcode" id="address_postcode" placeholder="<?php _e('Postcode', 'otomaties-jobs'); ?>" value="<?php esc_html_e($addressPostcode); ?>">
            </div>
        </div>
        <div class="col-sm-8">
            <div class="mb-3">
                <label for="address_city" class="form-label"><?php _e('City', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="address_city" id="address_city" placeholder="<?php _e('City', 'otomaties-jobs'); ?>" value="<?php esc_html_e($addressCity); ?>">
            </div>
        </div>
    </div>
    <h2><?php _e('Dates', 'otomaties-jobs'); ?></h2>
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="publication_date" class="form-label"><?php _e('Publication date', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <input type="text" class="form-control datepicker" name="publication_date" id="publication_date" readonly="readonly" placeholder="<?php _e('Publication date', 'otomaties-jobs'); ?>" value="<?php esc_html_e($publicationDate); ?>" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="application_deadline" class="form-label"><?php _e('Application deadline', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <input type="text" class="form-control datepicker" name="application_deadline" id="application_deadline" readonly="readonly" placeholder="<?php _e('Application deadline', 'otomaties-jobs'); ?>" value="<?php esc_html_e($applicationDeadline); ?>" required>
            </div>
        </div>
    </div>
    <h2><?php _e('Employer', 'otomaties-jobs'); ?></h2>
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="company_name" class="form-label"><?php _e('Name', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="<?php _e('Name', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyName); ?>" required>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="company_description" class="form-label"><?php _e('Description', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <textarea class="form-control" cols="30" rows="10" name="company_description" id="company_description" placeholder="<?php _e('Description', 'otomaties-jobs'); ?>" required><?php echo wp_kses($companyDescription, ['p' => [], 'br' => [], 'strong' => [], 'em' => [], 'h1' => [], 'h2' => [], 'h3' => [], 'h4' => [], 'h5' => [], 'h6' => [], 'ul' => [], 'ol' => [], 'li' => []]); ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-612">
            <div class="mb-3">
                <label for="company_contact_name" class="form-label"><?php _e('Contact name', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="company_contact_name" id="company_contact_name" placeholder="<?php _e('Contact name', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyContactName); ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="company_website" class="form-label"><?php _e('Website', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="company_website" id="company_website" placeholder="<?php _e('Website', 'otomaties-jobs'); ?>" value="<?php echo esc_url($companyWebsite); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="company_email" class="form-label"><?php _e('E-mailaddress', 'otomaties-jobs'); ?></label>
                <input type="email" class="form-control" name="company_email" id="company_email" placeholder="<?php _e('E-mailaddress', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyEmail); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="company_phone" class="form-label"><?php _e('Phone', 'otomaties-jobs'); ?><span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="company_phone" id="company_phone" placeholder="<?php _e('Phone', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyPhone); ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="mb-3">
                <label for="company_address_street" class="form-label"><?php _e('Street', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="company_address_street" id="company_address_street" placeholder="<?php _e('Street', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyAddressStreet); ?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="company_address_street_number" class="form-label"><?php _e('Number', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="company_address_street_number" id="company_address_street_number" placeholder="<?php _e('Number', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyAddressStreetNumber); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="company_address_postcode" class="form-label"><?php _e('Postcode', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="company_address_postcode" id="company_address_postcode" placeholder="<?php _e('Postcode', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyAddressPostcode); ?>">
            </div>
        </div>
        <div class="col-sm-8">
            <div class="mb-3">
                <label for="company_address_city" class="form-label"><?php _e('City', 'otomaties-jobs'); ?></label>
                <input type="text" class="form-control" name="company_address_city" id="company_address_city" placeholder="<?php _e('City', 'otomaties-jobs'); ?>" value="<?php esc_html_e($companyAddressCity); ?>">
            </div>
        </div>
    </div>
    <?php do_action('otomaties_jobs_after_publish_form'); ?>
    <input class="visually-hidden" type="text" name="first_name" autocomplete="first_name_value_1">
    <input type="hidden" name="action" value="otomaties_jobs_publish_job">
    <?php wp_nonce_field('publish_job_nonce', 'publish_job'); ?>
    <button type="submit" class="btn btn-primary"><?php _e('Submit', 'otomaties-jobs'); ?></button>
</form>
