<?php

namespace Otomaties\Jobs;

use StoutLogic\AcfBuilder\FieldsBuilder;

class CustomPostTypes
{

    /**
     * Register post type job
     */
    public function addJobs()
    {
        $post_type      = 'job';
        $slug           = 'jobs';
        $singular_name  = __('Job', 'otomaties-jobs');
        $plural_name    = __('Jobs', 'otomaties-jobs');

        register_extended_post_type(
            $post_type,
            array(
                'show_in_feed' => false,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-calendar',
                'archive' => array(
                    'nopaging' => true,
                ),
                'public' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'labels' => $this->post_type_labels($singular_name, $plural_name),
                'dashboard_activity' => true,
                'supports' => ['title', 'editor', 'revisions', 'author'],

            ),
            array(
                'singular' => $singular_name,
                'plural'   => $plural_name,
                'slug'     => $slug,
            )
        );

        $slug           = 'job_employment_type';
        $singular_name  = __('Job employment type', 'otomaties-jobs');
        $plural_name    = __('Job employment types', 'otomaties-jobs');

        register_extended_taxonomy(
            $slug,
            $post_type,
            array(
                'publicly_queryable' => false,
                'meta_box' => 'radio',
                'labels' => $this->taxonomy_labels($singular_name, $plural_name),
            ),
            array(
                'plural' => $plural_name,
            )
        );
    }

    /**
     * Translate post type labels
     *
     * @param  string $singular_name The singular name for the post type.
     * @param  string $plural_name   The plural name for the post type.
     * @return array
     */
    private function post_type_labels($singular_name, $plural_name)
    {
        return array(
            'add_new'                  => __('Add New', 'otomaties-jobs'),
            /* translators: %s: singular post name */
            'add_new_item'             => sprintf(__('Add New %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'edit_item'                => sprintf(__('Edit %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'new_item'                 => sprintf(__('New %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'view_item'                => sprintf(__('View %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: plural post name */
            'view_items'               => sprintf(__('View %s', 'otomaties-jobs'), $plural_name),
            /* translators: %s: singular post name */
            'search_items'             => sprintf(__('Search %s', 'otomaties-jobs'), $plural_name),
            /* translators: %s: plural post name to lower */
            'not_found'                => sprintf(__('No %s found.', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: plural post name to lower */
            'not_found_in_trash'       => sprintf(__('No %s found in trash.', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: singular post name */
            'parent_item_colon'        => sprintf(__('Parent %s:', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'all_items'                => $plural_name,
            /* translators: %s: singular post name */
            'archives'                 => sprintf(__('%s Archives', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'attributes'               => sprintf(__('%s Attributes', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name to lower */
            'insert_into_item'         => sprintf(__('Insert into %s', 'otomaties-jobs'), strtolower($singular_name)),
            /* translators: %s: singular post name to lower */
            'uploaded_to_this_item'    => sprintf(__('Uploaded to this %s', 'otomaties-jobs'), strtolower($singular_name)),
            /* translators: %s: plural post name to lower */
            'filter_items_list'        => sprintf(__('Filter %s list', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: singular post name */
            'items_list_navigation'    => sprintf(__('%s list navigation', 'otomaties-jobs'), $plural_name),
            /* translators: %s: singular post name */
            'items_list'               => sprintf(__('%s list', 'otomaties-jobs'), $plural_name),
            /* translators: %s: singular post name */
            'item_published'           => sprintf(__('%s published.', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'item_published_privately' => sprintf(__('%s published privately.', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'item_reverted_to_draft'   => sprintf(__('%s reverted to draft.', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'item_scheduled'           => sprintf(__('%s scheduled.', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular post name */
            'item_updated'             => sprintf(__('%s updated.', 'otomaties-jobs'), $singular_name),
        );
    }

    /**
     * Translate taxonomy labels
     *
     * @param  string $singular_name The singular name for the taxonomy.
     * @param  string $plural_name   The plural name for the taxonomy.
     * @return array
     */
    private function taxonomy_labels($singular_name, $plural_name)
    {
        return array(
            /* translators: %s: plural taxonomy name */
            'search_items'               => sprintf(__('Search %s', 'otomaties-jobs'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'popular_items'              => sprintf(__('Popular %s', 'otomaties-jobs'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'all_items'                  => sprintf(__('All %s', 'otomaties-jobs'), $plural_name),
            /* translators: %s: singular taxonomy name */
            'parent_item'                => sprintf(__('Parent %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'parent_item_colon'          => sprintf(__('Parent %s:', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'edit_item'                  => sprintf(__('Edit %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'view_item'                  => sprintf(__('View %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'update_item'                => sprintf(__('Update %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'add_new_item'               => sprintf(__('Add New %s', 'otomaties-jobs'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'new_item_name'              => sprintf(__('New %s Name', 'otomaties-jobs'), $singular_name),
            /* translators: %s: plural taxonomy name to lower */
            'separate_items_with_commas' => sprintf(__('Separate %s with commas', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'add_or_remove_items'        => sprintf(__('Add or remove %s', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'choose_from_most_used'      => sprintf(__('Choose from most used %s', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'not_found'                  => sprintf(__('No %s found', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'no_terms'                   => sprintf(__('No %s', 'otomaties-jobs'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name */
            'items_list_navigation'      => sprintf(__('%s list navigation', 'otomaties-jobs'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'items_list'                 => sprintf(__('%s list', 'otomaties-jobs'), $plural_name),
            'most_used'                  => 'Most Used',
            /* translators: %s: plural taxonomy name */
            'back_to_items'              => sprintf(__('&larr; Back to %s', 'otomaties-jobs'), $plural_name),
            /* translators: %s: singular taxonomy name to lower */
            'no_item'                    => sprintf(__('No %s', 'otomaties-jobs'), strtolower($singular_name)),
            /* translators: %s: singular taxonomy name to lower */
            'filter_by'                  => sprintf(__('Filter by %s', 'otomaties-jobs'), strtolower($singular_name)),
        );
    }
    public function addJobFields()
    {
        $job = new FieldsBuilder('job');
        $job
            ->addTab('address', [
                'label' => __('Address', 'otomaties-jobs')
            ])
            ->addText('address_street', [
                'label' => __('Street', 'otomaties-jobs')
            ])
            ->addText('address_street_number', [
                'label' => __('Number', 'otomaties-jobs')
            ])
            ->addNumber('address_postcode', [
                'label' => __('Postcode', 'otomaties-jobs')
            ])
            ->addText('address_city', [
                'label' => __('City', 'otomaties-jobs')
            ])
            ->addTab('date', [
                'label' => __('Date', 'otomaties-jobs')
            ])
            ->addDatePicker('publication_date', [
                'label' => __('Publication date', 'otomaties-jobs'),
                'default_value' => date('Ymd'),
                'display_format' => 'd-m-Y',
                'return_format' => 'Ymd',
            ])
            ->addDatePicker('application_deadline', [
                'label' => __('Application deadline', 'otomaties-jobs'),
                'default_value' => date('Ymd', strtotime('+1 year')),
                'display_format' => 'd-m-Y',
                'return_format' => 'Ymd',
            ])
            ->addTab('employer', [
                'label' => __('Employer', 'otomaties-jobs')
            ])
            ->addText('company_name', [
                'label' => __('Name', 'otomaties-jobs'),
            ])
            ->addWysiwyg('company_description', [
                'label' => __('Description', 'otomaties-jobs'),
            ])
            ->addText('company_contact_name', [
                'label' => __('Contact name', 'otomaties-jobs'),
            ])
            ->addUrl('company_website', [
                'label' => __('Website', 'otomaties-jobs')
            ])
            ->addEmail('company_email', [
                'label' => __('E-mailaddress', 'otomaties-jobs')
            ])
            ->addText('company_phone', [
                'label' => __('Phone', 'otomaties-jobs'),
            ])
            ->addText('company_address_street', [
                'label' => __('Street', 'otomaties-jobs')
            ])
            ->addText('company_address_street_number', [
                'label' => __('Number', 'otomaties-jobs')
            ])
            ->addNumber('company_address_postcode', [
                'label' => __('Postcode', 'otomaties-jobs')
            ])
            ->addText('company_address_city', [
                'label' => __('City', 'otomaties-jobs')
            ])
            ->addTab('application', [
                'label' => __('Application', 'otomaties-jobs')
            ])
            ->addText('application_form_shortcode', [
                'label' => __('Application form shortcode', 'otomaties-jobs')
            ])
            ->setLocation('post_type', '==', 'job');
        acf_add_local_field_group($job->build());
    }
}
