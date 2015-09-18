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

</head>
<body>
    <div id="container">
        <div id="header">
            <div id="welcome">
                <span>Welcome, <?php echo $user_data->username;?></span> <span><a href="/auth/logout">[ Logout ]</a></span>
            </div>
        </div>
        <div id="content">
            <div id="sidebar">
			<ul>
				<?php 
					foreach ($menu as $m => $text):
				        echo '<li>'.HTML::anchor(URL::base().$m,$text ) .'</li>';
					endforeach;
				?>
            </ul>
            </div>
            <div id="contentMain">
            <h2><?php echo $subtitle;?></h2>
            <br />
            <?php echo $content;?>
            </div>
            <div class="clear">
            </div>
        </div>
        <!--footer -->
        <div id="footer">
          <span>
				HI - Hour Registration<br />
                Copyright &copy; 2011
			</span>
        </div>
    </div>
    <div id="dialog" title="Konfirmasi">
        <p>
            <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span>
            Apakah anda yakin akan menghapus data dengan id
            <span id="archieve_out_id"></span>
        </p>
    </div>
</body>
</html>
