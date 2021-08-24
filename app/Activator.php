<?php

namespace Otomaties\Jobs;

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Otomaties_Jobs
 * @subpackage Otomaties_Jobs/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Otomaties_Jobs
 * @subpackage Otomaties_Jobs/includes
 * @author     Your Name <email@example.com>
 */
class Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        $plugin = new Plugin();
        $plugin->registerPostTypes();
        flush_rewrite_rules();
    }
}
