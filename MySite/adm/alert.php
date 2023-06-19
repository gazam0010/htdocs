<?php if (isset($_GET['req_return']) && isset($_GET['status'])) : ?>

    <!--IF ERROR-->

    <?php if ($_GET['status'] == 0) : ?>
        <div class="msg">

            <div class="msg-container w3-round w3-card-4 w3-red">
                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <?php echo $_GET['req_return']; ?>

            </div>
            <br>

        </div>

    <?php endif ?>

    <!--IF SUCCESS-->


    <?php if ($_GET['status'] == 1) : ?>

        <div class="msg">


            <div class="msg-container w3-card-4 w3-green">
                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <?php echo $_GET['req_return']; ?>
            </div>
        </div>

    <?php endif ?>
<?php endif ?>


<?php if (count($errors) > 0) : ?>
    <html>


    </html>


    <?php foreach ($errors as $error) : ?>
        <div class="msg">

            <div class="msg-container w3-card-4 w3-red">
            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
                <?php echo $error ?>
            </div>
        </div>
    <?php endforeach ?>

<?php endif ?>