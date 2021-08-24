<?php

namespace Otomaties\Jobs\Frontend;

class Frontend
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
     * @param      string    $plugin       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin, $version)
    {

        $this->plugin = $plugin;
        $this->version = $version;
    }

    private function shortcode() {
        $shortcode = get_field('jobs_apply_shortcode');
        if (!$shortcode) {
            $shortcode = get_field('jobs_default_apply_shortcode', 'option');
        }
        return $shortcode;
    }

    public function applyForm($content)
    {
        $shortcode = $this->shortcode();
        if (is_singular('job') && $shortcode) {
            ob_start();
            include(__DIR__ . '/partials/apply-form.php');
            $content .= ob_get_clean();
        }
        return $content;
    }
}
