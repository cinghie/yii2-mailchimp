<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-mailchimp
 * @license BSD 3-Clause
 * @package yii2-mailchimp
 * @version 0.1.1
 */

namespace cinghie\mailchimp\widgets;

use Yii;
use DrewM\MailChimp\MailChimp;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class Subscription extends Widget
{
    public $apiKey;
    public $list_id;

    public function init()
    {
        parent::init();

        $class   = "";
        $fname   = "";
        $lname   = "";
        $email   = "";
        $message = "";

        // Api Key
        if(!$this->apiKey) {
            if(!Yii::$app->getModule('mailchimp')->apiKey) {
                throw new \yii\base\InvalidConfigException("You must define apiKey in your Configuration File");
            } else {
                $this->apiKey = Yii::$app->getModule('mailchimp')->apiKey;
            }
        }

        // Api Key
        if(!$this->list_id) {
            throw new \yii\base\InvalidConfigException("You must define Mailchimp ListID");
        }

        $post = Yii::$app->request->post();
        $MailChimp = new MailChimp($this->apiKey);

        if($post) {
            $email  = $post['subscribe-email'];
            $fname  = isset($post['subscribe-first-name']) ? $post['subscribe-first-name'] : "";
            $lname  = isset($post['subscribe-last-name']) ? $post['subscribe-last-name'] : "";
            $submit = $post['subscribe-submit'];
        }

        if( isset($submit) )
        {
            $result = $MailChimp->post("lists/".$this->list_id."/members", [
                'merge_fields' => [
                    'FNAME' => $fname,
                    'LNAME' => $lname
                ],
                'email_address' => $email,
                'status' => 'subscribed',
            ]);

            if ($MailChimp->success()) {

                $class   = "alert-success";
                $message = $result['email_address']." ".$result['status'];

            } else {

                $class   = "alert-warning";
                $message = $result['title'];
            }
        }

        echo Html::beginTag('div', array('class'=> 'col-md-12 text-center', 'id' => 'subscribe-div'));

        if(isset($message) && $message) {
            echo Html::tag('div', $message, array('id' => 'subscribe-message', 'class' => 'alert '.$class));
        }

        echo Html::beginForm();

        if(Yii::$app->getModule('mailchimp')->showFirstname) {
            echo Html::beginTag('div', array('class'=> 'col-md-6 text-center'));
            echo Html::textInput('subscribe-first-name',(empty($post['subscribe-first-name']) ? '' : $post['subscribe-first-name']), array('id' => 'subscribe-first-name','placeholder'=> Yii::t('mailchimp', 'First Name')));
            echo Html::endTag('div');
        }

        if(Yii::$app->getModule('mailchimp')->showLastname) {
            echo Html::beginTag('div', array('class'=> 'col-md-6 text-center'));
            echo Html::textInput('subscribe-last-name',(empty($post['subscribe-last-name']) ? '' : $post['subscribe-last-name']), array('id' => 'subscribe-last-name','placeholder'=> Yii::t('mailchimp', 'First Name')));
            echo Html::endTag('div');
        }

        echo Html::beginTag('div', array('class'=> 'col-md-12 text-center'));
        echo Html::textInput('subscribe-email', (empty($post['subscribe-email']) ? '' : $post['subscribe-email']), array('id' => 'subscribe-email', 'type' => 'email','placeholder'=> Yii::t('mailchimp', 'Email'), 'required' => 'required'));
        echo Html::endTag('div');
        echo Html::beginTag('div', array('class'=> 'col-md-12 text-center'));
        echo Html::submitButton(Yii::t('mailchimp', 'Subscribe'), array('id' => 'subscribe-submit', 'name' => 'subscribe-submit'));
        echo Html::endTag('div');
        echo Html::endForm();
        echo Html::endTag('div');
    }

}