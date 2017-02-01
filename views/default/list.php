<?php

// Set Title and Breadcrumbs
$this->title = Yii::t('mailchimp', 'List').": ".$name." (".$id.")";
$this->params['breadcrumbs'][] = Yii::t('mailchimp', 'Newsletters');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mailchimp', 'Lists'), 'url' => ['lists']];
$this->params['breadcrumbs'][] = $this->title;

$html = '<table class="table table-bordered table-responsive">';
$html .= '<thead>';
$html .= '<tr>
            <th class="text-center">'.Yii::t('mailchimp','Email').'</th>
            <th class="text-center">'.Yii::t('mailchimp','First Name').'</th>
            <th class="text-center">'.Yii::t('mailchimp','Last Name').'</th>
            <th class="text-center">'.Yii::t('mailchimp','Date Subscription').'</th>
            <th class="text-center">'.Yii::t('mailchimp','IP').'</th>
          </tr>';
$html .= '<tbody>';


foreach($members as $member) {
    $html .= '<tr>';
    $html .= '<td class="text-center">'.$member['email_address'].'</td>';
    $html .= '<td class="text-center">'.$member['merge_fields']['FNAME'].'</td>';
    $html .= '<td class="text-center">'.$member['merge_fields']['LNAME'].'</td>';
    $html .= '<td class="text-center">'.$member['timestamp_opt'].'</td>';
    $html .= '<td class="text-center">'.$member['ip_opt'].'</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

echo $html;