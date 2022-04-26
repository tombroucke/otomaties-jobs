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

    public function __construct($post)
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

    public function content()
    {
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

    public function applicationFormShortcode()
    {
        $applicationFormShortcode = false;
        $applicationFormShortcode = get_field('application_form_shortcode', $this->getId());
        if (!$applicationFormShortcode) {
            $applicationFormShortcode = get_field('application_form_shortcode', 'option');
        }
        return $applicationFormShortcode;
    }

    public function company()
    {
        $company = [
            'name' => $this->get('company_name'),
            'description' => $this->get('company_description'),
            'contactName' => $this->get('company_contact_name'),
            'website' => $this->get('company_website'),
            'email' => $this->get('company_email'),
            'phone' => $this->get('company_phone'),
            'addressStreet' => $this->get('company_address_street'),
            'addressNumber' => $this->get('company_address_street_number'),
            'addressPostcode' => $this->get('company_address_postcode'),
            'addressCity' => $this->get('company_address_city'),
        ];
        return (object)$company;
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
        $newPost = wp_insert_post($args);

        if (is_int($newPost)) {
            return new $class($newPost);
        }

        return $newPost;
    }
}
