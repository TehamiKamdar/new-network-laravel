<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    /*
     * Your API path. By default, all routes starting with this path will be added to the docs.
     * If you need to change this behavior, you can add your custom routes resolver using `Scramble::routes()`.
     */
    'api_path' => 'api',

    /*
     * Your API domain. By default, app domain is used. This is also a part of the default API routes
     * matcher, so when implementing your own, make sure you use this config if needed.
     */
    'api_domain' => null,

    /*
     * Define the theme of the documentation.
     * Available options are `light` and `dark`.
     */
    'theme' => 'light',

    'info' => [
        /*
         * API version.
         */
        'version' => env('API_VERSION', '1'),

        /*
         * Description rendered on the home page of the API documentation (`/docs/api`).
         */
        'description' => '
<p><strong>ThousandsLink API Documentation</strong></p>

<p>
All authenticated endpoints are clearly marked with a 
<span style="background:#eef2ff;color:#3730a3;padding:2px 6px;border-radius:4px;font-size:12px;">
requires authentication
</span> 
badge in the documentation below.
</p>

<h1 id="authenticating-requests">Authenticating Requests</h1>

<p>
To authenticate requests, include a 
<strong><code>token</code></strong> header with the value 
<strong><code>your-token</code></strong>.
</p>

<p>
You can retrieve your API token by visiting the 
<strong>ThousandsLink Publisher Dashboard</strong>, navigating to 
<strong>Profile Setting</strong>, opening the 
<strong>Personal Information</strong> section, and copying your token.
</p>

<p>
<span style="color:#b91c1c;"><strong>Rate Limit:</strong></span> 
You may make up to <strong>10 requests</strong> within a 
<strong>one-minute</strong> time window.
</p>
',

    ],

    /*
     * Customize Stoplight Elements UI
     */
    'ui' => [
        /*
         * Hide the `Try It` feature. Enabled by default.
         */
        'hide_try_it' => false,

        /*
         * URL to an image that displays as a small square logo next to the title, above the table of contents.
         */
        'logo' => 'https://pub.thousandslink.com/img/logo.png',

        /*
         * Use to fetch the credential policy for the Try It feature. Options are: omit, include (default), and same-origin
         */
        'try_it_credentials_policy' => 'include',
    ],

    /*
     * The list of servers of the API. By default, when `null`, server URL will be created from
     * `scramble.api_path` and `scramble.api_domain` config variables. When providing an array, you
     * will need to specify the local server URL manually (if needed).
     *
     * Example of non-default config (final URLs are generated using Laravel `url` helper):
     *
     * ```php
     * 'servers' => [
     *     'Live' => 'api',
     *     'Prod' => 'https://scramble.dedoc.co/api',
     * ],
     * ```
     */
    'servers' => null,

    'middleware' => [
        'web',
    ],

    'extensions' => [],

    'excluded_routes' => [
        'api/documentation*', // ✅ exclude vendor SwaggerController
    ],
];
