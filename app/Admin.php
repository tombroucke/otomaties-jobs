<?php

namespace Otomaties\Jobs;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @subpackage LevlJobs/admin
 */

class Admin
{

    /**
     * The ID of this plugin.
     *
     * @var      string    $pluginName    The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param      string    $pluginName       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     */
    public function enqueueStyles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->pluginName, Assets::find('css/admin.css'), array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     */
    public function enqueueScripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->pluginName, Assets::find('js/admin.js'), array( 'jquery' ), $this->version, false);
    }

    public function optionsPage()
    {
        
        acf_add_options_sub_page(
            array(
                'page_title'    => __('Settings', 'otomaties-jobs'),
                'menu_title'    => __('Settings', 'otomaties-jobs'),
                'menu_slug'     => 'otomaties-jobs-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false,
                'parent_slug'   => 'edit.php?post_type=job'
            )
        );
    }

    public function addOptionsPageFields()
    {
        $optionsPage = new FieldsBuilder('Settings');
        $optionsPage
            ->addTab('general', [
                'label' => __('General', 'otomaties-jobs'),
            ])
                ->addPostObject('publish_jobs_page', [
                    'label' => __('Page for publishing jobs', 'otomaties-jobs'),
                    'instructions' => __('Leave blank to disable job publishing for non-logged-in users.', 'otomaties-jobs'),
                    'post_type' => 'page',
                    'allow_null' => true,
                    'return_format' => 'id',
                ])
                ->addEmail('new_job_notification_email', [
                    'label' => __('E-mailaddress for new job notification', 'otomaties-jobs'),
                    'instructions' => __('Leave blank for no notification', 'otomaties-jobs'),
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'publish_jobs_page',
                                'operator'  =>  '!=empty',
                            ],
                        ]
                    ],
                ])
            ->addTab('application', [
                'label' => __('Application', 'otomaties-jobs'),
            ])
            ->addText('application_form_shortcode', [
                'label' => __('Application form shortcode', 'otomaties-jobs'),
            ])
            ->setLocation('options_page', '==', 'otomaties-jobs-settings');
        acf_add_local_field_group($optionsPage->build());
    }
}
