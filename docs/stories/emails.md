# Emails

When using Magento and Daffodil together, you will need to navigate your users with emails sent from Magento. By default, Magento will send emails with links back to the default Magento theme. Since Daffodil doesn't use the Magento theme at all, we need to swap these routes to the external Daffodil version of the route. You can do this mapping via your `config.php`.

* [Example `config.php`](./emails/config-emails.php)