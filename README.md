# JVZoo IPN

A Laravel package for handling JVZoo Instant Payment Notifications (IPN) with clean event-driven architecture.

## Features

- JVZoo IPN webhook handling
- Signature verification
- Duplicate transaction protection (idempotent processing)
- Event-driven architecture
- Transaction logging
- Configurable routes
- Laravel auto-discovery support

## Installation

```bash
composer require josmarh/jvzoo-ipn

```md id="k5v9mz"
## Publish Config

```bash
php artisan vendor:publish --tag=jvzoo-ipn-config

```md id="u2x7qp"
## How It Works

1. JVZoo sends IPN request
2. Package verifies signature
3. Transaction is stored
4. Event is dispatched
5. Your application handles user logic

## Events

### SaleReceived

Triggered when a successful payment occurs.

### RefundReceived

Triggered when a refund occurs.

## Example Listener

```php
Event::listen(SaleReceived::class, function ($event) {
    // Create user, assign plan, etc.
});

```md id="m3p8vz"
## Configuration

```php
return [
    'secret_key' => env('JVZOO_SECRET'),
    'route_prefix' => 'jvzoo',
];

```md id="x9v4qn"
## Webhook URL

POST https://your-domain.com/jvzoo/ipn

## Security

This package verifies JVZoo IPN signatures before processing any request to ensure data integrity and prevent unauthorized requests.