<?php

use yii\helpers\Url;

// Set Title and Breadcrumbs
$this->title = Yii::t('mailchimp', 'Lists');
$this->params['breadcrumbs'][] = Yii::t('mailchimp', 'Newsletters');
$this->params['breadcrumbs'][] = $this->title;

if($lists)
{
    $html = '<table class="table table-bordered table-responsive">';
    $html .= '<thead>';
    $html .= '<tr>
            <th>'.Yii::t('mailchimp','List Name').'</th>
            <th class="text-center">'.Yii::t('mailchimp','Member Count').'</th>
            <th class="text-center">'.Yii::t('mailchimp','Unsubscribe Count').'</th>
            <th class="text-center">'.Yii::t('mailchimp','ID').'</th>
          </tr>';
    $html .= '<tbody>';

    foreach($lists as $list) {
        $html .= '<tr>';
        $html .= '<td><a href="'.Url::to([ 'default/list', 'id' => $list['id'], 'name' => $list['name'] ]).'">'.$list['name'].'</a></td>';
        $html .= '<td class="text-center" width="8%">'.$list['stats']['member_count'].'</td>';
        $html .= '<td class="text-center" width="8%">'.$list['stats']['unsubscribe_count'].'</td>';
        $html .= '<td class="text-center" width="8%">'.$list['id'].'</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

} else {

    $html = '<div class="alert alert-danger">'.Yii::t('mailchimp', 'No Lists Found').'</div>';
}

echo $html;
