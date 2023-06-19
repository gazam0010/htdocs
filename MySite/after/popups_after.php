<?php if (isset($_SESSION['48e3ae0056e0c0dc97f70c4f29a4864c_login-success'])) : ?>
<div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
    <?php 
          	echo $_SESSION['48e3ae0056e0c0dc97f70c4f29a4864c_login-success']; 
          	unset($_SESSION['48e3ae0056e0c0dc97f70c4f29a4864c_login-success']);
          ?>
    
</div>
</div>
    <?php endif ?>
    
    
    
    
    
 <?php if (isset($_SESSION['signup-success'])) : ?>
<div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
    <?php 
          	echo $_SESSION['signup-success']; 
          	unset($_SESSION['signup-success']);
          ?>
    
</div>
</div>
    <?php endif ?>
    
    <?php if (isset($_SESSION['reset-success'])) : ?>
<div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
    <?php 
          	echo $_SESSION['reset-success']; 
          	unset($_SESSION['reset-success']);
          ?>
    
</div>
</div>
    <?php endif ?>

