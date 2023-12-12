# Otomaties Jobs

Add job functionality to your wordpress website

## Prerequisites
- PHP 8.x
- ACF PRO

## Installation
`composer require tombroucke/otomaties-jobs`

The plugin could be installed by cloning this repo and performing calling `composer install` from the root directory, but there will be no updates.

## Layout

### Templates
This plugin doesn't provide any templates. You should add `archive-events.php` and `content-event.php` yourself.

### Bootstrap
The registration form uses default bootstrap classes. Following classes should be whitelisted from purgecss
- table
- alert
- alert-success
- alert-danger
- col-12
- row
- mb-3
- mb-0
- col-sm-6
- col-sm-4
- col-sm-8
- form-label
- form-control
- text-danger

## Customization

### Allow classes in job content
```php
add_filter('otomaties_jobs_job_content_allowed_html', function ($allowedHtml) {
    foreach ($allowedHtml as $key => $value) {
        $allowedHtml[$key]['class'] = [];
    }
    return $allowedHtml;
});
```

### Allow all html tags in job content
```php
add_filter('otomaties_jobs_job_content_allowed_html', function (){
    global $allowedposttags;
    return $allowedposttags;
});
```

### Add svg support to job content
```php
add_filter('otomaties_jobs_job_content_allowed_html', function ($allowedHtml) {
    $allowedHtml['svg'] = ['class' => [], 'xmlns' => [], 'viewbox' => [], 'fill' => []];
    $allowedHtml['path'] = ['d' => [], 'fill' => []];
	$allowedHtml['circle'] = ['cx' => [], 'cy' => [], 'r' => []];
    return $allowedHtml;
});
```
