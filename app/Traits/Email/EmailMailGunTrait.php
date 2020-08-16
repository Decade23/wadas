<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailMailGunTrait.php
 * @LastModified 04/08/2020, 00:08
 */

namespace App\Traits\Email;

use App\Models\Apl\AplEmail;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\helper;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

trait EmailMailGunTrait
{
    use helper;
    private $domain, $privateApiKey, $publicValidationKey, $httpWebhookSigningKey, $supportPin, $url;
    private $urlSendingEmail, $mediaServicesContract;
    /**
     * EmailMailGunTrait constructor.
     */
    public function __construct(MediaServicesContract $mediaServicesContract)
    {
        $this->mediaServicesContract    = $mediaServicesContract;
    }

    private function getAccessMailgun()
    {
        $rules = [
            'domain'                => config('mail.mailgun.domain'),
            'privateApiKey'         => config('mail.mailgun.private_api_key'),
            'publicValidationKey'   => config('mail.mailgun.public_validation_key'),
            'httpWebhookSigningKey' => config('mail.mailgun.http_webhook_signing_key'),
            'supportPin'            => config('mail.mailgun.support_pin'),
            'url'                   => config('mail.mailgun.url'),
        ];

        $rules['urlSendingEmail']   = $rules['url']. $rules['domain']. '/messages';
        $rules['apiKey']            = 'api:'. $rules['privateApiKey'];
        $rules['urlWithApi']        = config('mail.mailgun.url_with_api');

        return $rules;
    }

    public function send_email($field)
    {
        $params = $this->params_email($field);
        //dd( $params );
        #send to recipient
        if ( isset( $field->recipient ) )
        {
            # send mail
            $this->config_curl($params, $field);
        }

        #send to group/blast
        if ( isset( $field->group ) )
        {

            $group = json_decode( $field->group );
            $userBlast = $this->getUserByRole( $group );

            #loop user by role/group
            foreach ( $userBlast as $user ) {
                $params['to'] = $user->email;
                $this->config_curl($params, $field);
            }

        }

    }

    public function convertRecipientToString($request)
    {
        if ( isset( $request ) ) {
            $recipient_json = json_decode( $request );
            $result = array();

            foreach ( $recipient_json as $to) {
                //return $to->value;
                $result[] = $to->value;
            }

            return json_encode($result);
        }
    }

    public function getAttachmentFile($request)
    {
        if ( is_array($request) ) {
            $result = array();

            foreach ( $request as $doc ) {
                $result[] = $this->mediaServicesContract->getMediaByFileName($doc);
            }

            return $result;
        }
    }

    private function params_email($field)
    {
        $params = array(
            'from'      => $field->from,
            //'to'        => $field->recipient,
            'subject'   => $field->title,
            'html'      => $field->body,
            //'attachment'=> new CURLFILE('/Users/macos/Desktop/Invoice_497834793.pdf'),
            //'attachment'=> new CURLFILE('/Users/macos/Desktop/Invoice_509071625.pdf')
        );

        if ( isset( $field->recipient ) ) {
            // convert string to array then extract to string with delimiter ','
            $to = implode(',',json_decode( $field->recipient ) );

            $params['to'] = $to;
        }

        # send mail to group/blast
//        if ( isset( $field->group ) ) {
//            $params['to'] = $field->group;
//        }

        if ( isset( $field->cc ) ) {
            // convert string to array then extract to string with delimiter ','
            $cc = implode(',',json_decode( $field->cc ) );

            $params['cc'] = $cc;
        }

        if ( isset( $field->bcc ) ) {
            // convert string to array then extract to string with delimiter ','
            $bcc = implode(',',json_decode( $field->bcc ) );

            $params['bcc'] = $bcc;

        }

        if ( isset( $field->attachment ) ) {
            #if attachment more than 1
            #max 10 MB
            $attachment = json_decode( $field->attachment ); // string to array
            if ( is_array( $attachment ) )
            {
                $no = 1;
                foreach ($attachment as $file) {
                    $path   = config('filesystems.disks.s3.url'). 'public/'. $this->uploadPath .'/'. $this->productFolder . '/'. $file;
                    $params['attachment['.$no++.']'] = new \CURLFile( $path );
//                    $params['attachment'][] = [
//                        'filePath'  => $path,
//                        'filename'  => $file
//                    ];
                }
            }
        }

        return $params;
    }

    private function config_curl($params, $emailDB)
    {
        dd($params);
        $curl = curl_init();
        //dd( $this->getAccessMailgun() );
        curl_setopt_array($curl, array(
//            CURLOPT_URL => $this->getAccessMailgun()['urlWithApi'],
            CURLOPT_URL => $this->getAccessMailgun()['urlSendingEmail'],
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->getAccessMailgun()['apiKey'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: multipart/form-data",
//                //"Authorization: Basic YXBpOjJhOWRhNWM4YzQ1MzExZmU4YjMzNGJjMmZiMGVlMjExLWE4M2E4N2E5LWU2MmY5NGFh"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);
        #dd( $response );

        #when theren't error update into AplEmail
        if ( $result != null && $result->message == 'Queued. Thank you.' ) {
            # update status mail
            $updateEmail =  AplEmail::find($emailDB->id);
            $dataUpdate = [
                'status'        => $result->message,
                'id_mailgun'    => $result->id,
            ];
            $updateEmail->update($dataUpdate);
        }
        return $result;
    }

    private function config_curl_new($params)
    {
        $session = curl_init( $this->getAccessMailgun()['url'] );
        curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($session, CURLOPT_USERPWD, $this->getAccessMailgun()['apiKey'] );
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($session);
        curl_close($session);
        $results = json_decode($response, true);
        return $results;
    }
}
