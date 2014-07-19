<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
$content = NULL;
if ( !is_null($rules) ) {
	$content = $rules[0]->content;
}
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
    <header style="padding: 20px"><?=$content?></header>
</div>

<?php include(__DIR__.'/../footer.php'); ?>