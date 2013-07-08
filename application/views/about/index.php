<div class="container_12">
	<div class="grid_12 bg-white bs-black ui-corner-all mt-20 mb-20">		
		<div class="p-r">
			<?=img(array('src' => site_url('img/about.jpg'), 'class'=> 'ui-corner-top', 'width' => '100%'))?>
			<ul id="about-menu">
				<li><?=anchor(site_url('about'), 'A propos', array('id' => 'about-menu-1'))?></li>
				<li><?=anchor(site_url('about_us'), 'Qui sommes-nous ?', array('id' => 'about-menu-2'))?></li>
				<li><?=anchor(site_url('how_does_this_work'), 'Comment ça marche ?', array('id' => 'about-menu-3'))?></li>
			</ul>		
		</div>	
		<div class="about">
			<?=heading('Pourquoi b-onstage ?', 2, 'class="fs-24 title grey"')?>
			<ul class="about-list mb-20">
				<li><p>Parce qu’à l’heure d’Internet et du téléchargement de masse, <strong>les liens entre les Artistes et le public ont été coupés.</strong></p></li>
				<li><p>Parce que l’industrie de la musique est en crise et que la vente de disque ne suffit plus <strong>pour vivre de son art.</strong></p></li>
				<li><p>Parce que la musique n’est pas seulement une partition, mais aussi un univers et une atmosphère à partager.</p></li>
				<li><p>Parce que la musique a toujours été, doit et devra toujours être une relation privilégiée avec le public.</p></li>
				<li><p>Et parce qu’enfin, <strong>la vrai musique c’est le live</strong>, les Concerts, la Scène.</p></li>
			</ul>
			<?=heading('Et maintenant ?', 2, 'class="fs-24 title grey"')?>
			<ul class="about-list mb-20">
				<li><p>Il est temps qu'Internet se mette au service des musiciens.</p></li>
				<li><p>Il est temps que les groupes rencontrent leur public.</p></li>
			</ul>
			<?=heading(anchor(site_url('signup_choice'),'Inscrivez-vous', array('class' => 'purple')).' sur b-onstage et à vous de jouer !', 2, 'class="fs-24 title grey"')?>	
		</div>
	</div>		
</div>
<script>
	var about_menu_id = 'about-menu-1';
</script>