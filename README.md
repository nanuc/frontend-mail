# A mail driver to send mails in the frontend
This package send mail to the frontend of Laravel aps. This is useful for demos on landing pages.

## Installation
The package assumes that you have the stacks `scripts` and `styles` in your main Blade layout.

Install the package:
```
composer require nanuc/frontend-mail
```

Put the following somewhere in your views:
```
<x-frontend-mail />
```

Put the following in `config/mail.php`:
```
'mailers' => [
    // other mailers
    'frontend' => [
        'transport' => 'frontend',
    ],
]
```

Set your mailer to `frontend` in `.env`:
```
MAIL_MAILER=frontend
```