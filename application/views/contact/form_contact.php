<h1 class="title fs-24 m-0 purple pb-10"><?php echo lang("footer_contactus") ?></h1>
<form id="form-contact">
	<div class="mb-20">
		<div class="mb-5">
			<label for="form-contact-name" class="fs-12 grey bold ts-white pl-2"><?php echo lang("contactus_yourname") ?></label>								
		</div>
		<div>
			<input type="text" id="form-contact-name" name="form-contact-name" class="input ui-corner-all fs-13 required" />
		</div>
	</div>
	<div class="mb-20">
		<div class="mb-5">
			<label for="form-contact-email" class="fs-12 grey bold ts-white pl-2"><?php echo lang("contactus_youremail") ?></label>								
		</div>
		<div>
			<input type="text" id="form-contact-email" name="form-contact-email" class="input ui-corner-all fs-13 required email"/>
		</div>
	</div>
	<div class="mb-20 clearfix">	
		<div class="left">
			<select id="form-contact-subject-1" name="form-contact-subject-1" class="required">				
					<option value="none"><?php echo lang("contactus_subject_1") ?></option>
					<option value="question"><?php echo lang("contactus_subject_2") ?></option>
					<option value="remarque"><?php echo lang("contactus_subject_3") ?></option>
					<option value="probleme"><?php echo lang("contactus_subject_4") ?></option>
					<option value="urgence"><?php echo lang("contactus_subject_5") ?></option>
					<option value="plainte"><?php echo lang("contactus_subject_6") ?></option>
			</select>				
		</div>	
		<div class="right">
			<select id="form-contact-subject-2" name="form-contact-subject-2" class="required">				
				<option value="none"><?php echo lang("contactus_subject2_1") ?></option>
				<option value="site"><?php echo lang("contactus_subject2_2") ?></option>
				<option value="inscription"><?php echo lang("contactus_subject2_3") ?></option>
				<option value="compte"><?php echo lang("contactus_subject2_4") ?></option>
				<option value="demande-reservation"><?php echo lang("contactus_subject2_5") ?></option>
				<option value="concert"><?php echo lang("contactus_subject2_6") ?></option>
				<option value="frais reservation"><?php echo lang("contactus_subject2_7") ?></option>
				<option value="annulation-reservation"><?php echo lang("contactus_subject2_8") ?></option>
				<option value="annulation-concert"><?php echo lang("contactus_subject2_9") ?></option>
				<option value="autre-chose"><?php echo lang("contactus_subject2_10") ?></option>				
			</select>										
		</div>	
	</div>						
	<div>
		<div class="mb-5">
			<label for="form-contact-message" class="fs-12 grey bold ts-white pl-2"><?php echo lang("contactus_yourmsg") ?></label>								
		</div>
		<div>
			<textarea id="form-contact-message" class="input fs-13 ui-corner-all required"></textarea>
		</div>
	</div>			
</form>
<div id="form-contact-response" class="bg-white fs-12 bold p-5 mt-10 mr-20 ui-corner-all hidden"></div>