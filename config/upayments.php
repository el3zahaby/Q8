<?php
// use it like this:
// ['sandbox','production']
// change "xxx" values
return [
    'debug'=>true,

    'api_url' =>['https://api.upayments.com/test-payment','https://api.upayments.com/payment-request'],
    'merchant_id' => ['1201', '4493'],
    'username' => ['test', 'q8tshirt'],
    'password' => ['test', ('R!Jnttu@N8S45')],
    'api_key' => ['jtest123', password_hash('31QbWtu2JH8rUGRst2FqV7CpjUclGw7z9MRklXFf',PASSWORD_BCRYPT)],
    'CurrencyCode' => ['KWD', 'KWD'],
    'test_mode' => [1, 0],
    'payment_gateway' => ['NA', 'knet'],
    'whitelabled' => ['NA', false],
];
