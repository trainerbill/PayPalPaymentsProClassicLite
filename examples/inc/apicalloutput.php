<script type="text/javascript">
    (function(d, s, id){
      var js, ref = d.getElementsByTagName(s)[0];
      if (!d.getElementById(id)){
        js = d.createElement(s); js.id = id; js.async = true;
        js.src = "//www.paypalobjects.com/js/external/paypal.js";
        ref.parentNode.insertBefore(js, ref);
      }
    }(document, "script", "paypal-js"));
</script>

<h3>Curl Call</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $endpoint ?> -d "<?php echo $sstring ?>" </div>

<h3>Submitted String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $sstring ?></div>

<h3>Submitted Decoded</h3>
<pre><?php print_r($svars); ?></pre>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $rstring ?></div>

<h3>Return Decoded</h3>
<pre><?php print_r($rvars); ?></pre>