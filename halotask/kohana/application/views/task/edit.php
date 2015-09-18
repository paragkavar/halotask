<?php
defined('SYSPATH') or die('No direct script access.');
?>
<!--
<div class="divfull">
	<div class="fLeft">
		<?php echo HTML::anchor(URL::base().$controller.'/add/', 
								HTML::image('images/newbtn_03.png', 
								array('alt'=>'Buat permintaan baru', 
										'title'=>'Buat permintaan baru'))); ?>
	</div>										
</div>
-->
<div id="filterBox">
	<?php echo FORM::open(URL::base() . $controller.'/edit', array('id' => 'form_task_edit')); ?>
    <?php echo FORM::hidden('id', $data->id); ?>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td>Project</td>
			<td>:</td>
			<td>
				<?php echo FORM::input('project', $data->project, array('size' => '50')); ?>
				<?php echo (empty($errors['project']))?'': '<br />'.$errors['project']; ?>
			</td>
		</tr>
		<tr>
			<td>Task/Activity</td>
			<td>:</td>
			<td><?php echo FORM::input('activity', $data->activity, array('size' => '35')); ?>
				<?php echo (empty($errors['activity']))?'': '<br />'.$errors['activity']; ?>
			</td>
		</tr>
		<tr>
			<td>Hours</td>
			<td>:</td>
			<td>
			<input type="text" name="hours" id="hours" value="<?php echo $data->hours?>" size="2" onKeyPress="return numbersonly(this,event)" onchange="changeslider(this)"/>
                <div id="slider-hours"></div>
			<?php //echo FORM::input('hours', $data->hours, array('id'=>'hours','size' => '1','onKeyPress'=>"return numbersonly(this,event)", 'onchange'=>"changeslider(this)")); ?>
                <div id="slider-hours"></div>
               
			</td>
		</tr>
		<tr>
			<td>Achievement</td>
			<td>:</td>
			<td><?php echo FORM::input('achievement', $data->achievement, array('size' => '50')); ?>
				<?php echo (empty($errors['achievement']))?'': '<br />'.$errors['achievement']; ?>
			</td>
		</tr>
		<tr>
			<td width='18%'></td>
			<td width='2%'></td>
			<td>
                <div class="fLeft btnMargin"><?php echo HTML::anchor('tasks', html::image('images/cancel_btn_03.png', array('alt' => 'Cancel')));?></div>
                <div class="fLeft"><?php echo HTML::anchor('#', html::image('images/save_btn_06.png', array('alt' => 'Save', 'id' => 'save_task_edit' )));?></div>
			</td>
		</tr>
	</table>
	<?php echo FORM::close(); ?>
</div>

