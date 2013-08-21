<div id="content">	
	<ul class="breadcrumb">
		<li><a href="<?=site_url('admin')?>">Home</a> <span class="divider">/</span></li>
		<li><a href="<?=site_url('stage')?>">Stages</a> <span class="divider">/</span></li>
		<li class="active">Form add stage</li>
    </ul>
	
	<div class="p-20">
		<form action="<?=site_url('stage/add')?>" method="post" id="form-add-stage">		
			<!--identification-->
			<fieldset>
				<legend class="blue">Stage identification</legend>			
				<!--username-->
				<label><?=$label_username?></label>
				<?=form_input($username)?><?=form_error($username['name'])?>
				
				<!--email-->
				<label><?=$label_email?></label>
				<?=form_input($email).form_error($email['name'])?>
				
				<!--password-->
				<label><?=$label_password?></label>
				<?=form_password($password).form_error($password['name'])?>
				
				<!--confirm password-->
				<label><?=$label_password_confirm?></label>
				<div><?=form_password($password_confirm).form_error($password_confirm['name'])?></div>
			</fieldset>	
			
			<!--stage infos-->
			<fieldset>
				<legend class="blue">Stage informations</legend>
				<!--company-->
				<label><?=$label_company?></label>
				<?=form_input($company).form_error($company['name'])?>
				
				<!--address-->
				<label><?=$label_address?></label>
				<?=form_input($address).form_error($address['name'])?>
				
				<!--zip-->
				<label><?=$label_zip?></label>
				<?=form_input($zip).form_error($zip['name'])?>
				
				<!--city-->
				<label><?=$label_city?></label>
				<?=form_input($city).form_error($city['name'])?>
				
				<!--country-->
				<label><?=$label_country?></label>
				<?=form_input($country).form_error($country['name'])?>
                
                <!--lang-->
				<?php //Include lang config file
				include("/home/bonstage/trans.b-onstage/application/config/lang.php");
				
				?><label><?=$label_stagelang?></label>
				<select name="stagelang" id="stagelang">
                    <option value="">*****Choose a language*****</option>
                    <?php 
					foreach($lang_counts as $key => $value){
					?><option value="<?php echo $value["name"] ?>" <?php if(isset($_POST["stagelang"]) && $_POST["stagelang"] == $value["name"]){ ?>selected="selected"<?php }  ?>><?php echo $value["name"] ?></option><?php 
					}
					?>
                </select>
				<?=form_error($stagelang['name'])?>
			</fieldset>	
			
			<!--stage contact-->
			<fieldset>
				<legend class="blue">Stage contact</legend>
				<!--first_name-->
				<label><?=$label_first_name?></label>
				<?=form_input($first_name).form_error($first_name['name'])?>
				
				<!--last_name-->
				<label><?=$label_last_name?></label>
				<?=form_input($last_name).form_error($last_name['name'])?>
				
				<!--phone-->
				<label><?=$label_phone?></label>
				<?=form_input($phone).form_error($phone['name'])?>
			</fieldset>	
			
			
			<button type="submit" class="btn btn-primary btn-large">Add stage</button>
		
		</form>	
	</div>
</div>	