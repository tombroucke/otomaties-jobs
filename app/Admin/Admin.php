<?php

namespace Otomaties\Jobs\Admin;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin    The ID of this plugin.
     */
    private $plugin;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin, $version)
    {

        $this->plugin = $plugin;
        $this->version = $version;
    }
    
    public function jobFields()
    {
        $applyForm = new FieldsBuilder('job_apply_form');
        $applyForm
            ->addText('jobs_apply_shortcode', [
                'label' => __('Apply form shortcode', 'otomaties-jobs'),
				'instructions' => __('This setting will override the shortcode defined on the job options page', 'otomaties-jobs'),
            ])
            ->setLocation('post_type', '=', 'job');

        acf_add_local_field_group($applyForm->build());
    }

    public function optionsPage()
    {
        acf_add_options_page(array(
            'page_title'    => __('Job Settings', 'otomaties-jobs'),
            'menu_title'    => __('Job Settings', 'otomaties-jobs'),
            'menu_slug'     => 'job-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));

        $jobOptions = new FieldsBuilder('job_options');
        $jobOptions
            ->addText('jobs_default_apply_shortcode', [
                'label' => __('Default apply form shortcode', 'otomaties-jobs')
            ])
            ->setLocation('options_page', '=', 'job-settings');

        acf_add_local_field_group($jobOptions->build());
    }
}
