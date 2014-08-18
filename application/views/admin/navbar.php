<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=base_url()?>admin"><?=$this->config->item('website_name')?></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?=base_url()?>admin">Home</a></li>
        <?php if ($this->session->userdata('logged')) { ?>
        <li><a href="<?=base_url()?>logout">Logout</a></li>
        <?php } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li class="dropdown">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Content Management <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url()?>">Homepage</a></li>
                <li><a href="<?=base_url()?>contentmanagement/house_rules">House rules</a></li>
            </ul>
        </li>
      	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Room Management <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=base_url()?>roomtype">Room Types</a></li>
            <li><a href="<?=base_url()?>room">Rooms</a></li>
            <li><a href="<?=base_url()?>roomimage">Room Images</a></li>
            <li><a href="<?=base_url()?>roomamenities">Room Amenities</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Payment Management <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=base_url()?>paymentype">Payment Types</a></li>
            <li><a href="<?=base_url()?>transactions">Transactions</a></li>
            <li><a href="<?=base_url()?>reservations">Reservations</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>