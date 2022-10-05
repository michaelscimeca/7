<?php
/**
* The template used for displaying page content
*
* @package normcore
* @since NormCore 2.0
*/
?>

<section id="post-container" class="js-ae" data-threshold=".1">

<?php
$search = '';
if($_GET['term'] && !empty($_GET['term'])): ?>
<?php $search = $_GET['term']; ?>
<?php endif; ?>

<?php
if($_GET['category'] && !empty($_GET['category'])):
  $cat = $_GET['category'];
else:
  $cat = [];
endif;
?>

<?php
$sorted = 'DESC';
if($_GET['recent'] && !empty($_GET['recent'])):
  $sorted = $_GET['recent'] == 'Oldest' ? 'ASC' : 'DESC';
endif;
?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// add_filter( 'posts_where', 'title_filter', 10, 2 );

$args = array(
  'post_type' => 'events',
  'posts_per_page' => 9,
  'posts_per_archive_page' => 9,
  'paged' => $paged,
  'category_name' => is_array($cat) ? implode(",", $cat) : $cat,
  'orderby' => 'meta_value_num',
  'order' => $sorted,
  'meta_key' => 'event_date',
  'title_filter' => $term,
  'title_filter_relation' => 'OR',
  'meta_query' => array(
		array(
			'relation' => 'OR',
			array(
				'key' => 'event_content',
				'value' => $term,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'event_layout_$_content',
				'value' => $term,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'event_description',
				'value' => $term,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'event_date',
				'value' => $term,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'event_end_date',
				'value' => $term,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'event_location',
				'value' => $term,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'event_subtitle',
				'value' => $term,
				'compare' => 'LIKE'
			)
		)
	)
);
$loop = new WP_Query( $args );

// remove_filter( 'posts_where', 'title_filter', 10, 2 ); ?>
<div class="row align-center">
  <div class="small-12 column">
    <h2>Upcoming Events</h2>
    <div id="post-list-container">
      <div id="input-container">
        <div class="input-search-container">
          <form id="search" role="search" method="get" action="<?php bloginfo('siteurl'); ?>/events/">
          	<input id="s" class="search__box" placeholder="Search events" name="term" type="text" value="<?php if($_GET['term']) {echo($_GET['term']);} ?>" name="term" />
          </form>
          </div>
          <div class="btn-icon-cont primary-bg larger">
            <div class="btn-arrowent">
              <div class="icon"></div>
              <div class="text">Filter</div>
            </div>
          </div>
        </div>

        <div id="article-sort-container">
          <div class="article-num">
            <div class="article-text">
              <span><?php echo $loop->found_posts; ?> Events sorted by</span>
            </div>
            <div class="drop-down">
              <span><?php if($_GET['recent']) {echo($_GET['recent']);} else {echo 'Most Recent';} ?></span>
              <ul id="recent">
                <li>Most Recent</li>
                <li>Oldest</li>
              </ul>
            </div>
          </div>
        </div>


          <?php if ($loop->have_posts()): ?>
          <div id="post-list-results">
            <?php while ( $loop->have_posts() ) : $loop->the_post();
              $cats = get_field('category');?>
              <a href="<?php the_permalink(); ?>" class="article js-ae <?php echo (get_field('featured') === "Yes") ? 'full-bleed' : ''; ?>"  data-threshold=".1">
                <?php if (is_array($cats)) :  ?>
                <?php foreach ($cats as $cat) { ?>
                <?php if(get_the_category_by_ID($cat) !== 'Uncategorized'): ?><div class="category"><?php echo get_the_category_by_ID($cat); ?></div><?php endif; ?>
                <?php } ?>
                <?php elseif ($cats) : ?>
                <?php if(get_the_category_by_ID($cat) !== 'Uncategorized'): ?><div class="category"><?php echo get_the_category_by_ID($cats); ?></div><?php endif; ?>
                <?php endif; ?>


                <div class="content-container">

                  <div class="content">
                    <h4><?php the_title(); ?></h4>
                    <?php // if(get_field('featured') === "Yes"): ?>
                      <p><?php echo character_limit(get_field('event_content')); ?></p>
                    <?php // endif;?>
                    <div class="btn-section">
                      <div class="text">Learn More</div>
                      <div class="circle-btn"></div>
                    </div>
                  </div>
                </div>
                <?php
                  $image = get_field('event_image');

                  $past_date = false;
                  if (get_field('event_end_date') && strtotime(get_field('event_end_date')) < strtotime(date('Ymd'))) {
                    $past_date = true;
                  } else if (get_field('event_date') < date('Ymd')) {
                    $past_date = true;
                  }
                ?>
                <div class="image-container<?php if($past_date) {echo ' past-date';} ?>">

                  <div class="img" style="background-image: url('<?php echo $image['url'] ?>')"></div>
                  <div class="date-block<?php if($past_date) {echo ' past-date';} if (!$past_date && !get_field('event_end_date') && !get_field('event_time') && !get_field('event_location')) {echo ' no-divider'; }?>">
                    <div class="date-cont">
                      <?php
                        $date = date_create(get_field('event_date'));
                        $month = date_format($date,"M");
                        $day = date_format($date,"d");
                        $year = date_format($date,"Y");
                      ?>
                      <div class="month"><?php echo $month; ?></div>
                      <div class="day"><?php echo $day; ?></div>
                      <div class="year"><?php echo $year; ?></div>
                    </div>
                    <?php if (!$past_date) : ?>
                    <?php if (get_field('event_end_date') || get_field('event_time') || get_field('event_location')) : ?>
                    <div class="schedule-container">
                      <?php if (get_field('event_end_date')) : ?>
                        <?php
                        $short_range = '';
                        $long_range = '';
                        $start_date_month_short = date_format($date,"M");
                        $start_date_month_long = date_format($date,"F");
                        $start_date_day = date_format($date,"d");

                        $end_date = date_create(get_field('event_end_date'));
                        $end_date_month_short = date_format($end_date,"M");
                        $end_date_month_long = date_format($end_date,"F");
                        $end_date_day = date_format($end_date,"d");

                        if ($start_date_month_short === $end_date_month_short) {
          								// same month
          								$short_range = $start_date_month_short . ' ' . $start_date_day . '–' . $end_date_day;
          								$long_range = $start_date_month_long . ' ' . $start_date_day . '–' . $end_date_day;

          								?>
          								<div class="calander hide-for-medium"><?php echo $short_range; ?></div>
          								<div class="calander show-for-medium"><?php echo $long_range; ?></div>
          								<?php
          							} else {
          								$range = $start_date_month_short . ' ' . $start_date_day . '–' . $end_date_month_short . ' ' . $end_date_day;
          								?>
          								<div class="calander"><?php echo $range; ?></div>
          								<?php
          							}
                        ?>
                      <?php endif; ?>
                      <?php if (get_field('event_time')) : ?>
                      <div class="time"><?php the_field('event_time'); ?></div>
                      <?php endif; ?>
                      <?php if (get_field('event_location')) : ?>
                      <div class="location"><?php the_field('event_location'); ?></div>
                      <?php endif; ?>
                    </div>
                    <?php
                    endif;
                    else :
                    ?>

                    <div class="past-event-container">
                      <div class="past-icon"></div>
                      <div class="past-text">Event Has Passed</div>
                    </div>
                    <?php endif;  ?>
                  </div>
                </div>
              </a>
            <?php endwhile; ?>
          </div>

          <?php
          $big = 999999999;
          $pag =  paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $loop->max_num_pages,
            'prev_text' => '',
            'next_text' => ''
          ) );
          ?>
          <?php if(!empty($pag)): ?>
            <div class="pagination-container">
              <nav id="pagination" class="js-ae">
                <?php
                $previous_post = get_previous_post();
                $prev_link = get_previous_posts_link(__('&laquo; Older Entries'));
                // var_dump($prev_link === null);
                if($prev_link === null) { ?>
                  <div class="page-numbers prev dull"></div>
                <?php  } ?>
                <?php echo $pag; ?>
                <?php
                if(empty($previous_post)) { ?>
                  <div class="page-numbers next dull"></div>
                <?php  } ?>
              </nav>

            </div>
          <?php endif;?>
        <?php else: ?>
          <div id="empty-container" class="js-ae">
            <div class="content">
              <h4>No Matches Found</h4>
              <p>Whoops! Looks like your search didn’t produce any results. Try another search or keep scrolling for suggested events.</p>
              <div class="keep-exploring">Keep Exploring</div>

            </div>
          </div>

       <?php $args_noresults = array(
            'post_type' => 'events',
            'posts_per_page' => 9,
            'posts_per_archive_page' => 9,
            'paged' => $paged,
            'orderby' => 'date',
          );
          $loop = new WP_Query( $args_noresults ); ?>
          <div id="post-list-results">
            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
              <a href="<?php the_permalink(); ?>" class="article  js-ae <?php echo (get_field('featured') === "Yes") ? 'full-bleed' : ''; ?>"  data-threshold=".1">
                <div class="content-container">
                  <?php
          					$cats = get_field('category');
          					if (is_array($cats)) :
          						foreach ($cats as $cat) {
          				?>
          					<div class="category"><?php echo get_the_category_by_ID($cat); ?></div>
          				<?php } ?>
                  <?php elseif ($cats) : ?>
          					<div class="category"><?php echo get_the_category_by_ID($cats); ?></div>
          				<?php endif; ?>
                  <div class="content">
                    <h4><?php the_title(); ?></h4>
                    <?php // if(get_field('featured') === "Yes"): ?>
                      <p><?php echo character_limit(get_field('event_content')); ?></p>
                    <?php // endif;?>
                    <div class="btn-section">
                      <div class="text">Learn More</div>
                      <div class="circle-btn"></div>
                    </div>
                  </div>
                </div>
                <?php
                  $image = get_field('event_image');

                  $past_date = false;
                  if (get_field('event_end_date') && strtotime(get_field('event_end_date')) < strtotime(date('Ymd'))) {
                    $past_date = true;
                  } else if (get_field('event_date') < date('Ymd')) {
                    $past_date = true;
                  }
                ?>
                <div class="image-container<?php if($past_date) {echo ' past-date';} ?>">

                  <div class="img" style="background-image: url('<?php echo $image['url'] ?>')"></div>
                  <div class="date-block<?php if($past_date) {echo ' past-date';} if (!$past_date && !get_field('event_end_date') && !get_field('event_time') && !get_field('event_location')) {echo ' no-divider'; }?>">
                    <div class="date-cont">
                      <?php
                        $date = date_create(get_field('event_date'));
                        $month = date_format($date,"M");
                        $day = date_format($date,"d");
                        $year = date_format($date,"Y");
                      ?>
                      <div class="month"><?php echo $month; ?></div>
                      <div class="day"><?php echo $day; ?></div>
                      <div class="year"><?php echo $year; ?></div>
                    </div>
                    <?php if (!$past_date) : ?>
                    <?php if (get_field('event_end_date') || get_field('event_time') || get_field('event_location')) : ?>
                    <div class="schedule-container">
                      <?php if (get_field('event_end_date')) : ?>
                        <?php
                        $short_range = '';
                        $long_range = '';
                        $start_date_month_short = date_format($date,"M");
                        $start_date_month_long = date_format($date,"F");
                        $start_date_day = date_format($date,"d");

                        $end_date = date_create(get_field('event_end_date'));
                        $end_date_month_short = date_format($end_date,"M");
                        $end_date_month_long = date_format($end_date,"F");
                        $end_date_day = date_format($end_date,"d");

                        if ($start_date_month_short === $end_date_month_short) {
          								// same month
          								$short_range = $start_date_month_short . ' ' . $start_date_day . '–' . $end_date_day;
          								$long_range = $start_date_month_long . ' ' . $start_date_day . '–' . $end_date_day;

          								?>
          								<div class="calander hide-for-medium"><?php echo $short_range; ?></div>
          								<div class="calander show-for-medium"><?php echo $long_range; ?></div>
          								<?php
          							} else {
          								$range = $start_date_month_short . ' ' . $start_date_day . '–' . $end_date_month_short . ' ' . $end_date_day;
          								?>
          								<div class="calander"><?php echo $range; ?></div>
          								<?php
          							}
                        ?>
                      <?php endif; ?>
                      <?php if (get_field('event_time')) : ?>
                      <div class="time"><?php the_field('event_time'); ?></div>
                      <?php endif; ?>
                      <?php if (get_field('event_location')) : ?>
                      <div class="location"><?php the_field('event_location'); ?></div>
                      <?php endif; ?>
                    </div>
                    <?php
                    endif;
                    else :
                    ?>

                    <div class="past-event-container">
                      <div class="past-icon"></div>
                      <div class="past-text">Event Has Passed</div>
                    </div>
                    <?php endif;  ?>
                  </div>
                </div>
              </a>
            <?php endwhile; ?>
          </div>

          <?php
          $big = 999999999;
          $pag =  paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $args_noresults->max_num_pages,
            'prev_text' => '',
            'next_text' => ''
          ) );
          ?>
          <?php if(!empty($pag)): ?>
            <nav id="pagination" class="js-ae">
              <?php echo $pag; ?>
            </nav>
          <?php endif;?>
        <?php endif;
        wp_reset_query();
        ?>
      </div>
    </div>

  </section>
