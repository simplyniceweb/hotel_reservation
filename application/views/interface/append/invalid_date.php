<div class="invalid-date">
	<?php if (isset($invalid) && $invalid == 1): ?>
    	<h4 class="text-info">Invalid date!</h4>
    <?php else: ?>
        <h4 class="text-info">This room is not available on the date below:</h4>
        <ul>
        <?php foreach($object as $row) { ?>	
            <li class="text-danger"><?=date('M d, Y', strtotime($row->check_in))?> to <?=date('M d, Y', strtotime($row->check_out))?></li>
        <?php } ?>
        </ul>
    <?php endif; ?>
</div>