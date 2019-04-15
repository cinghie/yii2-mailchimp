<?php

/** @var array $lists */

use yii\helpers\Url;

?>

<div class="row">

	<div class="col-md-12">

		<div class="table-responsive">

			<table class="table no-margin">
				<thead>
				<tr>
					<th class="text-center"><?= Yii::t('mailchimp','List Name') ?></th>
					<th class="text-center"><?= Yii::t('mailchimp','Member Count') ?></th>
					<th class="text-center"><?= Yii::t('mailchimp','Unsubscribe Count') ?></th>
					<th class="text-center"><?= Yii::t('traits','ID') ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($lists as $list) {

					$list_id = $list['id'];
					$list_name = '<a href="'.Url::to([ 'default/list', 'id' => $list['id'], 'name' => $list['name'] ]).'">'.$list['name'].'</a>';
					$member_count = $list['stats']['member_count'];
					$member_unsub = $list['stats']['unsubscribe_count'];

					?>
					<tr>
						<td class="text-center"><?= $list_name ?></td>
						<td class="text-center"><?= $member_count ?></td>
						<td class="text-center"><?= $member_unsub ?></td>
						<td class="text-center"><?= $list_id ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>

		</div>

	</div>

</div>
