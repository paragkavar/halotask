<?php
defined('SYSPATH') or die('No direct script access.');
?>
<!--
<div class="divfull">
	<div class="fLeft">
		<?php echo HTML::anchor(URL::base().$controller.'/add/', 
								HTML::image('images/newbtn_03.png', 
								array('alt'=>'New Task', 
										'title'=>'New Task'))); ?>
	</div>										
</div>
-->
<div id="filterBox">
	<?php echo FORM::open(URL::base() . $controller, array('id' => 'form_report')); ?>
    
	<table width="60%" cellpadding="0" cellspacing="0">
		<tr>
			<td width="10%">User</td>
			<td width="2%">:</td>
			<td width="20%">
			    <?php echo FORM::select('uid',$selection_user, $selected_user); ?>
			</td>
		</tr>
		<tr>
			<td width="10%">Date</td>
			<td width="2%">:</td>
			<td width="20%">
			<?php echo Form::input('date', $date, array('class'=>'validate[required,custom[date]]','id' => 'date', 'size' => '10')); ?>
			 to 
			<?php echo Form::input('date2', $date2, array('class'=>'validate[required,custom[date]]','id' => 'date2', 'size' => '10')); ?>
			</td>
		</tr>
		<tr>
		
			<td colspan="4"><?php echo form::submit('submit', 'Select');?>
			</td>
		</tr>
	</table>
	<?php echo FORM::close(); ?>
</div>
<div class="clear"></div>
<div class="divfull">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th width="3%">No</th>
			<th width="15%">Date</th>
			<th width="15%">Project</th>
			<th width="20%">Task/Activity</th>				
			<th width="3%">Hours</th>
			<th width="22%">Achievement</th>
			</tr>
		<?php if(isset($tasklist)): ?>
		<?php $i=0; ?>
		<?php foreach($tasklist as $row): ?>
			<?php $style = ($i % 2) ? 'row1' : 'row2'; ?>
			<tr class="<?php echo $style; ?>">
				<td><?php echo $i+1;?></td>
				<td><?php echo $row->date; ?></td>
				<td><?php echo $row->project; ?></td>
				<td><?php echo $row->activity; ?></td>
				<td><?php echo $row->hours; ?></td>
				<td><?php echo $row->achievement; ?></td>
			</tr>
			<?php $i++; ?>	
		<?php endforeach ?>
		<?php endif ?>			
	</table>

</div>
