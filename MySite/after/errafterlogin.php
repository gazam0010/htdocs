
<?php  if (count($errors) > 0) : ?>
  <html>

     
  </html>


  	<?php foreach ($errors as $error) : ?>
  	  <div class="container">
<div id="myPopup" class="alert alert-danger alert-dismissible">
    <?php echo $error ?>
        </div>
</div>
  	<?php endforeach ?>
 
<?php  endif ?>