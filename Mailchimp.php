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

namespace cinghie\mailchimp;

use Yii;
use yii\base\Module;
use yii\i18n\PhpMessageSource;

class Mailchimp extends Module
{
	// Rules
	public $roles = ['admin'];

	// Show Firstname in Widget
    public $showFirstname = true;

	// Show Lastname in Widget
    public $showLastname = true;

	// Show Titles in the views
	public $showTitles = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
	    $this->registerTranslations();

        parent::init();
    }

    /**
     * Translating module message
     */
    public function registerTranslations()
    {
        if (!isset(Yii::$app->i18n->translations['mailchimp*']))
        {
            Yii::$app->i18n->translations['mailchimp*'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}
