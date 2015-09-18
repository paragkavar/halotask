<div id="filterBox">
	<?php echo FORM::open(URL::base() . $controller.'/add', array('id' => 'form_task_new')); ?>

	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td>Project</td>
			<td>:</td>
			<td>
				<?php echo FORM::input('project', $data['project'], array('size' => '50')); ?>
				<?php echo (empty($errors['project']))?'': '<br />'.$errors['project']; ?>
			</td>
		</tr>
		<tr>
			<td>Task/Activity</td>
			<td>:</td>
			<td><?php echo FORM::input('activity', $data['activity'], array('size' => '35')); ?>
				<?php echo (empty($errors['activity']))?'': '<br />'.$errors['activity']; ?>
			</td>
		</tr>
		<tr>
			<td>Hours</td>
			<td>:</td>
			<td><?php echo FORM::input('hours', $data['hours'], array('size' => '5')); ?>
				<?php echo (empty($errors['hours']))?'': '<br />'.$errors['hours']; ?>
			</td>
		</tr>
		<tr>
			<td>Achievement</td>
			<td>:</td>
			<td><?php echo FORM::input('achievement', $data['achievement'], array('size' => '50')); ?>

				<?php echo (empty($errors['achievement']))?'': '<br />'.$errors['achievement']; ?>
			</td>
		</tr>
		<tr>
			<td width='18%'></td>
			<td width='2%'></td>
			<td>
                <div class="fLeft btnMargin"><?php echo HTML::anchor('', html::image('images/cancel_btn_03.png', array('alt' => 'Cancel')));?></div>
                <div class="fLeft"><?php echo HTML::anchor('#', html::image('images/save_btn_06.png', array('alt' => 'Save', 'id' => 'save_task_new' )));?></div>
			</td>
		</tr>
	</table>
	<?php echo FORM::close(); ?>
</div>
			
