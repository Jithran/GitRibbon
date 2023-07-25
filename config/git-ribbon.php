<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Git Ribbon Settings
     |--------------------------------------------------------------------------
     |
     | Git ribbon is enabled by default, but you can disable it by setting
     | You can also set the environments where the ribbon should be shown.
     | The default environment is 'local'.
     |
     */
    'enabled' => env('GIT_RIBBON_ENABLED', true),
    'environment' => ['local', 'testing'],
];