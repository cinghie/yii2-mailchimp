<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-mailchimp
 * @license BSD 3-Clause
 * @package yii2-mailchimp
 * @version 0.2.2
 */

namespace cinghie\mailchimp\widgets;

use DrewM\MailChimp\MailChimp;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\web\Request;

/**
 * Class Subscription
 */
class Subscription extends Widget
{
	/**
	 * @var string $list_id
	 */
    public $list_id;

	/**
	 * @var array $list_array
	 */
    public $list_array;

	/**
	 * @var Request
	 */
	private $_post;

	/**
	 * @var MailChimp
	 */
    private $_mailchimp;

	/**
	 * @throws InvalidConfigException
	 */
	public function init()
    {
	    if (!$this->list_id && !$this->list_array) {
	        throw new InvalidConfigException('You must define Mailchimp ListID');
	    }

	    if($this->list_array) {
	        $this->list_id = $this->list_array[Yii::$app->language];
	    }

	    $this->_mailchimp = Yii::$app->mailchimp->getClient();
	    $this->_post = Yii::$app->request->post();

	    parent::init();
    }

	/**
	 * @return string|void
	 */
	public function run()
    {
	    $class   = '';
	    $fname   = '';
	    $lname   = '';
	    $email   = '';
	    $message = '';
	    $submit  = null;

	    if($this->_post) {
		    $email  = $this->_post['subscribe-email'];
		    $fname  = isset($this->_post['subscribe-first-name']) ? $this->_post['subscribe-first-name'] : '';
		    $lname  = isset($this->_post['subscribe-last-name']) ? $this->_post['subscribe-last-name'] : '';
		    $submit = $this->_post['subscribe-submit'];
	    }

	    if($submit !== null)
	    {
		    $result = $this->_mailchimp->post('lists/' .$this->list_id. '/members', [
			    'merge_fields' => [
				    'FNAME' => $fname,
				    'LNAME' => $lname
			    ],
			    'email_address' => $email,
			    'status' => 'subscribed',
		    ]);

		    if ($this->_mailchimp->success()) {
			    $class   = 'alert-success';
			    $message = $result['email_address']. ' ' .$result['status'];
		    } else {
			    $class   = 'alert-warning';
			    $message = $result['title'];
		    }
	    }

	    echo Html::beginTag('div', array('class'=> 'col-md-12 text-center', 'id' => 'subscribe-div'));

	    if($message !== null && $message) {
		    echo Html::tag('div', $message, array('id' => 'subscribe-message', 'class' => 'alert '.$class));
	    }

	    echo Html::beginForm();

	    if(Yii::$app->getModule('mailchimp')->showFirstname) {
		    echo Html::beginTag('div', array('class'=> 'col-md-6 col-sm-6 col-xs-12 text-center'));
		    echo Html::textInput('subscribe-first-name',(empty($this->_post['subscribe-first-name']) ? '' : $this->_post['subscribe-first-name']), array('id' => 'subscribe-first-name','placeholder'=> Yii::t('traits', 'Firstname'), 'class'=> 'form-control'));
		    echo Html::endTag('div');
	    }

	    if(Yii::$app->getModule('mailchimp')->showLastname) {
		    echo Html::beginTag('div', array('class'=> 'col-md-6 col-sm-6 col-xs-12 text-center'));
		    echo Html::textInput('subscribe-last-name',(empty($this->_post['subscribe-last-name']) ? '' : $this->_post['subscribe-last-name']), array('id' => 'subscribe-last-name','placeholder'=> Yii::t('traits', 'Lastname'), 'class'=> 'form-control'));
		    echo Html::endTag('div');
	    }

	    echo Html::beginTag('div', array('class'=> 'col-md-12 text-center'));
	    echo Html::textInput('subscribe-email', (empty($this->_post['subscribe-email']) ? '' : $this->_post['subscribe-email']), array('id' => 'subscribe-email', 'type' => 'email','placeholder'=> Yii::t('traits', 'Email'), 'required' => 'required', 'class'=> 'form-control'));
	    echo Html::endTag('div');
	    echo Html::beginTag('div', array('class'=> 'col-md-12 text-center'));
	    echo Html::submitButton(Yii::t('mailchimp', 'Submit'), array('id' => 'subscribe-submit', 'name' => 'subscribe-submit', 'class'=> 'btn btn-primary'));
	    echo Html::endTag('div');

	    echo '<input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'" />';
	    echo Html::endForm();

	    echo Html::endTag('div');
    }
}
