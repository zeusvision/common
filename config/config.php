<?php

return [
    'user' => App\User::class,
    'testing' => [
        'transactions' => env('DATABASE_TRANSACTIONS', true),
    ]
];
