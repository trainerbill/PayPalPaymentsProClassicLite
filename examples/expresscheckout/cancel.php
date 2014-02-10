<?php 
include(__DIR__.'/../inc/header.php');
?>
You cancelled the order.

<script>
    (function(d, s, id){
      var js, ref = d.getElementsByTagName(s)[0];
      if (!d.getElementById(id)){
        js = d.createElement(s); js.id = id; js.async = true;
        js.src = "//www.paypalobjects.com/js/external/paypal.js";
        ref.parentNode.insertBefore(js, ref);
      }
    }(document, "script", "paypal-js"));
  </script>

   <script>
if (window != top) {
top.location.replace(document.location);
}
</script>
<?php include(__DIR__.'/../inc/footer.php');?>