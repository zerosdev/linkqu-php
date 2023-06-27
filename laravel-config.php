<?php

return [

    /**
     * API Integration Mode
     * Available: "development", "production"
     */
    'mode'          => env('LINKQU_MODE', 'development'),

    /**
     * API Client ID
     */
    'client_id'     => env('LINKQU_CLIENT_ID', 'client id'),

    /**
     * API Client Secret
     */
    'client_secret' => env('LINKQU_CLIENT_SECRET', 'client secret'),

    /**
     * API Username
     */
    'username'      => env('LINKQU_USERNAME', 'username'),

    /**
     * API PIN
     */
    'pin'           => env('LINKQU_PIN', 'pin'),

    /**
     * API Server Key
     */
    'server_key'    => env('LINKQU_SERVER_KEY', 'server key'),

];
