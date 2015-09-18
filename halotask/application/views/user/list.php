<?php
defined('SYSPATH') or die('No direct script access.');
?>

<div id="filterBox">
	<?php echo FORM::open(URL::base() . $controller, array('id' => 'form_user_new')); ?>

    
	<table width="80%" cellpadding="0" cellspacing="0">
		<tr>
			<td>Username</td>
			<td>:</td>
			<td>
				<?php echo FORM::input('username', $data['username'], array('size' => '20')); ?>
				<?php echo (empty($errors['username']))?'': '<br />'.$errors['username']; ?>
			</td>
		</tr>
		<tr>
			<td>Fullname</td>
			<td>:</td>
			<td>
				<?php echo FORM::input('fullname', $data['fullname'], array('size' => '50')); ?>

				<?php echo (empty($errors['fullname']))?'': '<br />'.$errors['fullname']; ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><?php echo FORM::input('password', $data['password'], array('size' => '20')); ?>
				<?php echo (empty($errors['password']))?'': '<br />'.$errors['password']; ?>
			</td>
		</tr>
		<tr>
			<td>Role</td>
			<td>:</td>
			<td>

			    <?php echo FORM::select('role',$selection_role, $data['role']); ?>
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo FORM::input('email', $data['email'], array('size' => '80')); ?>
				<?php echo (empty($errors['email']))?'': '<br />'.$errors['email']; ?>
			</td>
		</tr>
		<tr>
			<td width='18%'></td>
			<td width='2%'></td>
			<td>
                <div class="fLeft"><?php echo FORM::submit('user','add');?></div>
			</td>
		</tr>
	</table>
	<?php echo FORM::close(); ?>
</div>
<div><?php echo $page_links;?></div>
<div class="divfull">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th width="3%">No</th>
			<th width="15%">Username</th>
			<th width="20%">Fullname</th>
			<th width="5%">Action</th>
			</tr>
		<?php if(isset($users)): ?>
		<?php $i=0; ?>
		<?php foreach($users as $row): ?>
			<?php $style = ($i % 2) ? 'row1' : 'row2'; ?>
			<tr class="<?php echo $style; ?>">
				<td><?php echo $i+1;?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->fullname; ?></td>
				<td style="text-align:center">
					<?php echo HTML::anchor(URL::base().'user/edit/'
											. $row->id, 
							html::image('images/edit.png', array('alt' => 'Edit')));?>&nbsp;&nbsp;
			        
			        
					
					
					<?php echo HTML::anchor(URL::base().'user/delete/'
										. $row->id,
							html::image('images/delete.png', array('alt' => 'Delete', 'class' => 'delete', 'id' => 
							'delete')));?>
					
				</td>
			</tr>
			<?php $i++; ?>	
		<?php endforeach ?>
		<?php endif ?>			
	</table>

</div>
