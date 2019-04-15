<?php

/** @var array $lists */

// Set Title and Breadcrumbs
$this->title = Yii::t('mailchimp', 'Lists');
$this->params['breadcrumbs'][] = Yii::t('mailchimp', 'Newsletters');
$this->params['breadcrumbs'][] = $this->title;

$file = Yii::getAlias('@vendor/cinghie/yii2-admin-lte/AdminLTEAsset.php');

if(!file_exists($file)) {

	echo $this->render('_lists_default', [
		'lists' => $lists
	]);

} else {

	echo $this->render('_lists_adminlte', [
		'lists' => $lists
	]);
}
