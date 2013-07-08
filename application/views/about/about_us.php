<div class="container_12">
	<div class="grid_12 bg-white bs-black ui-corner-all mt-20 mb-20">		
		<div class="p-r">
			<?=img(array('src' => site_url('img/about-us.jpg'), 'class'=> 'ui-corner-top', 'width' => '100%'))?>
			<ul id="about-menu">
				<li><?=anchor(site_url('about'), 'A propos', array('id' => 'about-menu-1'))?></li>
				<li><?=anchor(site_url('about_us'), 'Qui sommes-nous ?', array('id' => 'about-menu-2'))?></li>
				<li><?=anchor(site_url('how_does_this_work'), 'Comment ça marche ?', array('id' => 'about-menu-3'))?></li>
			</ul>		
		</div>
		<div class="about">	
			<?=heading('Qui sommes-nous ?', 2, 'class="fs-24 title grey"')?>
			<ul class="about-list mb-20">
				<li><p class="grey fs-15">Musiciens et programmeurs, nous avons créé notre compagnie, Mybandonstage, afin de promouvoir toutes les créations artistiques amateures.</p></li>		
				<li><p class="grey fs-15">Nous avons conçu</strong> afin de <strong>mettre en contact les Artistes avec leur public</strong> en facilitant leurs démarches pour <strong>organiser des concerts.</strong></p></li>	
				<li><p class="grey fs-15"><strong>Nous visitons toutes les Scènes</strong> (qui sont des établissements partenaires de b-onstage), nous prenons les photos et nous les référençons avec leurs descriptions pour assurer qu’<strong>on vous offre ce qu’on vous promet.</strong></p></li>
				<li><p class="grey fs-15">En prenant en charge les transactions financières, <strong>nous garantissons que les paiements seront conformes.</strong></p></li>
				<li><p class="grey fs-15">Nous proposons <strong>pour chaque concert des contrats spécialisés</strong> pour limiter les responsabilités équitablement et équilibrer les relations entre tous les intervenants.</p></li>	
				<li><p class="grey fs-15">Nous assurons <strong>le suivi de tous nos partenaires et de tous les Artistes</strong>, nous répondons à tous les messages que nous recevons et nous sommes prêts à intervenir auprès de tous les organismes pour vous soutenir.</p></li>
			</ul>			
		</div>	
	</div>
</div>

<script>
	var about_menu_id = 'about-menu-2';
</script>