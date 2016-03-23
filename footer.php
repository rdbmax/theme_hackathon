<!-- Start: Footer -->
<div class="container-fluid footer">
	<div class="row contact">
		<div class="col-md-6 contact-form">
			<h3 class="content-ct"><span class="ti-email"></span> Formulaire de contact</h3>

			<?php
			if(count_chars(do_shortcode( '[contact-form-7 id="11" title="Formulaire de contact 1"]' )) > 0 ){
				echo do_shortcode( '[contact-form-7 id="11" title="Formulaire de contact 1"]' );
			}else{
			?>
				<form class="form-horizontal" data-toggle="validator" role="form">
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Name<sup>*</sup></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" placeholder="John Doe" required>
							<div class="help-block with-errors pull-right"></div>
							<span class="form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email<sup>*</sup></label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email" placeholder="you@youremail.com" required>
							<div class="help-block with-errors pull-right"></div>
							<span class="form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-3 control-label">Your Message<sup>*</sup></label>
						<div class="col-sm-9">
							<textarea id="message" class="form-control" rows="3" required></textarea>
							<div class="help-block with-errors pull-right"></div>
							<span class="form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" id="submit" name="submit" class="btn btn-yellow pull-right">Send <span class="ti-arrow-right"></span></button>
						</div>
					</div>
				</form>
			<?php
			}
		?>

		</div>
		<div class="col-md-4 col-md-offset-1 content-ct">
			<h3><span class="ti-twitter"></span> Twitter</h3>

			<a class="twitter-timeline"  href="https://twitter.com/SiliconBanlieue" data-widget-id="577833477707571201">Tweets de @SiliconBanlieue</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
	<div class="row footer-credit">
		<div class="col-md-6 col-sm-6">
			<?php
			$year = new \DateTime('now');
			?>
			<p>&copy; <?php echo $year->format('Y') ?>, <a href="#">Collectif des coworkeurs</a> | Tous droits réservés.</p>
		</div>
		<div class="col-md-6 col-sm-6">
			<ul class="footer-menu">
				<li><a target="_blank" href="http://www.siliconbanlieue.fr/">
					<img src="http://hackatown.siliconbanlieue.fr/wp-content/uploads/2016/03/logo_header1-1.png">
				</a></li>
				<li><a target="_blank" href="http://www.argenteuil.fr/">
					<img src="http://hackatown.siliconbanlieue.fr/wp-content/uploads/2016/03/logofooterNew.jpg">
				</a></li>
				<li><a target="_blank" href="http://www.rives-de-seine.fr/">
					<img src="http://hackatown.siliconbanlieue.fr/wp-content/uploads/2016/03/logo-1.png">
				</a></li>
				<li><a target="_blank" href="http://monptibot.com/">
					<img src="http://hackatown.siliconbanlieue.fr/wp-content/uploads/2016/03/profile3.jpg">
				</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- End: Footer -->

<?php wp_footer(); ?>

</body>
</html>
