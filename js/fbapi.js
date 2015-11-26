    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '439461819588719',
          xfbml      : true,
          version    : 'v2.5'
        });

        FB.getLoginStatus(function(response) {
        console.log(response);  
        statusChangeCallback(response);
        });

      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));

      
    </script>