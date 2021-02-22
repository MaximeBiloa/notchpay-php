# Notch Pay PHP

Notch Pay PHP client

Requires PHP 5.3 and higher.

## Installation

Install notchpay-php using Composer:

```
composer require notchpay/notchpay-php
```

You will then need to:

- run `composer install` to get these dependencies added to your vendor directory
- add the autoloader to your application with this line: `require("vendor/autoload.php")`

## Usages

To use Notch Relay Api you need API KEY

```php
use \NotchPay\NotchPay;

$notchpay = new NotchPay('B3abc123abc123');
```

Init checkout transaction (with `checkout` method):

```php
$list_id = '1234346';

$result = $notchpay->subscribe($list_id, array("amount" => 500, "currency" => "XAF", "description" => "Notch Pay checkout", "email" => "me@notchpay.test", 'phone' => "237676761582"));

print_r($result);
```

Verify transaction (with `verify` method):

```php
$reference = 'vy5OeXsOZQvyVxst';

$result = $notchpay->verify($reference);

print_r($result);
```

## Contributing

This is a fairly simple wrapper, but it has been made much better by contributions from those using it. If you'd like to suggest an improvement, please raise an issue to discuss it before making your pull request.

Pull requests for bugs and features are more than welcome - please explain the bug you're trying to fix in the message.
