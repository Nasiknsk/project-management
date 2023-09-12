
<script type="text/javascript">
    var answer = confirm('Are you sure?');

    if(answer==true)
       {
          <?php $confirmation = 1; ?>
       } 
    else 
       { 
          <?php define("CONFIRMATION", 1, true); ?>
       }
         alert('<?php echo $confirmation; ?>')
         alert('<?php echo defined("CONFIRMATION"); ?>')
</script>
