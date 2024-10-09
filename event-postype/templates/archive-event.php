<?php 
get_header();

?>
<section class="container-fluid plugin_wrapper">
    <section class="course_archive_str_sec float-start w-100">

                <h1 class="page_str_sec_title">
                    <?php the_archive_title(); ?>
                </h1>
            <div class='archive-search-form '>
                <form action='<?php bloginfo("url") ?>/' method="get">
                    <input type="hidden" name="post_type" value="event" />
                    <input
                        class="s-text"
                        type="text"
                        name="s"
                        value=""
                        placeholder=" <?php _e('search event','event-postype')?>"
                        autocomplete="off"
                      />
                      <button>
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28 28L23.3335 23.3333M26.6667 15.3333C26.6667 21.5926 21.5926 26.6667 15.3333 26.6667C9.07411 26.6667 4 21.5926 4 15.3333C4 9.07411 9.07411 4 15.3333 4C21.5926 4 26.6667 9.07411 26.6667 15.3333Z"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>
    </section>
<section class='archive_posts_wrapper w-100 float-start py '>
    <div class="archive_careers_tax_wrapper container">
        <ul class='archive_careers_tax_list archive_course_tax_list'>
            <li class='active_button'><button class="filter mixitup-active " data-filter='.all-projects'><?php _e('All Events','event-postype')?> </button></li>
            <?php 
            $taxonomies = get_object_taxonomies( (object) array( 'post_type' => 'event' ) );
             foreach( $taxonomies as $taxonomy ) : 
                $termsx = get_terms( $taxonomy );
                foreach( $termsx as $term ) :
                    if($term->taxonomy == 'event-type'){
            ?>
            <li><button class="filter" data-filter=".<?php echo $term->slug  ?>"><?php echo $term->name  ?></button></li>
            <?php 
                }          
                endforeach;
                endforeach;
            ?>
        </ul> 
    </div>
    <section class='archive_course_list container mixedupp' id='mixedupp'>
        <?php while(have_posts()) : the_post();
            $event_date = get_post_meta(get_the_ID(),'event_date',true);
            $event_location = get_post_meta(get_the_ID(),'event_location',true);
            $caT_list='';
            $termsw = get_the_terms( get_the_ID(), 'event-type' ); 
            foreach($termsw as $termii) {
                $caT_list .= $termii->slug . ' ';
            }
        ?> 
          <section class='archive_course_post_item all-projects mix mix-items <?php echo $caT_list ; ?>'>
              <figure class='special_post_item_img'>
                  <a target="_blank"  href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>"></a>
              </figure>
              <section class="special_post_item_content">
                  <span class="course_carousel_item_title">
                      <a target="_blank"  href="<?php the_permalink(); ?>">
                          <?php the_title(); ?>
                      </a>
                  </span>
                  <div class="course_carousel_item_info">
                      <span>
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </i>
                        <?php echo $event_date ?>
                      </span>
                      <span>
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                        </i>
                        <?php echo $event_location ?>
                      </span>
                  </div>
                  <span class="course_carousel_item_status">
                      <a target="_blank"  href="<?php the_permalink(); ?>"><?php _e('more info','event-postype')?> </a>
                  </span>
              </section>
          </section>
        <?php endwhile; ?> 
    </section>
</section>
</section>

<?php
get_footer();
?>

<script>
    var mixer = mixitup('.mixedupp');
    // ********************************************
    //============================================filter button
    jQuery('.archive_careers_tax_list>li').click(function(){
      jQuery('.archive_careers_tax_list>li').removeClass('active_button')
      jQuery(this).addClass('active_button')
    })
</script>