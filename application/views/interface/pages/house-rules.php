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
    <!--
	<h1 class="title">House Rules</h1>
    <header style="padding: 20px">
        <article>
            <div>
            The resort is a place for relaxation and enjoyment; we accommodate our guests with that concept in mind. Normal good behaviour is appreciated and required. Any activity that intrudes on other guest’s enjoyment is not acceptable behaviour.
            Bringing in of own food is NOT ALLOWED, only chips, dried finger food and water is allowed to bring at the Main Resort. For beverages i.e., soft drinks, beer, alcoholic beverages CORKAGE FEES WILL APPLY.
            </div>
        </article>        
        <fieldset>
            <legend>Room</legend>
            <ol>
                <li>
                    No smoking, drinking and eating inside the rooms. All accommodations have porches for such activities.
                </li>
                <li>
                    Please do not bring beddings, linens and towels outside the cottages. Missing towels are charged at Php500.00 per piece. 
                </li>
                <li>
                    Other missing, vandalized and broken items inside the cottages will be charged to your account.
                </li>
                <li>
                    Please use the foot wash outside your cottages to avoid bringing in sand inside the rooms.
                </li>
                <li>
                    To help us save on electricity, please turn-off the air-conditioning units when you go out for your day activities.
                </li>
                <li>
                    Room keys are entrusted to guests upon check-in. Please take care of these keys as lost keys are charged at Php500.00 per piece.
                </li>
                <li>
                    Conserve water at all times. Please turn-off faucets and showers when not in use.
                </li>
                <li>
                    Let’s Be Eco-Friendly. Please hang your towels on the rack if you want to re-use them. To change towels, just approach our staff to assist you. Please refrain from bringing the towels out from your room.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Corkage</legend>
            For guests own beverages <strong>CORKAGE</strong> will be imposed at the following rates:
            <ul class="span6 corkage">
                <div class="row-fluid slideshow-row">  
                    <li>
                    <strong>Softdrinks</strong>
                        <ul>
                            <li>
                                <span>Standard bottle</span><span class="right">P5/bottle P120/case
                                </span></li>
                           <li>
                                <span>1/2 liter</span><span class="right">P10/bottle</span>
                            </li>
                            <li>
                                <span>1 liter</span><span class="right">P20/bottle</span>
                            </li>
                        </ul> 
                    </li>
                <li><br>
                    <span><strong>Still wine (750ml - 1 liter)</strong></span>
                    
                    <span class="right">P100/bottle</span>
                </li><br>
                <li><strong>Hard liquor</strong>
                    <ul>
                        <li>
                            <span>Local brand</span>
                            <span class="right">P100/bottle</span>
                        </li>
                        <li>
                            <span>Imported brand</span>
                            <span class="right">P200/bottle</span>
                        </li>
                    </ul>
                </li>
            </div></ul>
        </fieldset>
        <fieldset>
            <legend>Bag Inspection</legend>
            <ol>            
                <li>
                    The resort has the right to inspect bags upon arrival and departure. Bringing out of resort items is strongly discouraged as this will be charged to your account.
                </li>
                <li>
                    Deadly weapons are strictly prohibited. Service guns of uniformed personnel will have to be turned-over to the Security Office.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Consumption of alcoholic beverages</legend>
            <ol>            
                <li>
                    Drinking and swimming don’t go together. Most drowning incidents involve alcohol that results to death.
                </li>
                <li>
                    Drink in moderation even less when swimming.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Water Safety</legend>
            <ol>
                <li>
                    When using a boat i.e. kayak(s), the use of life vests is mandatory. Rough play should not be allowed for safety reasons.
                </li>
                <li>
                    Do not handle or collect marine creatures, some could be harmful or even lethal/ cause death.
                </li>
                <li>
                    Please stay within the swimming area (with buoy markers).
                </li>
                <li>
                    Children should be accompanied by adults at all times.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Videoke</legend>
            <ol>
                <li>
                    Videoke Rental can be pre-arranged and can be set-up at designated places (Sampaloc Terrace, Dining Pavilion, Function Room).
                </li> 
                <li>
                    Use of Videoke is only up to 10:00 PM as per local ordinance.
                </li>
                <li>
                    Please control the volume in consideration with other guests.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Swimming pool</legend>
            <ol>
                <li>
                    No rough behaviour.
                </li> 
                <li>
                    Diving in the pool – NOT ALLOWED (only 4 feet deep).
                </li> 
                <li>
                    Shower before use,proper swimwear required.
                </li> 
                <li>
                    NO FOOD near the pool area.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Beach</legend>
            <ol>
                <li>
                    Swimming along the beach is until 6pm only.
                </li>
                <li>Please Do Not Litter. Keep our shoreline from any pollutants.</li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Grounds</legend>
            <ol>
                <li>
                    Resorts are nice places; throwing cigarette butts, plastic wrappers, Styrofoam cartons and the like is unacceptable behaviour.
                </li>
                <li>
                    Thoughtless disposal of waste/ garbage is not acceptable. This applies
                    to all areas – parking, main resort, buildings and rooms and most importantly the BEACH.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Bringing - in of PETS</legend>
            <ol>
                <li>
                    We consider our resort as pet friendly however pet owners will have to take full responsibility in making sure that pets are always on safety leash.
                </li>
                <li>
                    Pets are not allowed inside the dining pavilion, in the swimming pool and perimeter and inside the cottages.
                </li>
                <li>
                    As per Department of Tourism prohibited acts and practices, no pets or animals are allowed to bathe / swim along beaches.
                </li>
                <li>
                    Owners should bring their own Pet Kennels. Owners should pick-up Pets poop, wrapped in paper and throw in the waste bin.
                </li>
                <li>
                    Responsible pet owner handling (i.e. pooper scooper, NO BARKING)
                </li>
                <li>
                    As some guests are nervous of being in-close proximity of even small pets, Responsible handling is required.
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Person With Disability</legend>
            <ol>
                <li>
                    Persons with Disability are given special attention at our resort. 
                </li>
                <li>
                    We would implore you to also give them the same respect and attention.
                </li>
                <li>Any assistance given is highly appreciated.</li>
            </ol>
        </fieldset>                
        <fieldset><legend>Parking</legend>
            <ol>
                <li>Free parking space are provided for our guests.</li>
                <li>Please Park at your assigned space as assisted by our security personnel.</li>
                <li>Do not leave your vehicles unlocked or leave any valuables in them. The Resort will not be liable for any loss or damages.</li>
            </ol>
            </fieldset>
        <fieldset><legend>Suggestion</legend>
            <li>
                Most trauma/ wounds occur as foot injuries, use protective footwear.
            </li>
            <li>
                Avoid sunburns. Limit exposure with clothing or use SPF lotions. Apply SPF lotions 20 minutes before going to swim.
            </li>
            <li>
                Drink plenty of water to avoid dehydration.
            </li>
                <li>Do not leave your valuables unattended.</li>
                <li>Please feel free to approach any of our staff for your concerns. We are glad to be of service.</li>
        </fieldset>
    </header>
    -->
    <header style="padding: 20px">
    <?=$content?>
    </header>
</div>

<?php include(__DIR__.'/../footer.php'); ?>