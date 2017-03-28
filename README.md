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
        'apiKey' => 'YOUR_API_KEY',
        'showFirstname' => true,
        'showLastname' => true
    ]
    
]
```

Widget Subscription Example
---------------------------

```
<?= Subscription::widget([
    'apiKey' => 'MYAPIKEY' // if not set get Configuration apiKey
    'list_id' => 'MYLISTID' // if not set raise Error
]) ?>
```

alternative to list_id you can set an list_array to set a list_id to a specific language

```
<?= Subscription::widget([
    'apiKey' => 'MYAPIKEY' // if not set get Configuration apiKey
    'list_array' => [
        'en' => 'MYLISTID_EN',
        'es' => 'MYLISTID_ES',
        'it' => 'MYLISTID_IT',                        
    ]
]) ?>
```

Actions
-------

<ul> 
  <li>Lists View: PathToApp/index.php?r=mailchimp/default/lists</li>
  <li>Lists View with Pretty Urls: PathToApp/mailchimp/default/lists</li>
  <li>List View: PathToApp/index.php?r=mailchimp/default/list?id=XXX&name=XXX</li>
  <li>List View with Pretty Urls: PathToApp/mailchimp/default/list?id=XXX&name=XXX</li>
</ul>