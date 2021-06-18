# OS2Forms CVR Lookup

Query the Danish CVR register for Drupal Webforms.

## Installation

Require it with composer:
```shell
composer require "itk-dev/os2forms_cvr_lookup"
```

Enable it with drush:
```shell
drush pm:enable os2forms_cvr_lookup
```

Add the following configuration:

```php
$config['os2forms_cvr_lookup'] = [
  'azure_tenant_id' => '',
  'azure_application_id' => '',
  'azure_client_secret' => '',

  'azure_key_vault_name' => '',
  'azure_key_vault_secret' => '',
  'azure_key_vault_secret_version' => '',

  'service_agreement_uuid' => '',
  'user_system_uuid' => '',
  'user_uuid' => '',

  'service_uuid' => '',
  'service_endpoint' => '',
  'service_contract' => dirname(DRUPAL_ROOT) . '/vendor/itk-dev/serviceplatformen/resources/online-service-contract/wsdl/context/OnlineService.wsdl',
];
```

## Usage

This module provides functionality for querying the danish CVR register and showing the result.
In general terms you use it by adding a query element, which when changed performs a query and
populates other elements with the result.

The elements provided:

* CVR Element - Element which queries the Danish CVR register when changed.
* CVR Name Element - This is populated with the name from the above mentioned query result.
* CVR Street Element - This is filled with the name of the street from the result.
* CVR House Number Element - This is filled with the house number from the result.
* CVR Postal Code Element - This is filled with the postal code from the result.
* CVR City Element - This is filled with the city from the result.

## Coding standards

Run phpcs with the provided configuration:

```shell
composer coding-standards-check

// Apply coding standards
composer coding-standards-apply
```
