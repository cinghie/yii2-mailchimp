<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-mailchimp
 * @license BSD 3-Clause
 * @package yii2-mailchimp
 * @version 0.1.0
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
                ],
                'denyCallback' => function () {
                    throw new \Exception('You are not allowed to access this page');
                }
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
            'lists' => $lists['lists'],
        ]);
    }

    /**
     * Displays a single Items model.
     * @return mixed
     */
    public function actionList()
    {
        $apiKey = Yii::$app->controller->module->apiKey;
        $request = Yii::$app->request;

        $id   = $request->get('id');
        $name = $request->get('name');

        $MailChimp = new MailChimp($apiKey);
        $members = $MailChimp->get("lists/".$id."/members");

        return $this->render('list', [
            'members' => $members['members'],
            'id' => $id,
            'name' => $name
        ]);
    }

}