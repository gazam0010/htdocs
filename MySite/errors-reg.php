<?php  if (count($errors_reg) > 0) : ?>
  <html>
      <script>
        window.onload=function(){
        document.getElementById("mysBtn").click();
        };
    </script>
  </html>

  <div class="errorreg">
  	<?php foreach ($errors_reg as $error_reg) : ?>
  	  <p><?php echo $error_reg ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>