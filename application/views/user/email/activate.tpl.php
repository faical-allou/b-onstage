<html>
<body>
	<?php echo lang("signup_active_email_txt1") ?>
	<?=anchor('/user/activate/'. $id .'/'. $activation, lang("signup_active_email_txt2").$identity,array('style'=>'font-size:15px;font-family:Arial,sans-serif;font-weight:bold;color:#8e2c86;'))?>
	<br />	
	<?php echo lang("signup_active_email_txt3") ?>	
</body>
</html>