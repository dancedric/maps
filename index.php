<!DOCTYPE html>
<html>
	<head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
      <link rel="stylesheet" href="/maps/css/style.css" />
      <link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
      <title>Travelmap - Plot your travels on the map | Fourthdraft</title>
      <meta name="description" content="Love travelling? Plot the places you have been or you'd want to go to! Screenshot it, share it, or make it your wallpaper to motivate you!">
      <meta property="og:title" content="Plot the places you've been to around the world!"/>
      <meta property="og:image" content="http://fourthdraft.com/maps/img/og_square.jpg"/>
      <meta property="og:site_name" content=""/>
      <meta property="og:description" content="Have you or do you plan to travel the world? Plot your plans in your own world map! Share it with your friends"/>
    <title>Plot your adventures in your world map!</title>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-24426379-4', 'auto');
        ga('send', 'pageview');

      </script>
      
  </head>
  <body>
      

      <div class="container-fluid">
      <header>
        <a href="#menu" class="menu-link" data-toggle="popover" title="Start here!" data-content="Click me to start plotting locations" data-placement="bottom">&#9776;</a>
        <nav id="menu" class="panel" role="navigation">
            
            <!-- COUNTRIES DROPDOWN -->
            <section>
              <h4>Add a location</h4>
              <form id="addLocationForm">
                <div class="input-group">
                  <input type="text" id="addLocation" name="addLocation" class="form-control" placeholder="Type country, city, name of any place">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" type="button" id="addLocationBtn">Go!</button>
                  </span>
                </div>
                <p class="small">E.g.: Germany, Qu&eacute;bec, Taj Mahal</p>
              </form>
            </section>
            
            <section>
              <h4>Plotted on the map</h4>
                <ul id="plotted-list">
                  <li class="default">Start by entering one above!</li>
                </ul>
            </section>

            <section>
              <h4>Save</h4>
              <p>Honestly, we don't really have a save feature right now. We suggest you screenshot this :) The developer did this on a whim; days before he flies to Copenhagen J</p>
            </section>
            <section><h4><a target="_blank" onclick="ga('send', 'event', 'Share', 'button', 'Side nav', '1');" href="https://www.facebook.com/dialog/share?app_id=214119531962001&display=popup&href=http%3A%2F%2Ffourthdraft.com%2Fmaps%2F&redirect_uri=http%3A%2F%2Ffourthdraft.com%2Fmaps%2F">Share in Facebook!</a></h4></section>
            <div class="small text-center"><a href="info@fourthdraft.com">info@fourthdraft.com</a></div>
        </nav>
      </header>
      </div>



    	<div id="map"></div>
    	<script type="text/javascript">
			var map;
			// Specify features and elements to define styles.
			var styleArray = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":30}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
			
			function initMap() {
        var z = 3;
        var default_map_width = 690;
  			map = new google.maps.Map(document.getElementById('map'), {
    				center: {lat:  30, lng: 0},
    				zoom: z,
    				styles: styleArray
  			});
        if( $(window).width() >= (map.getZoom() * default_map_width) ) $('#map').width( map.getZoom() * default_map_width);
          else $('#map').width( $(window).width() );

        $('#addLocationForm').submit( function(e) {
          e.preventDefault();
          codeAddress( $('#addLocation').val() );
          ga('send', 'event', 'Interaction', 'Add', 'Location', '1');
        });

        map.addListener('zoom_changed', function() {
          if( map.getZoom() != 0 ) {
            if( $(window).width() >= (map.getZoom() * default_map_width) ) $('#map').width( map.getZoom() * default_map_width);
            else $('#map').width( $(window).width() );
          }
        });

			}

      
	    </script>
    


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-show="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Create your own World Map background!</h4>
          </div>
          <div class="modal-body text-center">
            
            <h4>Plot the places you've been! <br/>Share it with your friends! <br/>Screenshot it and make it your desktop background!</h4>
            <h4>Click the menu icon on the right.</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="promoModalLabel" data-show="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">It's Free! So is sharing! </h4>
          </div>
          <div class="modal-body text-center">
            
            <h4>Before you continue plotting away, we would truly appreciate it if you can take 3.47 seconds to just share it in your Facebook! Share the fun with your travel friends and buddies!</h4>
            <button class="btn btn-primary" data-dismiss="modal"><a target="_blank" onclick="ga('send', 'event', 'Share', 'Button', 'Modal - limit 3', '1');" href="https://www.facebook.com/dialog/share?app_id=214119531962001&display=popup&href=http%3A%2F%2Ffourthdraft.com%2Fmaps%2F&redirect_uri=http%3A%2F%2Ffourthdraft.com%2Fmaps%2F">Click here to share in Facebook!</button></a>
            <h5>Unlimited plotting awaits!</h5>
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-primary" data-dismiss="modal">Done!</button>-->
          </div>
        </div>
      </div>
    </div>


	<script src="/maps/js/jquery-2.1.4.min.js"></script>
  <script src="/maps/js/bootstrap.min.js"></script>
  <script src="/maps/js/bigSlide.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVBToCTkYvkkMRI7olgp1Ihen2e5JKxdA&callback=initMap"></script>

  <script>
    var ctr = 0;
    $(document).ready(function() {
      $('.menu-link').bigSlide({side:'right', easyClose: true, menuWidth:"20em"});
      $('#myModal').modal({show:true});
      $('#myModal').on('hidden.bs.modal', function(e) {
        setTimeout( function() {$('.menu-link').popover('show');}, 1000); setTimeout( function() {$('.menu-link').popover('hide');$('.menu-link').popover('destroy')}, 6000); 
      });

      $('#promoModal').on('hide.bs.modal', function (e) {
        console.log('hiding');
        ga('send', 'event', 'Share', 'Button', 'Modal - limit 3', '1');
        openInNewTab('https://www.facebook.com/dialog/share?app_id=214119531962001&display=popup&href=http%3A%2F%2Ffourthdraft.com%2Fmaps%2F&redirect_uri=http%3A%2F%2Ffourthdraft.com%2Fmaps%2F');
      })
    });

    function codeAddress(address) {
      var geocoder =  new google.maps.Geocoder();
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var marker = new google.maps.Marker({
              map: map, 
              position: results[0].geometry.location,
              icon: 'http://fourthdraft.com/maps/img/marker.png'
          });
          if( ('#plotted-list .default').length > 0) $('#plotted-list .default').remove(); 
          $('#plotted-list').append('<li>'+$('#addLocation').val()+'</li>');
          ctr++;
          if(ctr == 3) $('#promoModal').modal({show:true});
        } 
        else {
          console.log("Geocode was not successful for the following reason: " + status);
        }
      });
    }

    function openInNewTab(url) {
      var win = window.open(url, '_blank');
      win.focus();
    }


  </script>
	</body>
</html>