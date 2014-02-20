<?php 
$url = 'getexpresscheckout.php?';
foreach($_GET as $key => $value)
{
	$url .= $key . '=' . $value . '&';
}

?>

<!-- Javascript to break the iframe and redirect to receipt.php -->
<script type="text/javascript">
  if (window!=top){top.location.href='<?php echo $url ?>';}
</script>