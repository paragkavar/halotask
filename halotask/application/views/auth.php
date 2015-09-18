<?php
/*
	File Name 		: auth.php
	Type			: View
	Author		: Samuel Oloan Raja Napitupulu
	Modified		: 22 October 2010
	Description	: use for viewing the login form (form_auth_login) for user login.
*/

$username = '';
$password = '';

if(isset($data)){
	$username = $data['username'];
	$password = $data['password'];
}
?>
<div>
<table cellpadding="0" cellspacing="0" width="390" align="center">
	<tr><td>
	<?php echo FORM::open(URL::base() . $controller . '/login/', array('id' => 'form_login')); ?>
		<div id="userlogin">
			<div id="loginform">
				<h1>Login</h1>
				<div id="formblock">
					<div id="inputlogin">Username</div>
					<div style="padding-top:5px;">
						<?php 
							echo FORM::input('username', $username, array('size' => '33'));
							echo (empty($errors['username']))?'': '<br />'.$errors['username']; 
						?>
				    </div>

					<div style="padding-top:5px;" id="inputlogin">Password</div>
					<div style="padding-top:5px;">
						<?php 
							echo FORM::password('password', $password, array('id'=>'password', 'size' => '33')); 
							echo (empty($errors['password']))?'': '<br />'.$errors['password']; 
						?>
					</div>
					
					<div style="padding-top:5px;">
						<?php echo FORM::checkbox('rememberUser', 'remember'); ?>remember me
					</div>
					<div>
						<font style='color:red; font-size:11px'>
							<?php echo (empty($errors['error_desc']))?'': $errors['error_desc'];  ?>
						</font>
					</div>						
					<div style="padding-top:9px;">
						<?php echo HTML::anchor('#', html::image('images/loginbtn_03.png', 
									array('alt' => 'login', 'id' => 'user_login' )));?></div>
					</div>
			</div>
			<div id="logintext" style="padding-right:10px">
				<div style="text-align:center;">
					<?php echo HTML::image('images/security.png', 
							array('alt'=> 'Login', 'title'=> 'Login'));?>
				</div>
				<p>Selamat Datang</p>
				<p>Silahkan masukkan Username dan Password Anda.</p>
			</div>
			<div style="clear:both"></div>
		</div>
		<?php echo FORM::close(); ?>
	</td></tr>
</table>	
</div>