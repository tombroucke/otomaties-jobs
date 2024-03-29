<?php

namespace Otomaties\Jobs\Models;

use DateTime;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 */

class Job
{
    private $id;

    public function __construct(\WP_Post|int $post)
    {
        if (is_int($post)) {
            $this->id = $post;
        } else {
            $this->id = $post->ID;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function employmentTypes()
    {
        $terms = wp_get_post_terms($this->getId(), 'job_employment_type');
        return array_map(function ($term) {
            return $term->name;
        }, $terms);
    }

    public function get(string $key, bool $single = true)
    {
        return get_post_meta($this->getId(), $key, $single);
    }

    public function content() {
        return get_post_field('post_content', $this->getId());
    }

    public function addressStreet()
    {
        return $this->get('address_street');
    }

    public function addressStreetNumber()
    {
        return $this->get('address_street_number');
    }

    public function addressPostcode()
    {
        return $this->get('address_postcode');
    }

    public function addressCity()
    {
        return $this->get('address_city');
    }

    public function location() 
    {
        $address = '';
        if ($this->addressStreet()) {
            $address .= $this->addressStreet();

            if ($this->addressStreetNumber()) {
                $address .= ' ' . $this->addressStreetNumber();
            }
        }
        if ('' != $address && ($this->addressPostcode() || $this->addressCity())) {
            $address .= '<br />';
        }
        if ($this->addressPostcode()) {
            $address .= $this->addressPostcode();

            if ($this->addressCity()) {
                $address .= ' ';
            }
        }

        if ($this->addressCity()) {
            $address .= $this->addressCity();
        }
        return '' != $address ? $address : null;
    }

    public function publicationDate() : ?DateTime
    {
        $publicationDate = $this->get('publication_date');
        if ($publicationDate) {
            $dateTime = DateTime::createFromFormat('Ymd', $publicationDate);
            return $dateTime;
        }
        return null;
    }

    public function applicationDeadline() : ?DateTime
    {
        $applicationDeadline = $this->get('application_deadline');
        if ($applicationDeadline) {
            $dateTime = DateTime::createFromFormat('Ymd', $applicationDeadline);
            return $dateTime;
        }
        return null;
    }

    public function applicationFormShortcode() {
        $applicationFormShortcode = false;
        $applicationFormShortcode = get_field('application_form_shortcode', $this->getId());
        if (!$applicationFormShortcode) {
            $applicationFormShortcode = get_field('application_form_shortcode', 'option');
        }
        return $applicationFormShortcode;
    }

    public function companyName()
    {
        return $this->get('company_name');
    }

    public function companyDescription()
    {
        return $this->get('company_description');
    }

    public function companyContactName()
    {
        return $this->get('company_contact_name');
    }

    public function companyWebsite()
    {
        return $this->get('company_website');
    }

    public function companyEmail()
    {
        return $this->get('company_email');
    }

    public function companyPhone()
    {
        return $this->get('company_phone');
    }

    public function companyAddressStreet()
    {
        return $this->get('company_address_street');
    }

    public function companyAddressNumber()
    {
        return $this->get('company_address_street_number');
    }

    public function companyAddressPostcode()
    {
        return $this->get('company_address_postcode');
    }

    public function companyAddressCity()
    {
        return $this->get('company_address_city');
    }

    public static function insert($args)
    {
        $class = get_called_class();
        $defaults = array(
            'post_type' => 'job',
            'post_status' => 'publish',
            'post_title' => '',
            'post_content' => '',
        );

        $args = wp_parse_args($args, $defaults);
        $newPost = wp_insert_post($args, true);

        if (is_wp_error($newPost)) {
            throw new \Exception($newPost->get_error_code());
        }

        return new $class($newPost);
    }
}
