<?php /*temlpate name: contact form*/ ?>
<link rel="stylesheet" href="build/css/intlTelInput.css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="build/js/intlTelInput.js"></script>

<script>
$("#demo").intlTelInput();
</script>

<style>
	.pbody{
		max-width: 500px;
		min-width: 250px;
		height: auto;
		padding: 1em;
		border-radius: 15px;
		background-color: #EFE7DB;
		border-width: 10px;
		border-color: white;
	}
</style>

<div class="pbody">
<input type="tel" id="demo" placeholder="">


</div>