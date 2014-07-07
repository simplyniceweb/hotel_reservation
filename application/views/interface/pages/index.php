<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
$thumb_label = array(
	'<span class="text-info">R</span>ECREATIONS',
	'<span class="text-info">C</span>ELEBRATIONS',
	'<span class="text-info">A</span>CTIVITIES',
);
?>

<div class="home-wrapper">
<div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
    <?php for($i=1;$i<14;$i++) { ?>
        <img src="<?=base_url()?>assets/images/slider/<?=$i?>.jpg" data-thumb="<?=base_url()?>assets/images/slider/<?=$i?>.jpg" alt="" />
	<?php } ?>
    </div>
</div>
</div>

<div class="round white wrapper">
    <div class="row home-intro">
     <?php for($i=1;$i<4;$i++) { ?>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <h4 class="title"><?=$thumb_label[$i-1]?></h4>
            <img src="<?=base_url()?>assets/images/intro/<?=$i?>.jpg" alt="...">
            <div class="caption">
                <p>We have a white beach, swimming pool, pool table, table hockey and much more</p>
            </div>
        </div>
      </div>
	<?php } ?>
    </div>
	<div class="vimeo"><h1 class="title pad-md"><span class="text-info">Q</span>uick Tour</h1>
	<iframe src="//player.vimeo.com/video/73851468" width="500" height="281" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>