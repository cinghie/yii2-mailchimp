<?php

/**
* @copyright Copyright &copy; Gogodigital Srls
* @company Gogodigital Srls - Wide ICT Solutions
* @website http://www.gogodigital.it
* @github https://github.com/cinghie/yii2-mailchimp
* @license BSD 3-Clause
* @package yii2-mailchimp
* @version 0.0.1
*/

namespace cinghie\mailchimp\widgets;

use Yii;
use DrewM\MailChimp\MailChimp;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class Subscription extends Widget
{
    public function init()
    {
        parent::init();

        $MailChimp = new MailChimp('');

        if(isset($_POST['subscribe-submit']))
        {
            $result = $MailChimp->post("lists/33239/members", [
                'email_address' => 'giando.working@gmail.com',
                'status' => 'subscribed',
            ]);

            if ($MailChimp->success()) {
                print_r($result);
            } else {
                print_r($result);
            }
        }

        echo Html::beginTag('div', array('class'=> 'col-md-12 text-center', 'id' => 'subscribe-div'));
        echo Html::beginForm();
        echo Html::beginTag('div', array('class'=> 'col-md-6 text-center'));
        echo Html::textInput('subscribe-first-name',(empty($_POST['subscribe-first-name']) ? '' : $_POST['subscribe-first-name']), array('id' => 'subscribe-first-name','placeholder'=> Yii::t('mailchimp', 'First Name')));
        echo Html::endTag('div');
        echo Html::beginTag('div', array('class'=> 'col-md-6 text-center'));
        echo Html::textInput('subscribe-last-name',(empty($_POST['subscribe-last-name']) ? '' : $_POST['subscribe-last-name']), array('id' => 'subscribe-last-name','placeholder'=> Yii::t('mailchimp', 'First Name')));
        echo Html::endTag('div');
        echo Html::beginTag('div', array('class'=> 'col-md-12 text-center'));
        echo Html::textInput('subscribe-email', (empty($_POST['subscribe-email']) ? '' : $_POST['subscribe-email']), array('id' => 'subscribe-email', 'type' => 'email','placeholder'=> Yii::t('mailchimp', 'Email'), 'required' => 'required'));
        echo Html::endTag('div');
        echo Html::beginTag('div', array('class'=> 'col-md-12 text-center'));
        echo Html::submitButton(Yii::t('mailchimp', 'Subscribe'), array('id' => 'subscribe-submit', 'name' => 'subscribe-submit'));
        echo Html::endTag('div');
        echo Html::endForm();
        echo Html::endTag('div');
    }
}
