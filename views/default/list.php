<?php

/** @var $members \DrewM\MailChimp\MailChimp */
/** @var $id integer */
/** @var $name string */

// Set Title and Breadcrumbs
$this->title = Yii::t('mailchimp', 'List').': '.$name.' ('.$id.')';
$this->params['breadcrumbs'][] = Yii::t('mailchimp', 'Newsletters');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mailchimp', 'Lists'), 'url' => ['lists']];
$this->params['breadcrumbs'][] = $this->title;

$file = Yii::getAlias('@vendor/cinghie/yii2-admin-lte/AdminLTEAsset.php');

if(!file_exists($file)) {

	echo $this->render('_list_default', [
		'members' => $members
	]);

} else {

	echo $this->render('_list_adminlte', [
		'members' => $members
	]);
}
