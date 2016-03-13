<?php

get_header(); ?>

<?php
	$query = new WP_Query(array(
		'post_type' => 'event',
		'posts_per_page' => -1,
		'order' => 'ASC'
	));

	$dates = array();

	if ( $query->have_posts() ) {
		while ($query->have_posts()) {
			$query->the_post();

			$dates[] = event_timing_get_meta( 'event_timing_date' );

		}
	};

	$dates = array_unique( $dates );
	wp_reset_postdata();
?>

	<body id="page-top" data-spy="scroll" data-target=".side-menu">
	<nav class="side-menu">
		<ul>
			<li class="hidden active">
				<a class="page-scroll" href="#page-top"></a>
			</li>
			<li>
				<a href="#home" class="page-scroll">
					<span class="menu-title">Home</span>
					<span class="dot"></span>
				</a>
			</li>
			<li>
				<a href="#speakers" class="page-scroll">
					<span class="menu-title">Speakers</span>
					<span class="dot"></span>
				</a>
			</li>
			<li>
				<a href="#tickets" class="page-scroll">
					<span class="menu-title">Buy Tickets</span>
					<span class="dot"></span>
				</a>
			</li>
			<li>
				<a href="#schedule" class="page-scroll">
					<span class="menu-title">Schedule</span>
					<span class="dot"></span>
				</a>
			</li>
		</ul>
	</nav>
	<div class="container-fluid">
		<!-- Start: Header -->
		<div class="row hero-header" id="home">
			<div class="col-md-7">
				<?php
				$query = new WP_Query(array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					'order' => 'DSC'
				));


				if ( $query->have_posts() ) {
					while ($query->have_posts()) {
						$query->the_post();

						?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/dist/image/logo_large.png" class="logo">
						<h1><?php the_title(); ?></h1>
						<h3><?php the_content(); ?></h3>
						<?php
							$tabLength = count($dates);
							$event_start = new \DateTime($dates[0]);
							$event_end = new \DateTime( $dates[$tabLength-1] );
						?>
						<h4>Du <?php echo $event_start->format('d-m') ?> au <?php echo $event_end->format('d-m') ?></h4>
						<a href="#tickets" class="btn btn-lg btn-red white-txt ">Réservez votre place<span class="ti-arrow-right"></span></a>

						<?php
					}
				};

				wp_reset_postdata();
				?>


			</div>
			<div class="col-md-5 hidden-xs">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/dist/image/rocket.png" class="rocket animated bounce">
			</div>
		</div>
		<!-- End: Header -->
	</div>
	<div class="container">
		<!-- Start: Desc -->
		<div class="row me-row content-ct">
			<h2 class="row-title">Why This Event Is Super Cool?</h2>
			<div class="col-md-4 feature">
				<span class="ti-ticket"></span>
				<h3>Buy Early Bird Tickets</h3>
				<p>Super cool discounts if you purchase early bird tickets now. Limited tickets available with some awesome perks and goodies!</p>
			</div>
			<div class="col-md-4 feature">
				<span class="ti-microphone"></span>
				<h3>Expert Speakers</h3>
				<p>Best in class expert speakers who have extensive knowledge of the topic. All speakers are curated by the panel of experts.</p>
			</div>
			<div class="col-md-4 feature">
				<span class="ti-world"></span>
				<h3>People around the globe!</h3>
				<p>Meet the people attending this event around the globe. This will be the best opportunity to meet and greet people from your industry.</p>
			</div>
		</div>
		<!-- End: Desc -->

		<!-- Start: Speakers -->
		<div class="row me-row content-ct speaker" id="speakers">
			<h2 class="row-title">Meet the Speakers</h2>


        <?php
        // WP_Query arguments
        $args = array (
            'post_type'              => array( 'speaker' ),
            'post_status'            => array( 'publish' ),
        );

        // The Query
        $query = new WP_Query( $args );

        // The Loop
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                ?>
        <div class="col-md-4 col-sm-6 feature">
            <img src="<?php  echo wp_get_attachment_url( get_post_thumbnail_id($post->ID))?>" class="speaker-img animated bounce">
            <h3><?php the_title() ?></h3>
            <p><?php the_content() ?></p>
            <ul class="speaker-social">
                <?php if(speaker_social_get_meta( 'speaker_social_facebook' )) : ?>
                <li>
                    <a href="<?php echo speaker_social_get_meta( 'speaker_social_facebook' ) ?>"><span class="ti-facebook"></span>
                    </a>
                </li>
                <?php   endif; ?>

                <?php if(speaker_social_get_meta( 'speaker_social_twitter' )) : ?>
                    <li>
                        <a href="<?php echo speaker_social_get_meta( 'speaker_social_twitter' ) ?>"><span class="ti-twitter-alt"></span></a>
                    </li>
                <?php   endif; ?>

                <?php if(speaker_social_get_meta( 'speaker_social_linkedin' )) : ?>

                <li><a href="<?php echo speaker_social_get_meta( 'speaker_social_linkedin' ) ?>"><span class="ti-linkedin"></span></a></li>
                <?php   endif; ?>

            </ul>
        </div>

                <?php
            }
        } else {
            ?>
            <div class="col-md-4 col-sm-6 feature">
                Pas encore de conférenciers
            </div>

            <?php
        }

        // Restore original Post Data
        wp_reset_postdata();
        ?>
		<!-- End: Speakers -->
	    </div>
    </div>

	<!-- Start: Tickets -->
	<div class="container-fluid tickets" id="tickets">
		<div class="row me-row content-ct">
			<h2 class="row-title">Votre place</h2>
			<div class="col-md-4 col-sm-6 col-md-offset-2">
				<h3>Tickets pour participer</h3>
				<p class="price">Gratuit</p>
				<p>Réservez votre place pour participer au hackathon</p>
				<a href="#" class="btn btn-lg btn-red">Commander</a>
			</div>
			<div class="col-md-4 col-sm-6">
				<h3>Tickets pour la remise des prix</h3>
				<p class="price">Gratuit</p>
				<p>Réservez votre place pour assister à la remise des prix</p>
				<a href="#" class="btn btn-lg btn-red">Commander</a>
			</div>
		</div>
	</div>
	<!-- End: Tickets -->

    <div class="container">
        <div class="row me-row schedule" id="schedule">
            <h2 class="row-title content-ct">Planning des évènements</h2>
            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <?php foreach($dates as $key => $date): ?>
                    <?php $dateObject = new \DateTime($date);?>
                    <li role="presentation">
                        <a href="#day-<?php echo ($key + 1) ?>" aria-controls="home" role="tab" data-toggle="tab">
                            Journée  <?php echo ($key + 1) ?> <small class="hidden-xs">( <?php echo $dateObject->format('d-m-Y') ?>)</small>
                        </a>
                    </li>

                <?php endforeach; ?>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
					<?php if(count($dates) > 0 ) : ?>
                    <?php foreach($dates as $key=>$date): ?>

                        <div role="tabpanel" class="tab-pane fade in <?php if($key == 0){ echo 'active';} ?>" id="day-<?php echo ($key + 1) ?>">
                            <div class="row">
                                <?php
                                $args = array (
                                    'post_type'              => array( 'event' ),
                                    'post_status'            => array( 'publish' ),
                                    'meta_query'             => array(
                                        array(
                                            'key'       => 'event_timing_date',
                                            'value'     => $date,
                                            'compare'   => '=',
                                            'type'      => 'DATETIME',
                                        ),
                                    ),
									'order'		=> 'ASC',
									'orderby'	=> 'event_timing_order',

                                );

                                // The Query
                                $query = new WP_Query( $args );

                                // The Loop
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();
                                        ?>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="<?php  echo wp_get_attachment_url( get_post_thumbnail_id($post->ID))?>" alt="...">
                                                    </a>
                                                </div>
                                                <div class="media-body">
													<?php
													$start = event_timing_get_meta( 'event_timing_start' );
													$end = event_timing_get_meta( 'event_timing_end' );
													?>
													<?php if(isset($start) && isset($end) ): ?>
                                                    <h4 class="media-heading">De <?php echo $start?> à  <?php echo $end?></h4>
													<?php else: ?>
													<h4 class="media-heading">Pas encore d'horraires</h4>
													<?php endif; ?>

													<?php if(get_the_title()) : ?>

														<h5><?php echo the_title()?></h5>
													<?php else: ?>
														<h4 class="media-heading">Pas encore de titre</h4>
													<?php endif; ?>

													<?php if(get_the_content()) : ?>
														<p><?php echo the_content(); ?></p>
													<?php else: ?>
														<p class="media-heading">Pas encore de description</p>
													<?php endif; ?>

                                                </div>
                                            </div>
                                        </div><!-- single event -->
                                        <?php
                                    }
                                } else {
                                    ?>
									Pas de description disponible pour cette journée, revenez plus tard.
                                    <?php
                                }

                                // Restore original Post Data
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div> <!-- tab panel-->
                    <?php endforeach; ?>
					<?php endif; ?>
                </div> <!-- tab content-->
            </div>
        </div>
    </div><!--end schedule -->

<?php
get_footer();
