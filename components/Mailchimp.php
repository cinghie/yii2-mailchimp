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

namespace cinghie\mailchimp\components;

use DrewM\MailChimp\MailChimp as baseMailchimp;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class Mailchimp
 *
 * @property baseMailchimp $client
 * @property array $lists
 */
class Mailchimp extends Component
{
	/**
	 * @var string
	 */
	public $apiKey;

	/**
	 * @var baseMailchimp
	 */
	private $_mailchimp;

	/**
	 * Mailchimp constructor
	 *
	 * @param array $config
	 *
	 * @throws InvalidConfigException
	 */
	public function __construct(array $config = [])
	{
		if(!isset($config['apiKey']) || !$config['apiKey']) {
			throw new InvalidConfigException(Yii::t('mailchimp', 'Mailchimp API Key missing!'));
		}

		$this->apiKey = $config['apiKey'];

		parent::__construct($config);
	}

	/**
	 * Mailchimp init
	 */
	public function init()
	{
		$this->_mailchimp = new baseMailchimp($this->apiKey);

		parent::init();
	}

	/**
	 * @return baseMailchimp
	 */
	public function getClient()
	{
		return $this->_mailchimp;
	}

	/**
	 * Get Mailchimp Lists
	 *
	 * @return array
	 */
	public function getLists()
	{
		return $this->_mailchimp->get('lists');
	}

	/**
	 * Get List Members
	 *
	 * @param $listID
	 *
	 * @return array
	 */
	public function getListMembers($listID)
	{
		return $this->_mailchimp->get('lists/' .$listID. '/members');
	}
}

