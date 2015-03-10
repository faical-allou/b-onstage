<?php 

?><html>
<body>
	<h1 style="font-size:18px;font-family:'Arial',sans-serif;color:#8e2c86;"><?php echo $hello ?> <?=$pseudo?>,</h1>
	<?php echo $txt1 ?>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo $username ?> :</strong><?=$email?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo $passwordtxt ?> :</strong><?=$password?></p>
	<br />
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;"><?php echo $txt2 ?> <a href="<?=$url_profil?>" style="color:#8e2c86;"><strong><?php echo $clickhere ?></strong></a></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><?php echo $txt3 ?> <a href="<?=$url_work?>" style="color:#8e2c86;"><strong><?php echo $clickhere ?></strong></a></p>	
	<?php echo $txt4 ?>
</body>
</html>	