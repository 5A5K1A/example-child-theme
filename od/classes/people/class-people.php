<?php
/**
 * People class
 */

class People extends PostType {
	/**
	 * Required variables
	 */
	protected $post_type           = 'people';
	protected $label_name          = "Collega's";
	protected $label_name_singular = 'Collega';
	protected $args = array(
		'menu_icon'           => 'dashicons-businessman',
		'labels'              => array(
			'add_new_item'          => 'Nieuwe collega',
			'add_new'               => 'Nieuwe collega',
			'featured_image'        => 'Profielfoto',
			'set_featured_image'    => 'Profielfoto instellen',
			'remove_featured_image' => 'Profielfoto verwijderen',
			'use_featured_image'    => 'Profielfoto gebruiken',
		),
		'has_archive'         => false,
		'exclude_from_search' => false,
	);

	public function GetAll() {
		return $this->GetSome();
	}

	public function GetSome( $number = -1 ) {
		// do wp query
		$aArgs = array(
			'post_type' 	=> 'people',
			'post_status' 	=> 'publish',
			'showposts' 	=> $number,
			'orderby'       => 'menu_order',
			'order'         => 'ASC',
		);
		$aPosts = get_posts( $aArgs );

		// init
		if( !is_array($aPosts) ) return array();

		$className = get_called_class();
		$aObjects  = array();

		// loop posts
		foreach( $aPosts as $post ) {

			// create object
			$oObject    = new $className( $post );
			$aObjects[] = $oObject;
		}

		// return array with object
		return $aObjects;
	}

	public function GetLabel( $type = 'full' ) {
		$sName      = $this->Get('post_title');
		$iBirthYear = $this->Get('people_birth');
		$sRole      = $this->Get('people_role');

		$sPersonLabel = $sName;
		if( !empty($iBirthYear) && $type == 'full' ) { $sPersonLabel .= ' ('.$iBirthYear.')'; }
		if( !empty($sRole) ) { $sPersonLabel .= ', '.$sRole; }

		return $sPersonLabel;
	}

	public function GetImageUrl( $image_size = 'thumbnail' ) {
		// person picture is mandatory
		$aImg = wp_get_attachment_image_src( get_post_thumbnail_id( $this->Get('ID')), $image_size );
		return $aImg[0];
	}

	public function GetDataObject() {
		// try cache
		if( $oData = wp_cache_get($this->Get('ID'), $this->post_type) ) {
			return $oData;
		}

		// basic data
		$oData             = new stdClass();
		$oData->id         = $this->Get('ID');
		$oData->type       = strtolower( get_called_class() );
		$oData->name       = $this->Get('post_title');
		$oData->slug       = $this->Get( 'post_name' );
		$oData->content    = $this->Get('post_content');
		$oData->permalink  = get_the_permalink(PEOPLE).'#'.$oData->slug;
		$oData->image_id   = get_post_thumbnail_id($oData->id);

		$oData->birth      = $this->Get('people_birth');
		$oData->role       = $this->Get('people_role');
		$oData->intro      = $this->Get('people_intro');

		$oData->fulllabel  = $this->GetLabel();
		$oData->shortlabel = $this->GetLabel('compact');

		$oData->imageurl   = $this->GetImageUrl('carousel');
		$oData->thumburl   = $this->GetImageUrl('blogpost');

		$oData->linkedin   = $this->Get('people_linkedin');
		$oData->email      = $this->Get('people_email');

		// cache
		wp_cache_set( $this->Get('ID'), $oData, $this->post_type, 60 * 60 );

		return $oData;
	}
}