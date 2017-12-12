<?php
class SIQ_Search_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'siq_search_widget', // Base ID
			__( 'searchIQ search box', 'siq_text' ), // Name
			array( 'description' => __( 'A Widget which displays a searchbox in the widget area', 'siq_text' ), ) // Args
		);
	}


	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo $this->getWidgetHtml($instance);
		echo $args['after_widget'];
	}

	public function getWidgetHtml($instance = array()){

		$strWidget        = "";
		$searchValue   = get_search_query();
		$searchText      = !empty($instance['placeholder']) ? $instance['placeholder'] : "Search";
		$strWidget .='<div id="siq-expandwdgt-cont" class="siq-expandwdgt-cont">
		  <form class="siq-expandwdgt" action="'.get_home_url().'">
		    <input type="search" placeholder="'.$searchText.'" value="'.$searchValue.'" name="s" class="siq-expandwdgt-input">';
			$postTypes 		= ! empty( $instance['postTypes'] ) ? $instance['postTypes'] : "";
			if(!empty($postTypes)){
				$strWidget .='<input type="hidden"  value="'.$postTypes.'" name="postTypes" />';
			}
		    $strWidget .='<span class="siq-expandwdgt-icon"></span>
		  </form>
		</div>';
		return $strWidget;
	}


	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'siq_text' );
		$placeholder = ! empty( $instance['placeholder'] ) ? $instance['placeholder'] : __( 'Search', 'siq_text' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"><?php _e( esc_attr( 'Placeholder Text:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'placeholder' ) ); ?>" type="text" value="<?php echo esc_attr( $placeholder ); ?>">
		</p>
		<?php 
			global $siq_plugin;  
			$postTypeForSearch = $siq_plugin->getPostTypesForSearchOnWidget();
			if(is_array($postTypeForSearch) && count($postTypeForSearch) > 0){
				$postTypes = ! empty( $instance['postTypes'] ) ? explode(',',$instance['postTypes']) : array();
		?>
			<p>
				<label><?php _e( esc_attr( 'Post types for search:' ) ); ?></label><br/>
				<?php 
					foreach($postTypeForSearch as $k => $v) { 
					$checked = in_array($v, $postTypes) ? "checked='checked'" : "";
				?>
						<input <?php echo $checked;?> type="checkbox"  id="<?php echo esc_attr( $this->get_field_id( 'postTypes' ."_".$v) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postTypes' ) ); ?>[]" value="<?php echo $v;?>" />
						<label  for="<?php echo esc_attr( $this->get_field_id( 'postTypes' ."_".$v) ); ?>" ><?php echo $v;?></label><br/>
				<?php } ?>
			</p>
		<?php
			}
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['placeholder'] = ( ! empty( $new_instance['placeholder'] ) ) ? strip_tags( $new_instance['placeholder'] ) : '';
		$instance['postTypes'] = ( ! empty( $new_instance['postTypes'] ) ) ? strip_tags(implode(',',$new_instance['postTypes'] )) : '';
		return $instance;
	}

}