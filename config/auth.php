<?php

return [
//Notes:
// This file configures the authentication settings for your application.

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    | // el guard heya elly by3rf mnha laravel ana user aw admin wla ana meen belzabt y3nii
      // el guard 3bara 3an key fe array
    */

    'defaults' => [
        'guard' => 'web', // el default guard
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [ // The default guard //el web da y2sod beh el user
            'driver' => 'session',  //This is 'session', meaning Laravel will use session storage to manage authentication state.
            'provider' => 'users',
        ],

    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
    'cutomer' => [
        'driver' => 'session',
        'provider' => 'cutomers',
    ],
    'seller' => [
        'driver' => 'session',
        'provider' => 'sellers',
    ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    //Notes: //Driver: This specifies the method Laravel should use to retrieve users.
            //Eloquent: This means Laravel will use its Eloquent ORM (Object-Relational Mapping) to interact with the database. Eloquent makes it easy to work with database records using a simple and expressive syntax.


    'providers' => [  //This section defines how users are retrieved from your database.
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'cutomers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Cutomer::class,
        ],

        'sellers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Seller::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60, // Tokens expire after 60 minutes
            'throttle' => 60, // User must wait 60 seconds before generating another token
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'admins_password_reset_tokens',
            'expire' => 60, // Tokens expire after 60 minutes
            'throttle' => 60, // User must wait 60 seconds before generating another token
        ],
        'cutomers' => [
            'provider' => 'cutomers',
            'table' => 'cutomers_password_reset_tokens',
            'expire' => 60, // Tokens expire after 60 minutes
            'throttle' => 60, // User must wait 60 seconds before generating another token
        ],

        'sellers' => [
            'provider' => 'sellers',
            'table' => 'sellers_password_reset_tokens',
            'expire' => 60, // Tokens expire after 60 minutes
            'throttle' => 60, // User must wait 60 seconds before generating another token
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
