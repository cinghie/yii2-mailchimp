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

namespace cinghie\mailchimp\controllers;

use Yii;
use DrewM\MailChimp\MailChimp;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['lists', 'list'],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * Displays import view
     * @return mixed
     */
    public function actionLists()
    {
        $apiKey = Yii::$app->controller->module->apiKey;

        $MailChimp = new MailChimp($apiKey);
        $lists = $MailChimp->get('lists');

        return $this->render('lists', [
            'lists' => $lists,
        ]);
    }

}