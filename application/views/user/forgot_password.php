<h1><?php echo lang("forgot_header") ?></h1>
<p><?php echo lang("forgot_txt") ?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("user/forgot_password");?>

      <p><?php echo lang("identity") ?>:<br />
      <?php echo form_input($email);?>
      </p>
      
      <p><?php echo form_submit('submit', lang("submit"));?></p>
      
<?php echo form_close();?>