<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <title><?php echo $title;?></title>
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!-- External CSS -->
    <?php foreach($styles as $style) echo HTML::style($style), "\n";?>
    <!-- External Javascripts -->
    <?php foreach($scripts as $script) echo HTML::script($script), "\n";?>

	<script type="text/javascript">
	$(function() {
		$("#user_login").click(function()
		{
			$("#form_login").submit();
		});
		
		$('#password').bind('keypress', function(e) {
	        if(e.keyCode==13){
         		$("#form_login").submit();
	        }
		});
	});
	</script>
</head>
<body>
	<center>
	<?php echo $content;?>
</body>
</html>
