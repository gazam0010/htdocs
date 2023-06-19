<?php  if (count($msgs) > 0) : ?>
  <html>

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </html>


  	<?php foreach ($msgs as $msg) : ?>
  	  <div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $msg ?>
        </div>
</div>
  	<?php endforeach ?>
 
<?php  endif ?>