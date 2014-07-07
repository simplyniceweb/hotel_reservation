<div class="contailer footer">
	<div class="sub-wrapper">
	<div class="col-sm-4">
    	<p class="title">Laiya coco grove</p>
		<p></p>
        <p>Km.20 Brgy. Laiya, Aplaya, San Juan, Batangas</p>
        <br/>
        <p>Site Office: (+63) 908 896-0776</p>
        <p>Makati Office: (+63) 908 896-0774 </p>
        <p>Tel. Nos. (+632) 894-1057 ; 892-6009</p>
        <p>Fax No. (+632) 894-1058</p>
        <p>
<div class="fb-like" data-href="https://www.facebook.com/LaiyaCocoGrove" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
        </p>
        <p><img src="<?=base_url()?>assets/icons/footer.png" class="img-responsive"/></p>
        <p>Laiya Beach Club, Inc. © 2013</p>
    </div>
	<div class="col-sm-4">
    	<p class="title">Special offers</p>
        <p>Get 5% discount for your first night and get 8% discount for the second night stay.</p>
		<p>Avail 10% Discount for foreign guests. Just present a copy of your passport to avail.</p>
        <p>Reasonable prices with discounts are available for big groups. Just give us a call and we’ll work on it.</p>
    </div>
	<div class="col-sm-4">
    	<p class="title">Partners</p>
        <p><img src="<?=base_url()?>assets/icons/partner1.jpg" class="img-responsive"/></p>
        <p><img src="<?=base_url()?>assets/icons/partner2.jpg" class="img-responsive"/></p>
    </div>
    </div>
</div>

<div id="fb-root"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/3rd-party/nivo-slider/jquery.nivo.slider.js"></script>
<?php if($active==2): ?>
<script src="<?=base_url()?>assets/3rd-party/datepicker/datepicker.js"></script>
<?php endif; ?>
<script>
var config = {
	doc      : $(document),
	base_url : '<?=base_url()?>',
	cookie   : '<?=$this->security->get_csrf_hash()?>',
}
</script>
<script src="<?=base_url()?>assets/scripts/interface.js"></script>
</body>
</html>