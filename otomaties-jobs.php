<?php

/**
 * Plugin Name:       Jobs module
 * Description:       Display job offers and allow visitors to apply
 * Version:           1.0.0
 * Author:            Tom Broucke
 * Author URI:        https://tombroucke.be/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       otomaties-jobs
 * Domain Path:       /languages
 */

namespace Otomaties\Jobs;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once('vendor/autoload.php');
}

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('OTOMATIES_JOBS_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/activator.php
 */
function activate()
{
    Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/deactivator.php
 */
function deactivate()
{
    Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'Otomaties\\Jobs\\activate');
register_deactivation_hook(__FILE__, 'Otomaties\\Jobs\\deactivate');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run()
{
    $prerequisites = true;

    if (!class_exists('Otomaties\\Jobs\\Plugin')) {
        add_action('admin_notices', function(){
            ?>
            <div class="notice notice-error is-dismissible">
                <p><?php _e('The jobs module is active but ineffective due to the missing composer dependencies. Did you run <code>composer install</code>?', 'otomaties-jobs') ?></p>
            </div>
            <?php
        });
        $prerequisites = false;
    }
    if (!class_exists('ACF')) {
        add_action('admin_notices', function(){
            ?>
            <div class="notice notice-error is-dismissible">
                <p><?php _e('The jobs module is active but ineffective due to the missing plugin \'Advanced Custom Fields Pro\'', 'otomaties-jobs') ?></p>
            </div>
            <?php
        });
        $prerequisites = false;
    }

    if ($prerequisites) {
        $plugin = new Plugin();
        $plugin->run();
    }
        
}
run();
