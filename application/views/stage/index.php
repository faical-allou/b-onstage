<script type="text/javascript">
	var page = <?=$page?>;
	var per_page = <?=$per_page?>;
</script>

<div id="stage">
<!--	<div class="container_12">
		<div class="grid_12 mt-20 mb-20">		
 			<form action="" id="search-form-stage">
				<?=form_input($filter_name)?>
				<?=form_input($filter_location)?>
				<button type="submit" id="search-stage" class="ui-purple"><span aria-hidden="true" class="icon-search fs-16"></span></button>			
			</form>		
		</div>
		</div>
-->	
				
    <style type="text/css">
      html, body, #map-canvas { height: 300px;}
    </style>
    
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDcej0yq3y7ly-GiqDOe5hDhCDDzhhV3Z8">
    </script>
    <script type="text/javascript">

    function CenterParis(controlDiv, map) {

    	  // Set CSS for the control border
    	  var controlUI = document.createElement('div');
    	  controlUI.style.backgroundColor = '#8e2c86';
    	  controlUI.style.border = '2px solid #8e2c86';
    	  controlUI.style.borderRadius = '3px';
    	  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
    	  controlUI.style.cursor = 'pointer';
    	  controlUI.style.marginBottom = '20px';
    	  controlUI.style.marginRight = '5px';
    	  controlUI.style.textAlign = 'center';
    	  controlDiv.appendChild(controlUI);

    	  // Set CSS for the control interior
    	  var controlText = document.createElement('div');
    	  controlText.style.color = 'rgb(255,255,255)';
    	  controlText.style.fontFamily = 'Open Sans Condensed';
    	  controlText.style.fontSize = '16px';
    	  controlText.style.lineHeight = '38px';
    	  controlText.style.paddingLeft = '5px';
    	  controlText.style.paddingRight = '5px';
    	  controlText.innerHTML = " Paris ";
    	  controlUI.appendChild(controlText);

    	  // Setup the click event listeners: simply set the map to
    	  // Paris
    	  google.maps.event.addDomListener(controlUI, 'click', function() {
    	    map.setCenter(new google.maps.LatLng(48.8588589,2.3470599));
    	    map.setZoom(11)
    	  });

    	};
    
    	   function CenterBerlin(controlDiv, map) {

    	    	  // Set CSS for the control border
    	    	  var controlUI = document.createElement('div');
    	    	  controlUI.style.backgroundColor = '#8e2c86';
    	    	  controlUI.style.border = '2px solid #8e2c86';
    	    	  controlUI.style.borderRadius = '3px';
    	    	  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
    	    	  controlUI.style.cursor = 'pointer';
    	    	  controlUI.style.marginBottom = '20px';
    	    	  controlUI.style.marginRight = '5px';
    	    	  controlUI.style.textAlign = 'center';
    	    	  controlDiv.appendChild(controlUI);

    	    	  // Set CSS for the control interior
    	    	  var controlText = document.createElement('div');
    	    	  controlText.style.color = 'rgb(255,255,255)';
    	    	  controlText.style.fontFamily = 'Open Sans Condensed';
    	    	  controlText.style.fontWeight = 'bold';
    	    	  controlText.style.fontSize = '16px';
    	    	  controlText.style.lineHeight = '38px';
    	    	  controlText.style.paddingLeft = '5px';
    	    	  controlText.style.paddingRight = '5px';
    	    	  controlText.innerHTML = 'Berlin';
    	    	  controlUI.appendChild(controlText);

    	    	  // Setup the click event listeners: simply set the map to
    	    	  // Berlin
    	    	  google.maps.event.addDomListener(controlUI, 'click', function() {
    	    	    map.setCenter(new google.maps.LatLng(52.5075419,13.4251364));
    	    	    map.setZoom(11)
    	    	  });

    	    	};
    	

    
    function initialize() {

    	var MY_MAPTYPE_ID = 'custom_style';
        var mapOptions = {
          center: new google.maps.LatLng(50.957245, 6.9673223),
          zoom:5,
          scrollwheel: false,
          zoomControl: true,
          zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE
          },
          streetViewControl: false,
          mapTypeId: MY_MAPTYPE_ID,
        };

        var featureOpts = [
                            {
                            featureType: 'road.highway',
                            elementType: 'all',
                             stylers: [
                               { hue: '#ffffff' },
                               { saturation: 0 },
                               { visibility: 'off' },
                               { gamma: 1.0 },
                               { weight: 1 },                             
                             ]
                            
                            },{
                                featureType: 'water',
                                elementType: 'all',
                                 stylers: [
                                   { hue: ' ' },
                                   { saturation: -50 },
                                   { visibility: 'simplified' },
                                   { lightness: 80 },
                                   { weight: 1 },                             
                                 ]
                                
                                }
                          ]

        var styledMapOptions = {
        	    name: 'Custom Style'
       	};
        
        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
		
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
        
/*      var pinColor = "8e2c86";
        var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
            new google.maps.Size(21, 34),
            new google.maps.Point(0,0),
            new google.maps.Point(10, 34));
        var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
            new google.maps.Size(40, 37),
            new google.maps.Point(0, 0),
            new google.maps.Point(12, 35));
*/
        
        var locations = [
                         ['<a target="_blank" href=/Valentinstueberl?t=map><strong>Valentin Stüberl</strong></a>', 52.483214,13.434167, 1],
                         ['<a target="_blank" href=/Schnapphahn?t=map><strong>Schnapphahn</strong></a>', 52.500851,13.417273, 2],
                         ['<a target="_blank" href=/liesl?t=map><strong>Liesl</strong></a>', 52.46897,13.43136, 3],
                         ['<a target="_blank" href=/Leuchtstoff?t=map><strong>Leuchtstoff</strong></a>', 52.468121,13.432597, 4],
                         ['<a target="_blank" href=/WilhelmTell?t=map><strong>Wilhelm Tell</strong></a>', 52.477414,13.42377, 5],
                         ['<a target="_blank" href=/Werkstadt?t=map><strong>WerkStadt Kulturverein Berlin e.V.</strong></a>', 52.469078,13.436226, 6],
                         ['<a target="_blank" href=/Langenacht?t=map><strong>Lange Nacht</strong></a>', 52.47877,13.423351, 7],
                         ['<a target="_blank" href=/Froschkoenig?t=map><strong>FroschKönig</strong></a>', 52.476803,13.423846, 8],
                         ['<a target="_blank" href=/amalia?t=map><strong>Amalia</strong></a>', 52.470061,13.43699, 9],
                         ['<a target="_blank" href=/laika?t=map><strong>Laika</strong></a>', 52.469268,13.438026, 10],
                         ['<a target="_blank" href=/Kuerbishuette?t=map><strong>Kürbishütte 1905</strong></a>', 52.50908,13.45599, 11],
                         ['<a target="_blank" href=/cubemoabeat?t=map><strong>cube moa:beat</strong></a>', 52.525691,13.319942, 12],
                         ['<a target="_blank" href=/untertitel?t=map><strong>Untertitel</strong></a>', 52.47738,13.43544, 13],
                         ['<a target="_blank" href=/KeuleBerlinerMundart?t=map><strong>Keule Berliner Mundart</strong></a>', 52.508471,13.455218, 13],
                         

                         ['<a target="_blank" href=/leplaytime?t=map><strong>le Playtime</strong></a>', 48.84096,2.370422, 14],
                         ['<a target="_blank" href=/lebluenote?t=map><strong>Le Blue Note</strong></a>', 48.8867591,2.3464823, 15],
                         ['<a target="_blank" href=/orphee?t=map><strong>Orphée</strong></a>', 48.880978,2.33437, 16],
                         ['<a target="_blank" href=/lerosie?t=map><strong>Le Rosie</strong></a>', 48.886752,2.347134, 17],
                         
                       ];
        
        var infowindow = new google.maps.InfoWindow();
        var marker, j;
        
              
        for (j = 0; j < locations.length; j++) {  
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[j][1],locations[j][2]),
              map: map,
//              icon: pinImage,
//              shadow: pinShadow
              })

            google.maps.event.addListener(marker, 'click', (function(marker, j) {
            	                
                return function() {
                infowindow.setContent(locations[j][0]);
                infowindow.open(map, marker);

                map.setZoom(15);
                map.panTo(marker.getPosition());
                
              }
            })(marker, j));

                
        }; 

              // Create the DIV to hold the control and
              // call the CenterControl() constructor passing
              // in this DIV.
              var centerControlDiv1 = document.createElement('div');
              var centerControlDiv2 = document.createElement('div');
              
              var centerParis = new CenterParis(centerControlDiv1, map);
              var centerBerlin = new CenterBerlin(centerControlDiv2, map);
              
              centerControlDiv1.index = 1;
              centerControlDiv2.index = 2;
              
              map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv1);
              map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv2);
              
              
          };

         
          
        google.maps.event.addDomListener(window, 'load', initialize);

       
    </script>
					
	<div class="container_12">	
		<div id="map-canvas" class= "grid_12 mt-30"></div>
		
		<div class="grid_9 mb-20 mt-20">	
			<!--artists list-->
			<div class="bs-black">
				<div class="fs-16 p-10 white title bg-black ui-corner-top"><?php echo lang("stages_searchresutls") ?></div> 
				<div id="stages-list">
					<?=$stages_list?>
				</div>	
			</div>	
			
			<!--show more artists-->
			<?php if($nb_pages > 1) {?>
			<div class="mt-20">
				<button id="show-more-stages" style="width:100%;"><?php echo lang("stages_searchshowmore") ?></button>
				<div id="loader-more-stages" style="display:none;" class="p-10 ta-c">
					<?=img(site_url('img/loader/1.gif'))?>
				</div>
			</div>
			<?php } ?>
			
			<!--pager-->
			<div style="display:none;">
				<ul>
					<?php
					$i = 1;
					for($i=1; $i<=$nb_pages; $i++) 
						echo '<li>'.anchor(site_url('stages/'.$i), $i).'</li>';
					?>	
				</ul>
			</div>
		</div>
		<?php echo $social_sidebar ?>

	</div>	

</div>