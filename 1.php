<?php
if(isset($_POST['name']))
{
    $name = $_POST['name'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Msg Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <p align = "center"><?php echo 'Welcome ' .$name; ?></p>
    </body>
</html>
