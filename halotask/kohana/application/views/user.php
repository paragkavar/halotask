<div class="fLeft">
	<?php echo HTML::anchor(URL::base() . $controller . '/new', HTML::image('images/newbtn_03.png', array('alt' => 'new'))); ?>
</div>
<div><?php echo $page_links;?></div>
<div class="clear"></div>

<table width="100%" cellpadding="0" cellspacing="0">
	<tr>	
		<th width="90%">Name</th>
		<th width="5%"></th>
	</tr>
	<?php
	$i = 1;
	foreach( $user_result as $users ): 
		$style = ( $i % 2 == 0 ) ? 'row2' : 'row1';
	?>
	<tr class="<?php echo $style; ?>">
		<td><?php echo $users->fullname; ?></td>
		<td><?php echo HTML::anchor(URL::base() . $controller . '/edit/' 	. $users->id, HTML::image('images/edit.png', array('alt' => 'edit'))); ?><?php echo HTML::anchor(URL::base() . $controller . '/delete/' 	. $users->id, HTML::image('images/delete.png', array('alt' => 'Delete', 'class' => 'delete', 'id' => 'delete'))); ?></td>
	</tr>
	<?php 
	$i++;
	endforeach; 
	?>
	<tr>
		<td></td>
		<td width='15%'></td>
		<td width='8%'></td>
		<td width='8%'></td>
		<td width='8%'></td>
	</tr>
</table>
