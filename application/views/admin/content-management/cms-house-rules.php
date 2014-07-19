<?php
$content = NULL;
$name = "House rules";
include(__DIR__.'/../../header.php');
include(__DIR__.'/../navbar.php');
if ( !is_null($rules) ) {
	$content = $rules[0]->content;
}
?>

<div class="container">
    <div class="jumbotron">
    <?php include(__DIR__.'/../../messages.php'); ?>
    <h1>House rules</h1>
    <?=form_open('contentmanagement/house_rules')?>
    	<div class="form-group">
    		<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"><?=$content?></textarea>
        </div>
        <div class="form-group">
        	<button name="house-rules" class="btn btn-primary btn-sm pull-right">Submit</button>
        </div>
    <?=form_close()?>
</div>

</div>

<?php include(__DIR__.'/../../footer.php'); ?>