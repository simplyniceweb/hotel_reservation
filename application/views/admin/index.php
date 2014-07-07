<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/navbar.php');
?>

<div class="container">
    <div class="jumbotron">
    <h1><?php echo $this->config->item('website_name'); ?></h1>
    <p>You're viewing the dashboard of <?php echo $this->config->item('website_name'); ?>.</p>
    <p>Above is a menu where you can manage your rooms and transactions. Such as creating room type, room images and manage your payment types.</p>
    <p class="text-danger">Problems? Questions? <small class="text-warning">Email me: simplyniceweb@gmail.com</small></p>
</div>

</div>

<?php include(__DIR__.'/../footer.php'); ?>