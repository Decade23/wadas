<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailSesTrait.php
 * @LastModified 09/09/2020, 01:24
 */

namespace App\Traits\Email;


use Aws\Exception\AwsException;
use Aws\Ses\SesClient;

trait EmailSesTrait
{

    /**
     * EmailSesTrait constructor.
     */
    public function __construct()
    {
    }

    public static function sendEmailSES()
    {

        //return "key: ". config('mail.ses.key'). "/n secret: ". config('mail.ses.secret');
        $sesClient = new SesClient([
            //'profile' => 'default',
            'version' => '2010-12-01',
            'region'  => config('mail.ses.region'),
            'credentials' => [
                'key' => config('mail.ses.key'),
                'secret' => config('mail.ses.secret'),
            ]
        ]);

        $sender = 'laravel@businessconsultingcorp.com';

        $receipent = [
            'dedif15@gmail.com'
        ];

        // Specify a configuration set. If you do not want to use a configuration
        // set, comment the following variable, and the
        // 'ConfigurationSetName' => $configuration_set argument below.
        $configuration_set = 'ConfigSet';

        $subject = 'Amazon SES test (AWS SDK for PHP)';
        $plaintext_body = 'This email was sent with Amazon SES using the AWS SDK for PHP.' ;
        $html_body =  '<h1>AWS Amazon Simple Email Service Test Email</h1>'.
            '<p>This email was sent with <a href="https://aws.amazon.com/ses/">'.
            'Amazon SES</a> using the <a href="https://aws.amazon.com/sdk-for-php/">'.
            'AWS SDK for PHP</a>.</p>';
        $char_set = 'UTF-8';

        try {
            $result = $sesClient->sendEmail([
                'Destination' => [
                    'ToAddresses' => $receipent
                ],
                'ReplyToAddresses' => [
                    $sender
                ],
                'Source' => $sender,
                'Message' => [
                    'Body' => [
                        'Html' => [
                            'Charset' => $char_set,
                            'Data' => $html_body,
                        ],
                        'Text' => [
                            'Charset' => $char_set,
                            'Data' => $plaintext_body,
                        ],
                    ],
                    'Subject' => [
                        'Charset' => $char_set,
                        'Data' => $subject,
                    ],
                ],
                // If you aren't using a configuration set, comment or delete the
                // following line
                //'ConfigurationSetName' =>$configuration_set,
            ]);
            //$messageId = $result['MessageId'];
            $messageId = $result['@metadata']['statusCode'];
            return "Email sent! Message ID: ". $messageId;
        }
        catch ( AwsException $e ) {
            return $e->getMessage() . "The email was not sent. Error message: ". $e->getAwsErrorMessage();
        }
    }
}
