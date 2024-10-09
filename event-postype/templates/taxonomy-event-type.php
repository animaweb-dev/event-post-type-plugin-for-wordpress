<?php 
get_header();
$terms = get_queried_object();
$desc_blog = term_description($terms->term_id); 
?>
<section class="container-fluid plugin_wrapper">

<section class='careers_header_wrapper w-100 float-start d-flex flex-column-reverse flex-lg-row justify-content-between align-items-stretch align-content-start flex-wrap'>
    <section class="archive_header_content container py">
        <h1 class="archive_header_title">
          <?php single_term_title(); ?>
        </h1>
    </section>
</section>
<section class="blog-category d-flex flex-column justify-content-between align-items-center  float-start">
    <section class="w-100 d-flex justify-content-center justify-content-lg-start align-items-start flex-wrap container">
    <?php while(have_posts()) : the_post();
            $event_date = get_post_meta(get_the_ID(),'event_date',true);
            $event_location = get_post_meta(get_the_ID(),'event_location',true);
        ?> 
          <section class='archive_course_post_item'>
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
                      <a target="_blank"  href="<?php the_permalink(); ?>"><?php _e('more info','event-postype')?>  </a>
                  </span>
              </section>
          </section>
        <?php endwhile; ?> 
    </section>
    <span class="pagenavi-wrapper container">
      <?php wp_pagenavi(); ?>
    </span>
    <?php if(!empty($desc_blog)){ ?>
      <section class="archive-desc w-100 mt-5 mb-5 container">
        <section class="cat-desc single-content" id="cat-desc">
          <?php echo $desc_blog ?>
        </section>
      </section>
    <?php } ?>
</section>
</section>
<?php
get_footer();
?>