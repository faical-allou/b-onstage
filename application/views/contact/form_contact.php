<h1 class="title fs-24 m-0 purple pb-10">Contactez-nous</h1>
<form id="form-contact">
	<div class="mb-20">
		<div class="mb-5">
			<label for="form-contact-name" class="fs-12 grey bold ts-white pl-2">Votre nom</label>								
		</div>
		<div>
			<input type="text" id="form-contact-name" name="form-contact-name" class="input ui-corner-all fs-13 required" />
		</div>
	</div>
	<div class="mb-20">
		<div class="mb-5">
			<label for="form-contact-email" class="fs-12 grey bold ts-white pl-2">Votre email</label>								
		</div>
		<div>
			<input type="text" id="form-contact-email" name="form-contact-email" class="input ui-corner-all fs-13 required email"/>
		</div>
	</div>
	<div class="mb-20 clearfix">	
		<div class="left">
			<select id="form-contact-subject-1" name="form-contact-subject-1" class="required">				
					<option value="none">J'ai ...</option>
					<option value="question">J'ai une question</option>
					<option value="remarque">J'ai une remarque</option>
					<option value="probleme">J'ai un problème</option>
					<option value="urgence">J'ai une urgence</option>
					<option value="plainte">J'ai une plainte</option>
			</select>				
		</div>	
		<div class="right">
			<select id="form-contact-subject-2" name="form-contact-subject-2" class="required">				
				<option value="none">Au sujet de ...</option>
				<option value="site">Au sujet du site</option>
				<option value="inscription">Au sujet de mon inscription</option>
				<option value="compte">Au sujet de mon compte</option>
				<option value="demande-reservation">Au sujet de ma demande de réservation</option>
				<option value="concert">Au sujet de mon concert</option>
				<option value="frais reservation">Au sujet des frais de réservaiton</option>
				<option value="annulation-reservation">Au sujet d'annulation de réservation</option>
				<option value="annulation-concert">Au sujet d'annulation de concert</option>
				<option value="autre-chose">Au sujet d'autre chose</option>				
			</select>										
		</div>	
	</div>						
	<div>
		<div class="mb-5">
			<label for="form-contact-message" class="fs-12 grey bold ts-white pl-2">Votre message</label>								
		</div>
		<div>
			<textarea id="form-contact-message" class="input fs-13 ui-corner-all required"></textarea>
		</div>
	</div>			
</form>
<div id="form-contact-response" class="bg-white fs-12 bold p-5 mt-10 mr-20 ui-corner-all hidden"></div>