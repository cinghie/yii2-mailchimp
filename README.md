Yii2 Mailchimp
==============

Yii2 MailChimp extension to manage the Email Marketing Platform: https://www.mailchimp.com/

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require cinghie/yii2-mailchimp "*"
```

or add

```
"cinghie/yii2-mailchimp": "*"
```

Configuration
-------------

Set on your configuration file, in modules section

```
'modules' => [ 
    
    'mailchimp' => [
        'class' => 'cinghie\mailchimp\Mailchimp',
        'apiKey' => 'YOUR_API_KEY'
    ]
    
]
```
