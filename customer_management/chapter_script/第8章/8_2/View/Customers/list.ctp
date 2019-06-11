<tr>
	<td><?php echo h($customer['Customer']['customer_cd']); ?></td>
	<td><?php echo h($customer['Customer']['name']); ?></td>
	<td><?php echo h($customer['Customer']['kana']); ?></td>
	<td><?php echo h($customer['Company']['company_name']); ?></td>
	<td><?php echo h($customer['Prefecture']['pref_name']); ?></td>
	<td><?php echo h($customer['Customer']['phone']); ?></td>
	<td><?php echo h($customer['Customer']['email']); ?></td>
	<td>
		<?php
			/** 更新ボタン */
			echo $this->Html->link(
				__('更新'),
				array('action' => 'edit', $customer['Customer']['id']),
				array('class' => 'btn btn-primary btn-small')
			);
		?>
		<?php
			/** 削除ボタン */
			echo $this->Form->postLink(
				__('削除'),
				array('action' => 'delete', $customer['Customer']['id']),
				array('class' => 'btn btn-primary btn-small'),
				__('削除してもよろしいですか？ # %s?', $customer['Customer']['id'])
			);
		?>
	</td>
</tr>
