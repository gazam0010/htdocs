<?php  if (count($errors) > 0) : ?>
  <html>
    <script>
        window.onload=function(){
        document.getElementById("myBtn").click();
        };
    </script
  </html>

  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>