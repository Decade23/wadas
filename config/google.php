<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename google.php
 * @LastModified 13/05/2020, 03:17
 */

return [
    'firebase' => [
        'api_key'               => env('GOOGLE_FIREBASE_API_KEY', 'API_KEY'),
        'auth_domain'           => env('GOOGLE_FIREBASE_AUTH_DOMAIN','AUTH_DOMAIN'),
        'database_url'          => env('GOOGLE_FIREBASE_DATABASE_URL','DATABASE_URL'),
        'project_id'            => env('GOOGLE_FIREBASE_PROJECT_ID', 'PROJECT_ID'),
        'storage_bucket'        => env('GOOGLE_FIREBASE_STORAGE_BUCKET','STORAGE_BUCKET'),
        'messaging_sender_id'   => env('GOOGLE_FIREBASE_MESSAGING_SENDER_ID','MESSAGING_SENDER_ID'),
        'app_id'                => env('GOOGLE_FIREBASE_APP_ID','APP_ID'),
        'measurement_id'        => env('GOOGLE_FIREBASE_MEASUREMENT_ID','MEASUREMENT_ID'),
        'server_key'            => env('GOOGLE_FIREBASE_SERVER_KEY','SERVER_KEY'),
        'web_push_sertificate'  => env('GOOGLE_FIREBASE_WEB_PUSH_SERTIFICATE','WEB_PUSH_SERTIFICATE'),
    ],
];
