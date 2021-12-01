<?php
/*
*
* Tab style 
*
*
*/

function news_box_home_tab_content($cat, $num, $style,$date = '1',$advance = '1'){

 //feature slider query
if(  $cat == 'all' ){
	$news_box_tab_terms = '';
}else{
	$news_box_tab_terms = array(
		array(
			'taxonomy'  => 'category',
			'field'  => 'slug',
			'terms'  => $cat
		)
	);
}


	$news_box_tab_args = array(
		'post_type'  		=>	'post',
		'post_status'  		=>	'publish',
		'posts_per_page' 	=>  $num,
		'tax_query' 	    =>	$news_box_tab_terms,
	);

	$news_box_tab_loop = new WP_Query($news_box_tab_args);


	if( $style == 'one' ){
?>
<div class="tabstyle1">
	<div class="row">	
	<?php 
if($news_box_tab_loop->have_posts()):
	while ( $news_box_tab_loop->have_posts()) :  
		$news_box_tab_loop->the_post();
		$newsbox_slider_categories = get_the_category();
		if($newsbox_slider_categories){
			$newsbox_slider_category = $newsbox_slider_categories[mt_rand(0,count( $newsbox_slider_categories)-1)];
		}else{
			$newsbox_slider_category = '';
		}
	 ?>
  <div class="col-md-6">
  <div class="card mb-4">
  	<a href="<?php the_permalink(); ?>">
    <?php // the_post_thumbnail( 'large', array('class'=>'card-img-top') ); ?>
    <?php newsbox_video_icon_thumb( get_the_ID(),'large','card-img-top' ); ?>
    </a>
    <div class="card-body">
       <h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <!--  <p class="card-text"><?php echo wp_trim_words( get_the_content(), 15 ); ?></p> -->
<?php if( $date == 1 || $advance == 1 ): ?>
      <div class="meta1">
      <?php if($date): ?>
      	<?php news_box_card_meta(); ?>
      <?php endif; ?>
      <?php if($advance): ?>
      	<div class="style1-ad float-<?php if($date): ?>right<?php else: ?>left<?php endif; ?>">
      	<?php news_box_post_advance_feature_two(get_the_ID()); ?>
      	</div>
      <?php endif; ?>
      </div>
<?php endif; ?>
    </div>
  </div>
  </div>
<?php
    endwhile;
    wp_reset_query();
endif;
 ?>
</div>
</div>
<?php
}
	if( $style == 'two' ){
?>
<div class="big-up tabstyle2">
<div class="row">
	<?php 
	$upcount = 0;
if($news_box_tab_loop->have_posts()):
	while ( $news_box_tab_loop->have_posts()) :  
		$news_box_tab_loop->the_post();
		$news_box_categories_list = get_the_category_list( esc_html__( ', ', 'news-box-pro' ) );
		$upcount++;
	 ?>
<?php if( $upcount < 3 ): ?>
<div class="col-md-6">
  <div class="card no-border upone">
    <?php // the_post_thumbnail( 'post-thumbnail', array('class'=>'card-img-top') ); ?>
    <?php newsbox_video_icon_thumb( get_the_ID(),'post-thumbnail','card-img-top' ); ?>

    <div class="card-content">
	    <div class="cmeta">
	    	<?php if($advance): ?>
	    	<div class="grid-advance show-item cadvance <?php if( empty($date) ): ?>mb-2<?php endif; ?>">
					<?php news_box_post_advance_feature_two(get_the_ID()); ?>
					<a class="adshow" href="#"><i class="fas fa-plus"></i></a>
			</div>
			<?php endif; ?>
			<?php if($date): ?>
		<span class="cdate mb-1 text-muted"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
	    </div>
       <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
       <p class="card-text"><?php echo wp_trim_words( get_the_content(), 32 ); ?></p>
    </div>
  </div>
</div>
<?php else: ?>
<div class="col-md-6">
  <div class="up-list mb-3">
	  <div class="row">
	  	<div class="col-md-4">
	  	<?php // the_post_thumbnail( 'medium', array('class'=>'up-img rounded') ); ?>
	  	<?php newsbox_video_icon_thumb( get_the_ID(),'medium','up-img rounded' ); ?>
	
	  	</div>
	  	<div class="col-md-8">
	  		<div class="up-content">
			    <div class="upmeta mb-1">
			    	<?php if($date): ?>
			    	<span class="text-muted"><?php echo get_the_date(); ?></span>
			    	<?php endif; ?>
			    </div>
		       <h5 class="up-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><a class="float-right" href="<?php the_permalink(); ?>"><i class="fas fa-angle-double-right"></i></a></h5>
		       <div class="list-meta">
		       	<?php if($advance): ?>
			      	<?php news_box_post_advance_feature_two(get_the_ID()); ?>
			     <?php endif; ?>
		       </div>
		    </div>	
		</div>
	  </div>
</div>
</div>
<?php endif; ?>
<?php
    endwhile;
    wp_reset_query();
endif;
 ?>
</div>
</div>
<?php
}
// style three
	if( $style == 'three' ){
?>
<div class="side-up tabstyle3">
<div class="row">
	<?php 
	$upcount = 0;
if($news_box_tab_loop->have_posts()):
	while ( $news_box_tab_loop->have_posts()) :  
		$news_box_tab_loop->the_post();
		$news_box_categories_list = get_the_category_list( esc_html__( ', ', 'news-box-pro' ) );
		$upcount++;
	 ?>
<?php if( $upcount == 1 ): ?>
<div class="col-md-6">
  <div class="card no-border upone">
    <?php //the_post_thumbnail( 'post-thumbnail', array('class'=>'card-img-top') ); ?>
   	<?php newsbox_video_icon_thumb( get_the_ID(),'post-thumbnail','card-img-top' ); ?>

    <div class="card-content">
	    <div class="cmeta">
	    <?php if($advance): ?>
	    	<div class="grid-advance show-item cadvance">
				<?php news_box_post_advance_feature_two(get_the_ID()); ?>
					<a class="adshow" href="#"><i class="fas fa-plus"></i></a>
			</div>
		<?php endif; ?>
		<?php if($date): ?>
		<span class="cdate mb-1 text-muted"><?php echo get_the_date(); ?></span>
		<?php endif; ?>
	    </div>
       <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
       <p class="card-text"><?php echo wp_trim_words( get_the_content(), 32 ); ?></p>
    </div>
  </div>
</div>
<?php endif; ?>
<?php
    endwhile;
    wp_reset_query();
endif;
 ?>

<div class="col-md-6">


	<?php 
	$upcount = 0;
if($news_box_tab_loop->have_posts()):
	while ( $news_box_tab_loop->have_posts()) :  
		$news_box_tab_loop->the_post();
		$news_box_categories_list = get_the_category_list( esc_html__( ', ', 'news-box-pro' ) );
		$upcount++;
if( $upcount >= 2 ):
 ?>
  <div class="up-list mb-3 pb-3">
	  <div class="row">
	  	<div class="col-sm-4">
	  	<?php // the_post_thumbnail( 'medium', array('class'=>'up-img rounded') ); ?>
	  	  <?php newsbox_video_icon_thumb( get_the_ID(),'medium','up-img rounded' ); ?>
	
	  	</div>
	  	<div class="col-sm-8">
	  		<div class="up-content">
			    <div class="upmeta mb-1">
			    	<?php if($date): ?>
			    	<span class="text-muted"><?php echo get_the_date(); ?></span>
			    <?php endif; ?>
			    </div>
		       <h5 class="up-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><a class="float-right" href="<?php the_permalink(); ?>"><i class="fas fa-angle-double-right"></i></a></h5>
		       <?php if($advance): ?>
		       <div class="list-meta">
		       	<?php news_box_post_advance_feature_two(get_the_ID()); ?>
		       </div>
		       <?php endif; ?>
		    </div>	
		</div>
	  </div>
</div>

<?php
endif;
    endwhile;
    wp_reset_query();
endif;
 ?>


</div>

</div>
</div>
<?php
	}

}

/*
<span class="card-cat">
	      	<?php if($newsbox_slider_category): ?>
	           <!-- category -->
	           <a class="p-1 badge badge-dark rounded-0" href="<?php echo esc_url(get_category_link($newsbox_slider_category)); ?>"><?php echo esc_html($newsbox_slider_category->name); ?></a>
			<?php endif; ?>
		</span>
*/