<?php

namespace Otomaties\Jobs;

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Otomaties_Jobs
 * @subpackage Otomaties_Jobs/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Otomaties_Jobs
 * @subpackage Otomaties_Jobs/includes
 * @author     Your Name <email@example.com>
 */
class Deactivator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
