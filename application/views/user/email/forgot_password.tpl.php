<html>
<body>
	<h1><?php echo lang("forgot_password_email1_txt1"); ?> <?php echo $identity;?></h1>
	<p><?php echo lang("forgot_password_email1_txt2"); ?> <?php echo anchor('user/reset_password/'. $forgotten_password_code, lang("forgot_password_email1_txt3"));?>.</p>
</body>
</html>