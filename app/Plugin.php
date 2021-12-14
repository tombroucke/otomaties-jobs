<?php

namespace Otomaties\Jobs;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 */

class Plugin
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The current version of the plugin.
     *
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * The name of the plugin
     *
     * @var [type]
     */
    protected $pluginName;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     */
    public function __construct($pluginData)
    {
        $this->version = $pluginData['Version'];
        $this->pluginName = $pluginData['pluginName'];
        $this->loader = new Loader();

        $this->setLocale();
        $this->addPostTypes();
        $this->defineAdminHooks();
        $this->defineFrontendHooks();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     */
    private function setLocale()
    {

        $plugin_i18n = new I18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'loadTextdomain');
    }

    private function addPostTypes()
    {
        $customPostTypes = new CustomPostTypes();
        $this->loader->add_action('init', $customPostTypes, 'addJobs');
        $this->loader->add_action('acf/init', $customPostTypes, 'addJobFields');
    }

    /**
     * Register all of the hooks related to the admin-facing functionality
     * of the plugin.
     *
     */
    private function defineAdminHooks()
    {

        $admin = new Admin($this->getPluginName(), $this->getVersion());
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueueStyles');
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueueScripts');
        $this->loader->add_action('acf/init', $admin, 'optionsPage');
        $this->loader->add_action('acf/init', $admin, 'addOptionsPageFields');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     */
    private function defineFrontendHooks()
    {
        $frontend = new Frontend($this->getPluginName(), $this->getVersion());
        $this->loader->add_action('wp_enqueue_scripts', $frontend, 'enqueueStyles');
        $this->loader->add_action('wp_enqueue_scripts', $frontend, 'enqueueScripts');

        $this->loader->add_filter('the_content', $frontend, 'publishJobForm');
        $this->loader->add_action('template_redirect', $frontend, 'publishJob');
        $this->loader->add_filter('the_content', $frontend, 'jobContent');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Loader    Orchestrates the hooks of the plugin.
     */
    public function getLoader()
    {
        return $this->loader;
    }

    public function getPluginName()
    {
        return $this->pluginName;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }
}
