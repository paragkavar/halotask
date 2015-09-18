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
<?php if(isset($edited)):?>
Saved
<?php endif?>
<div id="filterBox">
	<?php echo FORM::open(URL::base() . $controller.'/edit/'.$data->id, array('id' => 'form_user_edit')); ?>
    <?php echo FORM::hidden('id', $data->id); ?>
	<table width="80%" cellpadding="0" cellspacing="0">
		<tr>
			<td>Username</td>
			<td>:</td>
			<td>
				<?php echo FORM::input('username', $data->username, array('size' => '20')); ?>
				<?php echo (empty($errors['username']))?'': '<br />'.$errors['username']; ?>
			</td>
		</tr>
		<tr>
			<td>Fullname</td>
			<td>:</td>
			<td>
				<?php echo FORM::input('fullname', $data->fullname, array('size' => '50')); ?>
				<?php echo (empty($errors['fullname']))?'': '<br />'.$errors['fullname']; ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><?php echo FORM::input('password', $data->password, array('size' => '30')); ?>
				<?php echo (empty($errors['password']))?'': '<br />'.$errors['password']; ?>
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo FORM::input('email', $data->email, array('size' => '80')); ?>
				<?php echo (empty($errors['email']))?'': '<br />'.$errors['email']; ?>
			</td>
		</tr>
		<tr>
			<td width='18%'></td>
			<td width='2%'></td>
			<td>
                <div class="fLeft btnMargin"><?php echo HTML::anchor('user', html::image('images/cancel_btn_03.png', array('alt' => 'Cancel')));?></div>

                <div class="fLeft"><?php echo HTML::anchor('#', html::image('images/save_btn_06.png', array('alt' => 'Save', 'id' => 'save_user_edit' )));?></div>
			</td>
		</tr>
	</table>
	<?php echo FORM::close(); ?>
</div>

