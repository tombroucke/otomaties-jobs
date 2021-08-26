<?php

namespace Otomaties\Jobs;

class CustomPostTypes
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $otomaties_jobs    The ID of this plugin.
     */
    private $otomaties_jobs;

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
     * @param      string    $otomaties_jobs       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($otomaties_jobs, $version)
    {

        $this->otomaties_jobs = $otomaties_jobs;
        $this->version = $version;
    }
    
    public function registerJob()
    {
        register_extended_post_type('job', [
    
            # Add the post type to the site's main RSS feed:
            'show_in_feed' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'public' => true,
            # Add the post type to the 'Recently Published' section of the dashboard:
            'dashboard_activity' => true,

            'supports' => ['title', 'editor', 'author', 'excerpt'],

            'show_in_rest' => true,
    
        ], [
    
            # Override the base names used for labels:
            'singular' => __('Job', 'otomaties-jobs'),
            'plural'   => __('Jobs', 'otomaties-jobs'),
            'slug'     => 'jobs',
    
        ]);
    
        register_extended_taxonomy('job_category', 'job', [
            'show_in_rest' => true,
        ], [
            'singular' => __('Category', 'otomaties-jobs'),
            'plural'   => __('Categories', 'otomaties-jobs'),
            'slug'     => 'job_category'
        ]);
    }
}
