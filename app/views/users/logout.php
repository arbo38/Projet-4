<?php

if($message){
	echo "<div class='alert alert-success'>
			Vous avez été déconnecté.
		</div> <!-- div.alert alert-danger -->";
} else {
	echo "<div class='alert alert-warning'>
			Vous n'êtes pas connecté.
		</div> <!-- div.alert alert-danger -->";
}