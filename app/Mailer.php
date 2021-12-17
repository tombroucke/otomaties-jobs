<?php
namespace Otomaties\Jobs;

/**
 * Email
 */
class Mailer
{
    public function paragraph(string $text)
    {
        return '<p>' . $text . '</p>';
    }

    public function htmlEmail()
    {
        return 'text/html';
    }

    public function sendMail(string $to, string $subject, string $message, $headers = array())
    {

        add_filter('wp_mail_content_type', array( $this, 'htmlEmail' ));
        wp_mail($to, $subject, $message, $headers);
        remove_filter('wp_mail_content_type', array( $this, 'htmlEmail' ));
    }
}
