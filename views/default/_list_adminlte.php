<?php

/** @var $members \DrewM\MailChimp\MailChimp */

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
							<th class="text-center"><?= Yii::t('traits','Name') ?></th>
							<th class="text-center"><?= Yii::t('traits','Email') ?></th>
							<th class="text-center"><?= Yii::t('mailchimp','Subscription\s Date') ?></th>
							<th class="text-center"><?= Yii::t('mailchimp','IP') ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($members as $member): ?>
							<tr>
								<td class="text-center"><?= $member['merge_fields']['NAME'] ?></td>
								<td class="text-center"><?= Html::mailto($member['email_address'] , $member['email_address'] ) ?></td>
								<td class="text-center"><?= $member['timestamp_opt'] ?></td>
								<td class="text-center"><?= $member['ip_opt'] ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>

				</div>

			</div>

		</div>

	</div>

</div>
