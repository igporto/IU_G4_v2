<!-- CONTIDO DA PAXINA -->

<?php
    include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
?>


<div class="col-xs-10" style="margin-top: 20px">
	<div class="row">
		<div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
			<img  class="img img-responsive" src="media/images/ni.png" alt="Not Implemented Image">
		</div>	
	</div>
	<div class="row text-center" style="margin-top: 20px">
		<h1>
			<?php echo $strings['erro_not_implemented'] ?>.
		</h1>
	</div>
</div>
