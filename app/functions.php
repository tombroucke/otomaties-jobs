<?php
namespace Otomaties\Jobs;

if (!function_exists('publishJobPage')) {
    function publishJobPage() : ?int
    {
        $pageId = get_field('publish_jobs_page', 'option');
        return $pageId && $pageId != 0 ? $pageId : null;
    }
}

