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

   <h3> <?php echo $date;?> </h3>
<div id="filterBox">
	<?php echo FORM::open(URL::base() . $controller, array('id' => 'form_task_new')); ?>
    <?php echo Form::hidden('date', $date); ?> 
    
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td>Project</td>
			<td>:</td>
			<td>
				<?php echo FORM::input('project', $data['project'], array('size' => '80')); ?>
				<?php echo (empty($errors['project']))?'': '<br />'.$errors['project']; ?>
			</td>
		</tr>
		<tr>
			<td>Task/Activity</td>
			<td>:</td>
			<td><?php echo FORM::input('activity', $data['activity'], array('size' => '80')); ?>
				<?php echo (empty($errors['activity']))?'': '<br />'.$errors['activity']; ?>
			</td>
		</tr>
		<tr>
			<td>Hours</td>
			<td>:</td>
			<td>
			    <input type="text" name="hours" id="hours" size="2" onKeyPress="return numbersonly(this,event)" onchange="changeslider(this)"/>
                <div id="slider-hours"></div>

			    <?php //echo FORM::select('hours',$selection_hours, $data['hours']); ?>
			    <?php //echo FORM::input('hours', $data['hours'], array('size' => '5')); ?>
				<?php //echo (empty($errors['hours']))?'': '<br />'.$errors['hours']; ?>
			</td>
		</tr>
		<tr>
			<td>Achievement</td>
			<td>:</td>
			<td><?php echo FORM::textarea('achievement',$data['achievement'],array('width' => '80')); ?>
				<?php echo (empty($errors['achievement']))?'': '<br />'.$errors['achievement']; ?>
			</td>
		</tr>
		<tr>
			<td width='18%'></td>
			<td width='2%'></td>
			<td>
                <div class="fLeft"><?php echo HTML::anchor('#', html::image('images/save_btn_06.png', array('alt' => 'Save', 'id' => 'save_task_new' )));?></div>
			</td>
		</tr>
	</table>
	<?php echo FORM::close(); ?>
</div>
<div class="clear"></div>
<div style="text-align:center">
<?php echo FORM::open(URL::base() . $controller, array('id' => 'form_task_date','method'=>'get')); ?>
<?php echo Form::input('date', $date, array('class'=>'validate[required,custom[date]]','id' => 'task_date', 'size' => '10')); ?>
<br/>
<?php echo FORM::submit('submit', 'Select');?>
<?php echo FORM::close(); ?>
<div id="task_date_nav">
| <?php echo HTML::anchor(URL::base().$controller.'?date='.(date('Y-m-d',time()-24*3600)), 'Yesterday')?> 
| <?php echo HTML::anchor(URL::base().$controller.'?date='.date('Y-m-d'), 'Today')?> |
</div>
</div>

<br/>
<div class="divfull">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th width="3%">No</th>
			<th width="15%">Project</th>
			<th width="20%">Task/Activity</th>				
			<th width="3%">Hours</th>
			<th width="22%">Achievement</th>
			<th width="10%">Action</th>
			</tr>
		<?php if(isset($tasklist)): ?>
		<?php $i=0; ?>
		<?php foreach($tasklist as $row): ?>
			<?php $style = ($i % 2) ? 'row1' : 'row2'; ?>
			<tr class="<?php echo $style; ?>">
				<td><?php echo $i+1;?></td>
				<td><?php echo $row->project; ?></td>
				<td><?php echo $row->activity; ?></td>
				<td><?php echo $row->hours; ?></td>
				<td><?php echo $row->achievement; ?></td>
				<td style="text-align:center">
					<?php echo HTML::anchor(URL::base().'tasks/edit/'
											. $row->id.'?date='.$date, 
							html::image('images/edit.png', array('alt' => 'Edit')));?>&nbsp;&nbsp;
			        
			        
					
					
					<?php echo HTML::anchor(URL::base().'tasks/delete/'
										. $row->id.'?date='.$date,
							html::image('images/delete.png', array('alt' => 'Delete', 'class' => 'delete', 'id' => 
							'delete')));?>
					
				</td>
			</tr>
			<?php $i++; ?>	
		<?php endforeach ?>
		<?php endif ?>			
	</table>

</div>
<script language='javascript'>
$('#task_date').datepicker({
        showOn: 'button',
        buttonImage: '../../../../images/calendar.gif',
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        buttonImageOnly: true ,
        altField: '#alternate',
        altFormat: 'yy MM d'
    });
</script>
