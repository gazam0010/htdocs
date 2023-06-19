<head>
  <style>
    .head-mode {
      background-color: lightsteelblue;
      border: 1px solid;
    }
  </style>
</head>

<?php if (isset($_SESSION['head_mode'])) : ?>
  <div class="head-mode">
    <p style="font-size: 15px; font-weight: 900;" align="center">Head Mode</p>
    <p align="center">Hello, <strong><?php echo $_SESSION['head_mode']; ?></strong>.
      <a href="<?php echo $_SESSION['return']; ?>">Click Here</a> to return to the Users Section (Administrator Panel).</p>
  </div>
<?php endif ?>
