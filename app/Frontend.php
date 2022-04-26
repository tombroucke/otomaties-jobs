<?php

namespace Otomaties\Jobs;

use DateTime;
use Otomaties\Jobs\Models\Job;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @subpackage LevlJobs/public
 */

class Frontend
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
     * @param      string    $pluginName       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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
        wp_enqueue_style($this->pluginName, Assets::find('css/main.css'), array(), null);
        if (publishJobPage()) {
            wp_enqueue_style($this->pluginName . '-publish_form', Assets::find('js/publish_form.css'), array(), null);
        }
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->pluginName, Assets::find('js/main.js'), array( 'jquery' ), null);
        if (publishJobPage()) {
            wp_enqueue_script($this->pluginName . '-publish_form', Assets::find('js/publish_form.js'), array( 'jquery' ), null);
        }
    }

    public function publishJobForm(string $content)
    {
        if (is_singular() && publishJobPage() && get_the_ID() == publishJobPage()) {
            if (!empty($requiredFieldErrors)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
            }

            $jobTypes = get_terms([
                'taxonomy' => 'job_employment_type',
                'hide_empty' => false,
            ]);

            $jobType = filter_input(INPUT_POST, 'job_employment_type', FILTER_SANITIZE_NUMBER_INT);
            $jobTitle = filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING);
            $jobDescription = filter_input(INPUT_POST, 'job_description', FILTER_SANITIZE_STRING);
            $addressStreet = filter_input(INPUT_POST, 'address_street', FILTER_SANITIZE_STRING);
            $addressStreetNumber = filter_input(INPUT_POST, 'address_street_number', FILTER_SANITIZE_STRING);
            $addressPostcode = filter_input(INPUT_POST, 'address_postcode', FILTER_SANITIZE_NUMBER_INT);
            $addressCity = filter_input(INPUT_POST, 'address_city', FILTER_SANITIZE_STRING);
            $publicationDate = filter_input(INPUT_POST, 'publication_date', FILTER_SANITIZE_STRING);
            $applicationDeadline = filter_input(INPUT_POST, 'application_deadline', FILTER_SANITIZE_STRING);
            $companyName = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING);
            $companyDescription = filter_input(INPUT_POST, 'company_description', FILTER_SANITIZE_STRING);
            $companyContactName = filter_input(INPUT_POST, 'company_contact_name', FILTER_SANITIZE_STRING);
            $companyWebsite = filter_input(INPUT_POST, 'company_website', FILTER_SANITIZE_STRING);
            $companyEmail = filter_input(INPUT_POST, 'company_email', FILTER_SANITIZE_EMAIL);
            $companyPhone = filter_input(INPUT_POST, 'company_phone', FILTER_SANITIZE_STRING);
            $companyAddressStreet = filter_input(INPUT_POST, 'company_address_street', FILTER_SANITIZE_STRING);
            $companyAddressStreetNumber = filter_input(INPUT_POST, 'company_address_street_number', FILTER_SANITIZE_STRING);
            $companyAddressPostcode = filter_input(INPUT_POST, 'company_address_postcode', FILTER_SANITIZE_NUMBER_INT);
            $companyAddressCity = filter_input(INPUT_POST, 'company_address_city', FILTER_SANITIZE_STRING);
            $jobStatus = filter_input(INPUT_GET, 'job_status', FILTER_SANITIZE_STRING);
            $successMessage = $jobStatus && $jobStatus == 'pending' ? __('Job has been submitted for moderation.', 'otomaties-jobs') : '';

            $errors = [];

            if (isset($_SESSION['otomaties_jobs_jobs_required_field_errors']) && !empty($_SESSION['otomaties_jobs_jobs_required_field_errors'])) {
                $errors = array_merge($errors, $_SESSION['otomaties_jobs_jobs_required_field_errors']);
                unset($_SESSION['otomaties_jobs_jobs_required_field_errors']);
            }

            if (isset($_SESSION['otomaties_jobs_jobs_suspected_bot'])) {
                $errors = array_merge($errors, [__('Suspected bot activity', 'otomaties-jobs')]);
                unset($_SESSION['otomaties_jobs_jobs_suspected_bot']);
            }

            $template = new Template('publish-form', [
                'jobTypes' => get_terms([
                    'taxonomy' => 'job_employment_type',
                    'hide_empty' => false,
                ]),
                'jobType' => filter_input(INPUT_POST, 'job_employment_type', FILTER_SANITIZE_NUMBER_INT),
                'jobTitle' => filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING),
                'jobDescription' => filter_input(INPUT_POST, 'job_description', FILTER_SANITIZE_STRING),
                'addressStreet' => filter_input(INPUT_POST, 'address_street', FILTER_SANITIZE_STRING),
                'addressStreetNumber' => filter_input(INPUT_POST, 'address_street_number', FILTER_SANITIZE_STRING),
                'addressPostcode' => filter_input(INPUT_POST, 'address_postcode', FILTER_SANITIZE_NUMBER_INT),
                'addressCity' => filter_input(INPUT_POST, 'address_city', FILTER_SANITIZE_STRING),
                'publicationDate' => filter_input(INPUT_POST, 'publication_date', FILTER_SANITIZE_STRING),
                'applicationDeadline' => filter_input(INPUT_POST, 'application_deadline', FILTER_SANITIZE_STRING),
                'companyName' => filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING),
                'companyDescription' => filter_input(INPUT_POST, 'company_description', FILTER_SANITIZE_STRING),
                'companyContactName' => filter_input(INPUT_POST, 'company_contact_name', FILTER_SANITIZE_STRING),
                'companyWebsite' => filter_input(INPUT_POST, 'company_website', FILTER_SANITIZE_STRING),
                'companyEmail' => filter_input(INPUT_POST, 'company_email', FILTER_SANITIZE_EMAIL),
                'companyPhone' => filter_input(INPUT_POST, 'company_phone', FILTER_SANITIZE_STRING),
                'companyAddressStreet' => filter_input(INPUT_POST, 'company_address_street', FILTER_SANITIZE_STRING),
                'companyAddressStreetNumber' => filter_input(INPUT_POST, 'company_address_street_number', FILTER_SANITIZE_STRING),
                'companyAddressPostcode' => filter_input(INPUT_POST, 'company_address_postcode', FILTER_SANITIZE_NUMBER_INT),
                'companyAddressCity' => filter_input(INPUT_POST, 'company_address_city', FILTER_SANITIZE_STRING),
                'successMessage' => $jobStatus && $jobStatus == 'pending' ? __('Job has been submitted for moderation.', 'otomaties-jobs') : '',
                'errors' => $errors,

            ]);
            return apply_filters('otomaties_jobs_jobs_publish_form', $template->get());
        }
        return $content;
    }

    public function publishJob()
    {

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        if (publishJobPage() && $action && $action == 'otomaties_jobs_jobs_publish_job') {
            if (!empty($requiredFieldErrors)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
            }
            
            $jobType = filter_input(INPUT_POST, 'job_employment_type', FILTER_SANITIZE_STRING);
            $jobTitle = filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING);
            $jobDescription = filter_input(INPUT_POST, 'job_description', FILTER_SANITIZE_STRING);
            $addressStreet = filter_input(INPUT_POST, 'address_street', FILTER_SANITIZE_STRING);
            $addressStreetNumber = filter_input(INPUT_POST, 'address_street_number', FILTER_SANITIZE_STRING);
            $addressPostcode = filter_input(INPUT_POST, 'address_postcode', FILTER_SANITIZE_NUMBER_INT);
            $addressCity = filter_input(INPUT_POST, 'address_city', FILTER_SANITIZE_STRING);
            $publicationDate = filter_input(INPUT_POST, 'publication_date', FILTER_SANITIZE_STRING);
            $applicationDeadline = filter_input(INPUT_POST, 'application_deadline', FILTER_SANITIZE_STRING);
            $companyName = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING);
            $companyDescription = filter_input(INPUT_POST, 'company_description', FILTER_SANITIZE_STRING);
            $companyContactName = filter_input(INPUT_POST, 'company_contact_name', FILTER_SANITIZE_STRING);
            $companyWebsite = filter_input(INPUT_POST, 'company_website', FILTER_SANITIZE_STRING);
            $companyEmail = filter_input(INPUT_POST, 'company_email', FILTER_SANITIZE_EMAIL);
            $companyPhone = filter_input(INPUT_POST, 'company_phone', FILTER_SANITIZE_STRING);
            $companyAddressStreet = filter_input(INPUT_POST, 'company_address_street', FILTER_SANITIZE_STRING);
            $companyAddressStreetNumber = filter_input(INPUT_POST, 'company_address_street_number', FILTER_SANITIZE_STRING);
            $companyAddressPostcode = filter_input(INPUT_POST, 'company_address_postcode', FILTER_SANITIZE_NUMBER_INT);
            $companyAddressCity = filter_input(INPUT_POST, 'company_address_city', FILTER_SANITIZE_STRING);
            $honeyPot = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);

            $referer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING);
    
            $requiredFields = [
                'jobTitle' => __('Job title', 'otomaties-jobs'),
                'jobDescription' => __('Job description', 'otomaties-jobs'),
                'publicationDate' => __('Publication date', 'otomaties-jobs'),
                'applicationDeadline' => __('Application deadline', 'otomaties-jobs'),
                'companyName' => __('Company name', 'otomaties-jobs'),
                'companyDescription' => __('Company description', 'otomaties-jobs'),
                'companyContactName' => __('Company contact name', 'otomaties-jobs'),
                'companyPhone' => __('Company phone', 'otomaties-jobs'),
            ];
    
            $requiredFieldErrors = [];
    
            foreach ($requiredFields as $requiredFieldKey => $requiredFieldLabel) {
                if (!${$requiredFieldKey}) {
                    $requiredFieldErrors[] = sprintf(__('%s is a required field', 'otomaties-jobs'), $requiredFieldLabel);
                }
            }

            if (!empty($requiredFieldErrors)) {
                $_SESSION['otomaties_jobs_jobs_required_field_errors'] = $requiredFieldErrors;
                return;
            }

            if ($honeyPot) {
                $_SESSION['otomaties_jobs_jobs_suspected_bot'] = true;
                return;
            }

            $publicationDateDateTime = DateTime::createFromFormat('d-m-Y', $publicationDate);
            $applicationDeadlineDateTime = DateTime::createFromFormat('d-m-Y', $applicationDeadline);

            $args = [
                'post_type' => 'job',
                'post_status' => 'pending',
                'post_title' => $jobTitle,
                'post_content' => $jobDescription,
                'meta_input' => [
                    'address_street' => $addressStreet,
                    'address_street_number' => $addressStreetNumber,
                    'address_postcode' => $addressPostcode,
                    'address_city' => $addressCity,
                    'publication_date' => $publicationDateDateTime->format('Ymd'),
                    'application_deadline' => $applicationDeadlineDateTime->format('Ymd'),
                    'company_name' => $companyName,
                    'company_description' => $companyDescription,
                    'company_contact_name' => $companyContactName,
                    'company_website' => $companyWebsite,
                    'company_email' => $companyEmail,
                    'company_phone' => $companyPhone,
                    'company_address_street' => $companyAddressStreet,
                    'company_address_street_number' => $companyAddressStreetNumber,
                    'company_address_postcode' => $companyAddressPostcode,
                    'company_address_city' => $companyAddressCity,
                ]
            ];
            $newJob = Job::insert($args);

            if ($newJob instanceof Job) {
                wp_set_object_terms($newJob->getId(), $jobType, 'job_employment_type');
                $redirect = add_query_arg('job_status', 'pending', $referer);
                do_action('otomaties_jobs_publish', $newJob);

                if ($notificationTo = get_field('new_job_notification_email', 'option')) {
                    $mailer = new Mailer();
                    $subject = __('New job, please moderate', 'otomaties-jobs');
                    $message = $mailer->paragraph(__('Hi,', 'levl'));
                    $message .= $mailer->paragraph(__('There is a new job up for moderation.', 'levl'));
                    $message .= $mailer->paragraph(sprintf(__('Visit <a href="%s">%1$s</a> to approve.', 'levl'), get_edit_post_link($newJob->getId())));
                    $message .= $mailer->paragraph(__('Kind regards,', 'levl') . '<br />' . get_bloginfo('site_name'));
                    $mailer->sendMail($notificationTo, $subject, $message);
                }
            } else {
                $redirect = add_query_arg('job_status', 'failed', $referer);
            }
            wp_safe_redirect($redirect);
            die();
        }
    }

    public function jobContent($content)
    {
        if (is_singular('job')) {
            $job = new Job(get_the_ID());
            $template = new Template('job', [
                'employmentTypes' => $job->employmentTypes(),
                'publicationDate' => $job->publicationDate(),
                'applicationDeadline' => $job->applicationDeadline(),
                'description' => $content,
                'location' => $job->location(),
                'company' => $job->company(),
                'applicationFormShortcode' => $job->applicationFormShortcode(),
            ]);
            return $template->get();
        }
        return $content;
    }

    public function hideExpiredJobs($query)
    {
        if (is_admin()) {
            return;
        }
        if ($query->get('post_type') == 'job' && !$query->get('custom_query')) {
            $meta_query[] = array(
                'relation' => 'OR',
                array(
                    'key' => 'application_deadline',
                    'value' => date('Ymd'),
                    'compare' => '>='
                ),
                array(
                    'key' => 'application_deadline',
                    'compare'=>'NOT EXISTS',
                )
            );
            $query->set('meta_query', $meta_query);
        }
    }
}
