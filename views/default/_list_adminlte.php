<?php

/** @var array $members */

use yii\helpers\Html;

?>

<div class="row">

	<div class="col-md-12">

		<div class="box box-info">

			<!-- /.box-header -->
			<div class="box-body">

                <div class="table-responsive">

                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th class="text-center"><?= Yii::t('traits','Fullname') ?></th>
                                <th class="text-center"><?= Yii::t('traits','Firstname') ?></th>
                                <th class="text-center"><?= Yii::t('traits','Lastname') ?></th>
                                <th class="text-center"><?= Yii::t('traits','Email') ?></th>
                                <th class="text-center"><?= Yii::t('mailchimp','Subscription\s Date') ?></th>
                                <th class="text-center"><?= Yii::t('mailchimp','IP') ?></th>
                            </tr>
                        </thead>
                        <tbody>
	                    <?php foreach($members as $member) {

		                    $firstname = isset($member['merge_fields']['FNAME']) ? ucwords(strtolower($member['merge_fields']['FNAME'])) : '';
		                    $lastname  = isset($member['merge_fields']['LNAME']) ? ucwords(strtolower($member['merge_fields']['LNAME'])) : '';

	                        if(isset($member['merge_fields']['NAME'])) {
		                        $name = ucwords(strtolower($member['merge_fields']['NAME']));
                            } elseif($firstname && $lastname) {
		                        $name = $firstname.' '.$lastname;
                            } else {
		                        $name = '';
                            }

                        ?>
                            <tr>
                                <td class="text-center"><?= $name ?></td>
                                <td class="text-center"><?= $firstname ?></td>
                                <td class="text-center"><?= $lastname ?></td>
                                <td class="text-center"><?= Html::mailto($member['email_address'] , $member['email_address'] ) ?></td>
                                <td class="text-center"><?= $member['timestamp_opt'] ?></td>
                                <td class="text-center"><?= $member['ip_opt'] ?></td>
                            </tr>
	                    <?php } ?>
                        </tbody>
                    </table>

				</div>

			</div>

		</div>

	</div>

</div>
