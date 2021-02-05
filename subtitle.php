<h4 class="text-center">
	<?php
		$subtitle = '';
		switch($_SESSION['mode']['name']) {
			case "address":
				$subtitle = "Test ". ucwords($_SESSION['mode']['name']);
				break;
			case "serialno":
				$subtitle = "Test Serial Numbers";
				break;
			default:
				$subtitle = "Practice Mode";
				break;
		}
		
		echo $subtitle;
	?>
</h4>