<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1 class="title"><?=(isset($rooms[1][0]->name))?$rooms[1][0]->name:'No rooms'?></h1>
    <p class="text-muted"><?=(isset($rooms[1][0]->description))?$rooms[1][0]->description:''?></p>
    <hr/>
    <div class="row">
    <?php
	if($rooms[2]>0) {
    foreach($rooms[0] as $room) {
	$image = $this->Rooms_Model->get_image($room->room_id);
	$amenities = $this->Rooms_Model->get_amenities($room->room_id);
	?>
    <span class="book-info-<?=$room->room_id?>" data-info="<?=$room->max_adult?>-<?=$room->max_child?>"></span>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="<?=base_url()?>assets/images/rooms/<?=$image?>"/>
          <div class="caption">
            <h3><?=$room->room_name?></h3>
            <p><?=$room->room_description?>.</p>
            <p><a href="#" class="amenities-anchor" data-id="<?=$room->room_id?>"><i class="fa fa-plus-circle"></i> Amenities</a></p>
            <div class="amenities-toggle amenities-<?=$room->room_id?>">
            	<?php if(!is_numeric($amenities)) { foreach($amenities as $amenity) { ?>
				<p><small><?=$amenity->amenities_name?></small></p>
                <?php } } else { ?>
                <p>No amenities</p>
                <?php } ?>
            </div>
            <p>
            	<a href="#" class="btn btn-success btn-sm" data-id="<?=$room->room_id?>" data-toggle="modal" data-target="#bookRoom">
                <i class="fa fa-home"></i> Book now!</a>
                <a href="#" class="btn btn-info btn-sm" data-id="<?=$room->room_id?>-<?=$room->room_name?>" data-toggle="modal" data-target="#roomGallery">
                <i class="fa fa-image"></i> View Gallery</a>
            </p>
          </div>
        </div>
      </div>
    <?php }} else { ?>
    	<div class="col-sm-12">
    		<p class="alert alert-danger"><i class="fa fa-home fa-2x"></i> No rooms yet</p>
        </div>
    <?php } ?>
    </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="roomGallery">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<div class="simplyniceGallery"></div>
      </div>
      <div class="modal-footer simplynice-control">
        <button class="btn btn-warning btn-sm btn-p"><i class="fa fa-angle-double-left"></i> Prev</button>
        <button class="btn btn-info btn-sm btn-n">Next <i class="fa fa-angle-double-right"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Book -->
<div class="modal fade" id="bookRoom">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Booking</h4>
      </div>
      <div class="modal-body">
      	<?=$this->form_builder->open_form(array('action' => 'book')); ?>
        <h4 class="text-info">Booking Details</h4>
        <hr/>
		<?php
			$now = new \DateTime("now");
            echo $this->form_builder->build_form_horizontal(
            array(
				array(
					'id' => 'check_in',
					'class' => 'datepicker',
					'value' => $now->format('Y-m-d')
				),
				array(
					'id' => 'check_out',
					'class' => 'datepicker',
					'value' => $now->format('Y-m-d')
				),
				array(
					'id' => 'adult',
					'type' => 'dropdown',
					'class' => 'adult_drop',
					'options' => array(
						'-1' => 'Please select',
					)
				),
				array(
					'id' => 'child',
					'type' => 'dropdown',
					'class' => 'child_drop',
					'options' => array(
						'-1' => 'Please select',
					)
				),
				array(
					'id'   => 'process',
					'type' => 'submit',
					'class' => 'process pull-right'
				),
            ));
        ?>
        <div class="customer_info hide">
        <h4 class="text-info">Guest Information</h4>
        <hr/>
        <?php
			echo $this->form_builder->build_form_horizontal(
            array(
				array(
					'id' => 'title',
					'type' => 'dropdown',
					'options' => array(
						'1' => 'Mr',
						'2' => 'Ms',
						'3' => 'Mrs'
					)
				),
				array(
					'id' => 'first_name'
				),
				array(
					'id' => 'last_name'
				),
				array(
					'id' => 'email_address'
				),
				array(
					'id' => 'confirm_email_address'
				),
				array(
					'id' => 'address'
				),
				array(
					'id' => 'city'
				),
				array(
					'id' => 'province'
				),
				array(
					'id' => 'zip_postal'
				),
				/*
				array(
					'id' => 'country',
					'type' => 'dropdown',
					'options' => $countries
				),
				*/
				array(
					'id'   => 'Reserve',
					'type' => 'submit',
					'class' => 'btn-warning process pull-right'
				),
			));
		?>
        <?=$this->form_builder->close_form()?>
        </div>
      </div>
      <div class="modal-footer" style="border: none">
      </div>
    </div>
  </div>
</div>
<?php include(__DIR__.'/../footer.php'); ?>