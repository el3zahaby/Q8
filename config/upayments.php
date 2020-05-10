<?php
// use it like this:
// ['sandbox','production']
// change "xxx" values
return [
    'debug'=>false,
    'api_url' =>['https://api.upayments.com/test-payment','https://api.upayments.com/payment-request'],
    'merchant_id' => ['1201', '3319'],
    'username' => ['test', 'purecenter77'],
    'password' => ['test', stripslashes('!ZcRqj9qZE2K3?@7')],
    'api_key' => ['$2y$10$uZo54fgb1ROPw3OxPJrjnukyTul8h8D.rEEtfU8o.r5MkfWieyBae', password_hash('Wa3ZhVxOJP7UmIb54Gm1b2c1xYL3xauh97CU3IKR',PASSWORD_BCRYPT)],
    'CurrencyCode' => ['KWD', 'KWD'],
    'test_mode' => [1, 0],
    'payment_gateway' => ['NA', 'knet'],
    'whitelabled' => ['NA', false],
];
