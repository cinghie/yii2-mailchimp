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

Widget Subscription Example
---------------------------

```
<?= Subscription::widget([
    'apiKey' => 'MYAPIKEY' // if not set get Configuration apiKey
    'list_id' => 'MYLISTID' // if not set raise Error
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