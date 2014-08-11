<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<?php if ( isset($ckeditor) && $ckeditor == 1 ): ?>
	<script src="<?=base_url()?>assets/3rd-party/ckeditor-dev/ckeditor.js"></script>
<?php endif; ?>
<script>
var config = {
	doc      : $(document),
	base_url : '<?=base_url()?>',
	cookie   : '<?=$this->security->get_csrf_hash()?>',
}
</script>
<script src="<?=base_url()?>assets/scripts/global.js"></script>
</body>
</html>