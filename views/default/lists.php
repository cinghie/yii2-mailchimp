<?php

// Set Title and Breadcrumbs
$this->title = Yii::t('mailchimp', 'Lists');
$this->params['breadcrumbs'][] = $this->title;

$lists = $lists['lists'];

var_dump($lists);

$html = '<table class="table table-bordered table-responsive">';
$html .= '<thead>';
$html .= '<tr>
            <th>'.Yii::t('mailchimp','List Name').'</th>
            <th>'.Yii::t('mailchimp','Member Count').'</th>
            <th>'.Yii::t('mailchimp','Member Count').'</th>
            <th>'.Yii::t('mailchimp','List Name').'</th>
          </tr>';
$html .= '<tbody>';


foreach($lists as $list) {
    $html .= '<tr>';
    $html .= '<td>'.$list['name'].'</td>';
    $html .= '<td>'.$list['stats']['member_count'].'</td>';
    $html .= '<td>'.$list['id'].'</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

echo $html;
