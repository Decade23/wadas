<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailSesTrait.php
 * @LastModified 09/09/2020, 01:24
 */

namespace App\Traits\Email;


use App\Jobs\SendEmailSESBlast;
use App\Models\Apl\AplEmail;
use App\Traits\helper;
use Aws\Exception\AwsException;
use Aws\Ses\SesClient;

trait EmailSesTrait
{

    use helper;

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

    public function send_email_ses($request)
    {
        $params = $this->params_email_ses($request);
        #send to recipient
        if ( isset( $request->recipient ) )
        {
            $params['Destination']['ToAddresses'] = json_decode($request->recipient);

            if (isset($field->cc)) {
                // convert to array
                $params['Destination']['CcAddresses'] = json_encode($request->cc);
            }

            if (isset($field->bcc)) {
                // convert to array
                $params['Destination']['BccAddresses'] = json_encode($request->bcc);
            }

            $this->doSendEmailSES( $params, $request );
        }

        #send to group/blast
        if ( isset( $request->group ) )
        {
            $group = json_decode($request->group);
            $userBlast = $this->getUserByRoleChunk($group);
            $user_chunks = $userBlast->chunk(500);

            #loop user chunk
            foreach ( $user_chunks as $users )
            {
                #send Email Via Jobs
                SendEmailSESBlast::dispatch('apl_email_blast', $params, $request, $users)->onQueue('email');
            }
        }
    }

    private function params_email_ses($field)
    {
        $charset = 'UTF-8';
        $params = array(
            'Source'    =>  "Expert Club Indonesia BM <$field->from>" , //$field->from,
            'ReplyToAddresses' => array($field->from),
            'Message'   => array(
                'Body' => array(
                    'Html' => array(
                        'Charset'   => $charset,
                        'Data'      => $field->body
                    ),
                    'Text' => array(
                        'Charset'   => $charset,
                        'Data'      => strip_tags($field->body)
                    ),
                ),
                'Subject'   => array(
                    'Charset'   => $charset,
                    'Data'      => $field->title
                ),
            ),
        );

        return $params;

        // -------------
        $params = array(
            'from' => $field->from,
            //'to'        => $field->recipient,
            'subject' => $field->title,
            'html' => $field->body,
            //'attachment'=> new CURLFILE('/Users/macos/Desktop/Invoice_497834793.pdf'),
            //'attachment'=> new CURLFILE('/Users/macos/Desktop/Invoice_509071625.pdf')
        );


        if (isset($field->attachment)) {
            #if attachment more than 1
            #max 10 MB
            $attachment = json_decode($field->attachment); // string to array
            if (is_array($attachment)) {
                $no = 1;
                foreach ($attachment as $file) {
                    $path = config('filesystems.disks.s3.url') . 'public/' . $this->uploadPath . '/' . $this->productFolder . '/' . $file;
                    $params['attachment[' . $no++ . ']'] = new \CURLFile($path);
                    //$params['attachment['.$no++.']'] = base64_encode( $path );
//                    $params['attachment'][] = [
//                        'filePath'  => $path,
//                        'filename'  => $file
//                    ];
                }
            }
        }
        #dd($params);
        return $params;
    }

    private function doSendEmailSES( $params , $request )
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

        // Specify a configuration set. If you do not want to use a configuration
        // set, comment the following variable, and the
        // 'ConfigurationSetName' => $configuration_set argument below.
        # $configuration_set = 'ConfigSet';
        //dd($params);
        try {
            $result = $sesClient->sendEmail($params);
            //$messageId = $result['MessageId'];
            $messageId = $result['@metadata']['statusCode'];

            #when theren't error update into AplEmail
            #will return 200 if managed.
            if ( $messageId === 200 ) {
                # update status mail
                $updateEmail = AplEmail::find($request->id);
                $dataUpdate = [
                    'status' => $result['MessageId'],
                    'id_mailgun' => $messageId,
                ];
                $updateEmail->update($dataUpdate);
            }

            return $result;
        }
        catch ( AwsException $e ) {
            return $e->getMessage() . "The email was not sent. Error message: ". $e->getAwsErrorMessage();
        }
    }

    public function convertRecipientToString($request)
    {
        if (isset($request)) {
            $recipient_json = json_decode($request);
            $result = array();

            foreach ($recipient_json as $to) {
                //return $to->value;
                $result[] = $to->value;
            }

            return json_encode($result);
        }
    }

    public function getAttachmentFile($request)
    {
        if (is_array($request)) {
            $result = array();

            foreach ($request as $doc) {
                $result[] = $this->mediaServicesContract->getMediaByFileName($doc);
            }

            return $result;
        }
    }
}
