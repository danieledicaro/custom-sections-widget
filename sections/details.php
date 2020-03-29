<?php
/**
 * Section Name:   Details
 * Plugin Name:   Custom Sections Widget
 * Plugin URI:    https://github.com/danieledicaro/custom-sections-widget
 * Version:       1.0
 * Author:        Daniele Di Caro
 * Author URI:    https://github.com/danieledicaro/
 */

class details_Widget extends WP_Widget {


  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array( 'classname' => 'details_widget', 'description' => 'Add the Details section' );
    parent::__construct( 'details_widget', 'Details Widget', $widget_options );
  }
  
  public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );


  // Create the widget output.
  public function widget( $args, $instance ) {
	extract( $args );
    echo $args['before_widget'];
	// echo $args['before_title'] . $args['after_title']; ?>
	<style type="text/css">/* --- STYLES --- */ #details-container { color: black; font-size: 1em; } @media ( max-width: 768px ) { #details-container { width: 100% !important; font-size: 0.85em; } #details-texts { width: 90%; margin: 0 auto; } } @media ( max-width: 480px ) { #details-container { font-size: 0.75em; } } #details-title { font-size: 1em; } #details-texts span { font-size: 2em; font-style: italic; } #details-navigation { font-size: 1.5em; font-style: italic; } /* --- CONTAINER --- */ #details-container { margin: 0 auto; -webkit-transition: all 1s ease-in-out; -moz-transition: all 1s ease-in-out; -o-transition: all 1s ease-in-out; transition: all 1s ease-in-out; } #details-container .col { width: 100%; height: auto; background-position: center; background-repeat: no-repeat; background-size: cover; background-clip: content-box; background-origin: content-box; } #details-title .col { text-align: center; } /* --- TITLE --- */ #details-title h2 { margin: 0; } /* --- IMAGES --- */ #image-for-resize { visibility: hidden; width: 100%; height: auto; } #details-images img { padding: 0; } #details-first-image { padding-right: 0.5%; } #details-second-image { padding-right: 0.5%; padding-left: 0.5%; } #details-third-image { padding-left: 0.5%; } /* --- TEXTS --- */ #details-texts { position: relative; } #details-texts::after { content: ""; display: block; clear: both; } #details-texts .col { position: absolute; opacity: 0; text-align: justify; margin-left: 50px; -webkit-transition: all 1s ease-in-out; -moz-transition: all 1s ease-in-out; -o-transition: all 1s ease-in-out; transition: all 1s ease-in-out; } #details-texts .col.hide { opacity: 0; margin-left: -50px; } #details-texts .col.show { opacity: 100; margin-left: 0; } /* --- NAVIGATION --- */ #details-navigation { margin-top: 2vw; padding-top: 2vw; } #details-navigation .col { text-align: right; } #details-next::after { content:'>'; font-size: 0.75em; padding: 0 10px; }</style>
	<div class="container" id="details-container" style="opacity: 0; width:<?php $width_of_the_container; ?>">
    	<div class="row" id="details-images">
    		<div class="col col-xs-4 col-sm-4" id="details-first-image" style="background-image: url(<?php echo esc_url($instance['image_1']); ?>)"><img id="image-for-resize" src="<?php echo esc_url($instance['image_1']); ?>" /></div>
    		<div class="col col-xs-4 col-sm-4" id="details-second-image" style="background-image: url(<?php echo esc_url($instance['image_2']); ?>)"></div>
    		<div class="col col-xs-4 col-sm-4" id="details-third-image" style="background-image: url(<?php echo esc_url($instance['image_3']); ?>)"></div>
    	</div>
    	<div class="row" id="details-title">
    		<div class="col col-12-xs col-12-sm">
    			<h2><?php echo esc_html__( $instance['title'], 'text_domain' ); ?></h2>
    		</div>
    	</div>
    	<div class="row" id="details-texts">
    		<div class="col col-12-xs col-sm-12 show"><span>1.</span><p><?php echo esc_html__( $instance['step_1'], 'text_domain' ); ?></p></div>
    		<div class="col col-12-xs col-sm-12"><span>2.</span><p><?php echo esc_html__( $instance['step_2'], 'text_domain' ); ?></p></div>
    		<div class="col col-12-xs col-sm-12"><span>3.</span><p><?php echo esc_html__( $instance['step_3'], 'text_domain' ); ?></p></div>
    	</div>
    	<div class="row" id="details-navigation">
    	    <div class="col col-12-xs col-sm-12" id="details-next" onclick="detailsChangeStep();">
    	        Next
    	    </div>
    	</div>
    </div>
	
	<script type="text/javascript">
	
	// STEPS CHANGE
	
	var detailsMainContainer = document.getElementById('details-container');
	//detailsMainContainer.style.opacity = 0; // included directly in the tag
	var stepContainer = document.getElementById('details-texts');
	updateHeight(stepContainer);
	setTimeout( function() { detailsMainContainer.style.opacity = 100; } , 1500);

	window.addEventListener("resize", function() { updateHeight(stepContainer); } );

	function detailsChangeStep() {
		var stepContainer = document.getElementById('details-texts');
		var activeStep = document.querySelector('.show');
		// if started over
		if ( stepContainer.lastElementChild.classList.contains("hide") ) {
			stepContainer.lastElementChild.classList.remove("hide");
		}
		// check if it is the last
		if ( activeStep.nextElementSibling != null ) {
			console.log(activeStep.nextElementSibling);
			activeStep.classList.remove("show"); activeStep.classList.add("hide");
			activeStep.nextElementSibling.classList.add('show');
			console.log(2);
			// if the next will be the last
			if ( activeStep.nextElementSibling.nextElementSibling == null ) {
				console.log(3);
				document.getElementById('details-next').innerHTML = "Start over";
				stepContainer.firstElementChild.classList.remove("hide");
			}
		} else {
			stepContainer.lastElementChild.classList.remove("show"); activeStep.classList.add("hide");
			var hiddenSteps = stepContainer.querySelectorAll('.hide');
			// reset for start over
			for (i = 0; i < hiddenSteps.length-1; ++i) {
			  hiddenSteps[i].classList.remove("hide");
			}
			stepContainer.firstElementChild.classList.add('show');
			document.getElementById('details-next').innerHTML = "Next";
		}
	}

	function updateHeight(stepContainer) {
		var maxStepSize = 0;
		var singleStep = stepContainer.querySelectorAll('.col');
		for (i = 0; i < singleStep.length; ++i) {
			if ( singleStep[i].clientHeight > maxStepSize )
				maxStepSize = singleStep[i].clientHeight;
		}
		stepContainer.style.height = maxStepSize + "px";
	}
	</script>

    <?php echo $args['after_widget'];
  }

  
  // Create the admin area widget settings form.
  public function form( $instance ) {
	  $image_1 = ! empty( $instance['image_1'] ) ? $instance['image_1'] : '';
	  $image_2 = ! empty( $instance['image_2'] ) ? $instance['image_2'] : '';
	  $image_3 = ! empty( $instance['image_3'] ) ? $instance['image_3'] : '';
	  $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
	  $step_1 = ! empty( $instance['step_1'] ) ? $instance['step_1'] : '';
	  $step_2 = ! empty( $instance['step_2'] ) ? $instance['step_2'] : '';
	  $step_3 = ! empty( $instance['step_3'] ) ? $instance['step_3'] : '';
	?>
    
    
    <p>
      <label for="<?php echo $this->get_field_id('image_1'); ?>">Image 1</label><br />
      <input type="text" name="<?php echo $this->get_field_name('image_1'); ?>" class="image_1" value="<?php echo esc_url($image_1); ?>" />
      <input type="button" value="<?php _e( 'Upload Image', 'theme name' ); ?>" class="button custom_media_upload custom_image_uploader_1" />
    </p>
	
	<p>
      <label for="<?php echo $this->get_field_id('image_2'); ?>">Image 2</label><br />
      <input type="text" name="<?php echo $this->get_field_name('image_2'); ?>" class="image_2" value="<?php echo esc_url($image_2); ?>" />
      <input type="button" value="<?php _e( 'Upload Image', 'theme name' ); ?>" class="button custom_media_upload custom_image_uploader_2" />
    </p>
	
	<p>
      <label for="<?php echo $this->get_field_id('image_3'); ?>">Image 1</label><br />
      <input type="text" name="<?php echo $this->get_field_name('image_3'); ?>" class="image_3" value="<?php echo esc_url($image_3); ?>" />
      <input type="button" value="<?php _e( 'Upload Image', 'theme name' ); ?>" class="button custom_media_upload custom_image_uploader_3" />
    </p>
    
    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($title); ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id( 'step_1' ); ?>">Step 1:</label>
      <textarea class="widefat" type="text" id="<?php echo $this->get_field_id( 'step_1' ); ?>" name="<?php echo $this->get_field_name( 'step_1' ); ?>"><?php echo esc_textarea($step_1); ?></textarea></p>
	  
    <p><label for="<?php echo $this->get_field_id( 'step_2' ); ?>">Step 2:</label>
      <textarea class="widefat" type="text" id="<?php echo $this->get_field_id( 'step_2' ); ?>" name="<?php echo $this->get_field_name( 'step_2' ); ?>"><?php echo esc_textarea($step_2); ?></textarea></p>
    
    <p><label for="<?php echo $this->get_field_id( 'step_3' ); ?>">Step 3:</label>
      <textarea class="widefat" type="text" id="<?php echo $this->get_field_id( 'step_3' ); ?>" name="<?php echo $this->get_field_name( 'step_3' ); ?>"><?php echo esc_textarea($step_3); ?></textarea></p>
    
    <script type="text/javascript">
	
	//  IMAGE SELECTION

	jQuery(document).ready(function($){
		
		$('.custom_image_uploader_1').on("click", function(e) {
			e.preventDefault();
			var image = wp.media({ 
				title: 'Upload Image',
				// mutiple: true if you want to upload multiple files at once
				multiple: false
			}).open()
			.on('select', function(e){
				// This will return the selected image from the Media Uploader, the result is an object
				var uploaded_image = image.state().get('selection').first();
				// We convert uploaded_image to a JSON object to make accessing it easier
				var image_url = uploaded_image.toJSON().url;
				// Let's assign the url value to the input field
				$('.image_1').val(image_url);
				$('.media-modal-close').click();
			});
		});
		
		$('.custom_image_uploader_2').on("click", function(e) {
			e.preventDefault();
			var image = wp.media({ 
				title: 'Upload Image',
				// mutiple: true if you want to upload multiple files at once
				multiple: false
			}).open()
			.on('select', function(e){
				// This will return the selected image from the Media Uploader, the result is an object
				var uploaded_image = image.state().get('selection').first();
				// We convert uploaded_image to a JSON object to make accessing it easier
				var image_url = uploaded_image.toJSON().url;
				// Let's assign the url value to the input field
				$('.image_2').val(image_url);
				$('.media-modal-close').click();
			});
		});
		
		$('.custom_image_uploader_3').on("click", function(e) {
			e.preventDefault();
			var image = wp.media({ 
				title: 'Upload Image',
				// mutiple: true if you want to upload multiple files at once
				multiple: false
			}).open()
			.on('select', function(e){
				// This will return the selected image from the Media Uploader, the result is an object
				var uploaded_image = image.state().get('selection').first();
				// We convert uploaded_image to a JSON object to make accessing it easier
				var image_url = uploaded_image.toJSON().url;
				// Let's assign the url value to the input field
				$('.image_3').val(image_url);
				$('.media-modal-close').click();
			});
		});
		
	});
	
    </script>
    
    
    
    <?php
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['image_1'] = ( !empty( $new_instance['image_1'] ) ) ? strip_tags( $new_instance['image_1'] ) : '';
        $instance['image_2'] = ( !empty( $new_instance['image_2'] ) ) ? strip_tags( $new_instance['image_2'] ) : '';
        $instance['image_3'] = ( !empty( $new_instance['image_3'] ) ) ? strip_tags( $new_instance['image_3'] ) : '';
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['step_1'] = ( !empty( $new_instance['step_1'] ) ) ? strip_tags( $new_instance['step_1'] ) : '';
        $instance['step_2'] = ( !empty( $new_instance['step_2'] ) ) ? strip_tags( $new_instance['step_2'] ) : '';
        $instance['step_3'] = strip_tags($new_instance['step_3']);
 
        return $instance;
    }

}