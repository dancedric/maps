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
          console.log(results);
          var marker = new google.maps.Marker({
              map: map, 
              position: results[0].geometry.location,
              icon: 'http://fourthdraft.com/maps/img/marker.png'
          });

          google.maps.event.addListener(marker, "click", function(e) {
            var infowindow = new google.maps.InfoWindow({
              content: '<div id="content">'+results[0].formatted_address+'<br/><strong class="small">To delete this pin, double click it</strong></div>'
            });
            infowindow.open(map, marker);
          });

          marker.addListener("dblclick", function(e) {
            marker.setMap(null);
            $("#plotted-list li").each(function(k,v) {
              console.log( $(v).data("lng") );
              console.log( e.latLng.lng());
              if( $(v).data("lat") == e.latLng.lat() && $(v).data("lng") == e.latLng.lng() ) {
                $(v).remove();
              }
            });
            
          });

          if( ('#plotted-list .default').length > 0) $('#plotted-list .default').remove(); 
          $('#plotted-list').append('<li data-lat="'+results[0].geometry.location.lat()+'" data-lng="'+results[0].geometry.location.lng()+'">'+results[0].formatted_address.substr(0,30)+'</li>');
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