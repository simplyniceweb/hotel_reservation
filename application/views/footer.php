<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
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