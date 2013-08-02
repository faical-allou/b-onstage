<h1 class="title fs-24 m-0 purple pb-10"><?php echo lang("footer_contactus") ?></h1>
<form id="form-msg">	
	<div class="mb-20">
		<div class="mb-5">
			<label for="form-msg-subject" class="fs-12 grey bold ts-white pl-2"><?php echo lang("contactus_subject") ?></label>								
		</div>
		<div>
			<input type="text" id="form-msg-subject" name="form-msg-subject" class="input ui-corner-all fs-13 required"/>
		</div>
	</div>
	
	<div>
		<div class="mb-5">
			<label for="form-msg-message" class="fs-12 grey bold ts-white pl-2"><?php echo lang("contactus_message") ?></label>								
		</div>
		<div id="form-msg-message" class="required"></div>
	</div>	
</form>
<div id="form-msg-response" class="bg-white fs-12 bold p-5 mt-10 mr-20 ui-corner-all hidden"></div>
<!--redactor-->
<link rel="stylesheet" type="text/css" href="<?=site_url('js/redactor/redactor.css')?>" />