
<?php
    add_shortcode( 'tabs_listing', 'tabs_listing_fun' );
    function tabs_listing_fun( $atts ) {
        $atts = shortcode_atts( array(
            'columns' => '4',
        ), $atts, 'tabs_listing' );
        $columns = $atts['columns'];
        // echo $columns;
?>

   
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tabs_wrap">

                        <?php
                            $args = array(
                                'post_type'=> 'tabs',
                                'orderby'    => 'ID',
                                'post_status' => 'publish',
                                'order'    => 'DESC',
                                'posts_per_page' => -1 // this will retrive all the post that is published 
                            );
                        ?>

                        <div class="tabs_head">
                            <div class="button-group filter-button-group">
                                <button data-filter="*">Show all</button>
                                <?php
                                    $cats = get_categories($args);
                                    foreach($cats as $cat) {
                                        $cat_name = $cat->name;
                                        $cat_slug = $cat -> slug;

                                        if($cat_name !== "Uncategorized"){
                                            ?>
                                                <button data-filter=".<?php echo $cat_slug;?>"><?php echo $cat_name; ?></button>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="tabs_body">
                            <div class="grid">

                            <?php $result = new WP_Query( $args );
                                if ( $result-> have_posts() ) : ?>
                                <?php while ( $result->have_posts() ) : $result->the_post(); ?>
                            
                                <?php
                                    // //get all categories
                                    // $categories = get_the_category();
                                    // // $curr_category = $categories[0]->slug; get only first 0 index cat
                                    // $all_cats = array(); #empty array
                                    // foreach ( $categories as $key=>$category ) {
                                    //     #push in array
                                    //     array_push($all_cats,  $category->slug);
                                    // }
                                    
                                    // $all_cat_str = implode(" ", $all_cats);
                             

                                    $categories = get_the_category();
                                    $all_cats = "";
                                    foreach ( $categories as $key=>$category ) {
                                        $all_cats .= " " . $category->slug;
                                    }
                                ?>
                                
                             

                                <div class="grid-item <?=$all_cats?>">
                                    <div class="card">
                                        <div class="img_box">
                                            <img
                                            src="<?php the_post_thumbnail_url();?>"
                                            class="card-img-top"
                                            alt="bike"
                                            />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo the_title();?></h5>
                                            <p class="card-text">
                                            <?php echo the_excerpt();?>
                                            </p>
                                            <a href="<?php echo get_permalink();?>" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>

                                <?php endwhile; ?>
                                <?php endif; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
      
    }

?>


    