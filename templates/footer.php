<footer class="footer">
    <div class="container">
        <div class="text-center">Kik or not &copy; 2016<br />We are not affiliated with or endorsed by Tinder or Kik.</div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  <script type="text/javascript">$(document).bind("mobileinit", function(){$.extend(  $.mobile , {autoInitializePage: false})});</script>
  <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <?php if(Main::loggedIn()):?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<script>
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });

var seed = <?php echo User::userId();?>;

$(function() {
    $("#tinderslide ul ").on("swiperight", "li", function() {
                $(this).addClass('rotate-right').find('.yes').fadeTo( "fast", 0.90 );
                setTimeout(function() {
                    $('.rotate-right').remove();
                }, 500); // <-- time in milliseconds
            $.ajax({
                url: "./loadUsers?seed=1",
                dataType:"HTML",
                success: function(data) {
                 $("#tinderslide ul").prepend(data);
                }
            });
    });
    $("#tinderslide ul ").on("swipeleft", "li", function() {
                $(this).addClass('rotate-left').find('.no').fadeTo( "fast", 0.90 );
                setTimeout(function() {
                    $('.rotate-left').hide();
                }, 500); // <-- time in milliseconds
            $.ajax({
                url: "./loadUsers?seed=1",
                dataType:"HTML",
                success: function(data) {
                 $("#tinderslide ul").prepend(data);
                }
            });
    });
});

</script>
<?php endif; ?>
<script>
    // Preload configuration
    $( document ).on( "mobileinit", function() {
        $.mobile.autoInitializePage = false; // This one does the job
    });
</script>
</body>
</html>