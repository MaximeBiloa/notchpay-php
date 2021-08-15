# Notch Pay PHP

Notch Pay PHP Wrapper

Requires PHP 5.3 and higher.

## Installation

Install notchpay-php using Composer:

```
composer require notchpay/php-sdk
```

You will then need to:

- run `composer install` to get these dependencies added to your vendor directory
- add the autoloader to your application with this line: `require("vendor/autoload.php")`

## Usages

### Transactions

To use Notch Pay Transaction api you need Business ID

```php
use \NotchPay\Transaction;

$notchpay = new Transaction('B3abc123abc123');
```

#### Init checkout transaction (with `init` method):

```php
$result = $notchpay->init(array("amount" => 500, "currency" => "XAF", "description" => "Notch Pay checkout", "email" => "me@notchpay.test", 'phone' => "237676761582"));

print_r($result);
```

#### Fetch transaction (with `fetch` method):

```php
$reference = 'vy5OeXsOZQvyVxst';

$result = $notchpay->fetch($reference);

print_r($result);
```

#### Cancel transaction (with `cancel` method):

```php
$reference = 'vy5OeXsOZQvyVxst';

$result = $notchpay->cancel($reference);

print_r($result);
```

#### Complete transaction (with `complete` method):

```php
$reference = 'vy5OeXsOZQvyVxst';
$gateway = 'mobile';
$data = [
    "phone" => "+237671234567"
]

$result = $notchpay->complete($reference, $gateway, $data);

print_r($result);
```

### Subscription

To use Notch Pay Subscription api you need Business ID

```php
use \NotchPay\Subscription;

$notchpay = new Subscription('B3abc123abc123');
```

#### Init Subscription(with `init` method):

```php
$list_id = '1234346';

$result = $notchpay->init($plan_id, array("email" => "me@notchpay.test", 'phone' => "237676761582"));

print_r($result);
```

#### Fetch Subscription (with `fetch` method):

```php
$reference = 'vy5OeXsOZQvyVxst';

$result = $notchpay->fetch($reference);

print_r($result);
```

#### Cancel Subscription (with `cancel` method):

```php
$reference = 'vy5OeXsOZQvyVxst';

$result = $notchpay->cancel($reference);

print_r($result);
```

#### Complete Complete (with `complete` method):

```php
$reference = 'vy5OeXsOZQvyVxst';
$gateway = 'mobile';
$data = [
    "phone" => "+237671234567"
]

$result = $notchpay->complete($reference, $gateway, $data);

print_r($result);
```

## Contributing

This is a fairly simple wrapper, but it has been made much better by contributions from those using it. If you'd like to suggest an improvement, please raise an issue to discuss it before making your pull request.

Pull requests for bugs and features are more than welcome - please explain the bug you're trying to fix in the message.
