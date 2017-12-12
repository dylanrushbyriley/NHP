<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class siq_core{

	const POST_THUMB_META_KEY = "_siq_post_thumb";
	const POST_THUMB_URL_META_KEY = "_siq_post_thumb_url";
	const POST_ORIG_IMG_URL_META_KEY = "_siq_post_orig_image_url";
	const DEFAULT_SEARCH_ALGORITHM = "BROAD_MATCH";
	const DEFAULT_CUSTOM_SEARCH_NUM_RECORDS = 10;
	const DEFAULT_CUSTOM_SEARCH_BAR_PLACEHOLDER = "Enter Your Search Term";
    const DEFAULT_MOBILE_ENABLED = true;
    const DEFAULT_MOBILE_ICON_ENABLED = false;
    const DEFAULT_MOBILE_FLOAT_BAR_ENABLED = false;
    const DEFAULT_MOBILE_FAVICON_MODE = 0;      //0 - disabled, 1 - auto-detect, 2 - custom input
	const DEFAULT_CROP_RESIZE_THUMB   = "crop";
	const DEFAULT_USE_META_DESC = false;
	const DEFAULT_AUTOCOMPLETE_FACETS_ENABLED = false;
	const DEFAULT_RESULT_PAGE_FACETS_ENABLED = false;
    const FACETS_LIMIT = 5;
	const FACETS_NOTICE_KEY = '_siq_show_facet_notice';
	const RP_LAYOUT_GRID = "GRID";
	const RP_LAYOUT_LIST = "LIST";
    const DEFAULT_CURRENCY_POS = "LEFT";

	public $pluginOptions;
	public $pluginSettings;
	public $logErrors;
	public $homeUrl;
	public $upload_info;
	public $supported_image;
	public $useErrorLog 		= false;
	public $imageHeight			= "";
	public $imageWidth			= "";
	public $smallImageHeight	= 40;
	public $smallImageWidth		= 40;
	public $mediumImageHeight	= 250;
	public $mediumImageWidth	= 250;
	public $currentHost			= "";
	public $availableSearchAlgorithms= array("BROAD_MATCH", "EXACT_MATCH");
	public $autocompleteStyling			= array(
		"autocompleteWidth" => array(
			"class" => "body .holdResults._siq_main_searchbox, body #siq_search_results .siq_searchForm .siq_searchWrapper.siq_searchResultWrapper .holdResults",
			"property" => "width",
			"default" => "auto",
			"pr" => "px"
		),
		"autocompleteBackground" => array(
			"class" => "body .holdResults._siq_main_searchbox .searchWrapperLabel, body .holdResults._siq_main_searchbox ul, body .holdResults._siq_main_searchbox ul li.sectionHead, body .holdResults._siq_main_searchbox ul li.sectionHead:hover, body .holdResults._siq_main_searchbox ul li.no-result, body .holdResults._siq_main_searchbox ul li.no-record, body .holdResults._siq_main_searchbox ul li.no-result, body .holdResults._siq_main_searchbox ul li.no-record:hover",
			"property" => "background-color",
			"default" => "FFFFFF",
			"su" => "#"
		),
		"sectionTitleColor" => array(
			"class" => "body .holdResults._siq_main_searchbox .searchWrapperLabel, body .holdResults._siq_main_searchbox ul li.sectionHead h3, body .holdResults._siq_main_searchbox ul .siq-powered-by, body .holdResults._siq_main_searchbox ul .siq-powered-by a",
			"property" => "color",
			"default" => "505050",
			"su" => "#"
		),
		"moreLinkColor" => array(
			"class" => "body .holdResults._siq_main_searchbox ul li .resultsMore, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.sectionHead h3 .resultsMore",
			"property" => "color",
			"default" => "B7B7B7",
			"su" => "#"
		),
		"hoverMoreLinkColor" => array(
			"class" => "body .holdResults._siq_main_searchbox ul li .resultsMore:hover, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.sectionHead h3 .resultsMore:hover",
			"property" => "color",
			"default" => "000000",
			"su" => "#"
		),
		"imagePlacehoderBackground" => array(
			"class" => "body ._siq_main_searchbox .siq_resultLeft.no-image .no-img, body #siq_search_results .siq_resultLeft.no-image .no-img",
			"property" => "background-color",
			"default" => "EFEDED",
			"su" => "#"
		),
		"resultFontSize" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li a h3, body .holdResults._siq_main_searchbox ul li a h3",
			"property" => "font-size",
			"default" => "13",
			"pr" => "px"
		),
		"resultFontColor" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li a h3, body .holdResults._siq_main_searchbox ul li a h3",
			"property" => "color",
			"default" => "333333",
			"su" => "#"
		),
		"highlightFontSize" => array(
			"class" => "body .holdResults._siq_main_searchbox ul li a em, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li a em",
			"property" => "font-size",
			"default" => "13",
			"pr" => "px"
		),
		"highlightFontColor" => array(
			"class" => "body .holdResults._siq_main_searchbox ul li a em, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li a em",
			"property" => "color",
			"default" => "333333",
			"su" => "#"
		),
		"hoverResultBackground" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.siq-autocomplete:hover, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.siq-autocomplete.highlighted, body .holdResults._siq_main_searchbox ul li.siq-autocomplete:hover, body .holdResults._siq_main_searchbox ul li.siq-autocomplete.highlighted",
			"property" => "background-color",
			"default" => "F9F9F9",
			"su" => "#"
		),
		"hoverResultFontSize" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li:hover a h3, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.highlighted a h3, body .holdResults._siq_main_searchbox ul li:hover a h3, body .holdResults._siq_main_searchbox ul li.highlighted a h3",
			"property" => "font-size",
			"default" => "13",
			"pr" => "px"
		),
		"hoverResultFontColor" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li:hover a h3, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.highlighted a h3, body .holdResults._siq_main_searchbox ul li:hover a h3, body .holdResults._siq_main_searchbox ul li.highlighted a h3",
			"property" => "color",
			"default" => "333333",
			"su" => "#"
		),
		"hoverHighlightFontSize" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li:hover a em, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.highlighted a em, body .holdResults._siq_main_searchbox ul li:hover a em, body .holdResults._siq_main_searchbox ul li.highlighted a em",
			"property" => "font-size",
			"default" => "13",
			"pr" => "px"
		),
		"hoverHighlightFontColor" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li:hover a em, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.highlighted a em, body .holdResults._siq_main_searchbox ul li:hover a em, body .holdResults._siq_main_searchbox ul li.highlighted a em",
			"property" => "color",
			"default" => "333333",
			"su" => "#"
		),
		"hoverImagePlacehoderBackground" => array(
			"class" => "body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li:hover .siq_resultLeft.no-image .no-img, body #siq_search_results .siq_searchForm .siq_searchWrapper .holdResults ul li.highlighted .siq_resultLeft.no-image .no-img, body .holdResults._siq_main_searchbox ul li:hover .siq_resultLeft.no-image .no-img, body .holdResults._siq_main_searchbox ul li.highlighted .siq_resultLeft.no-image .no-img",
			"property" => "background-color",
			"default" => "EFEDED",
			"su" => "#"
		)
	);
	public $mobileStyling = array(
		"barBgColor" => array(
			"default" => "F7F7F7"
		),
        "barInputBgColor" => array("default" => "FFFFFF"),
        "barInputTextColor" => array("default" => "000000"),
        "barPlaceholder" => array("default" => "What are you looking for?"),
        "barFavicon" => array("default" => ""),
		"barHeight" => array(
			"default" => ""
		),
		"canvasBgColor" => array(
			"default" => ""
		),
		"canvasLabelColor" => array(
			"default" => ""
		),
		"canvasTextColor" => array(
			"default" => ""
		),
		"canvasLabelSize" => array(
			"default" => ""
		),
		"canvasTextSize" => array(
			"default" => ""
		),
		"searchIconBoxBg" => array(
			"default" => "FFFFFF"
		),
		"searchIconColor" => array(
			"default" => "000000"
		),
		"searchIconTopOffset" => array(
			"default" => "44"
		),
		"searchIconTopOffsetUnit" => array(
			"default" => "%"
		),
        "barPlaceholderTextColor" => array(
            "default" => "BBBBBB"
        ),
        "resultTitleFontSize" => array(
            "default" => "55"
        )
	);
	public $baseClassVar				= "#siq_search_results";
	public $styling = array(
		'resultBoxBg'                   =>	array('class'=>'.search-results-row, #siq_search_results .search-sponsored-row', 	'default'=>'FFFFFF', 'property'=>'background-color', 'su'=>'#', 'pr'=>''),
		'resultTitleColor'              =>	array('class'=>'.search-results-R div.search-results-title a, #siq_search_results .siq-ads h2.srch-sponsored-title a', 				'default'=>'000000', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultTitleHlColor'            =>	array('class'=>'.search-results-R div.search-results-title a em', 				'default'=>'716F6F', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultAuthDateColor'           =>	array('class'=>'.search-results-R div.sr-R-author', 							'default'=>'959595', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultTextColor'               =>	array('class'=>'.search-results-R .sr-R-cont div, #siq_search_results .siq-ads .srch-sponsored-R-cont p', 								'default'=>'323232', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultTextHlColor'             =>	array('class'=>'.search-results-R .sr-R-cont div em', 							'default'=>'3c8be0', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultCatHeadingColor'         =>	array('class'=>'.search-results-R .sr-R-categories .categoriesMain', 			'default'=>'505050', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultCatTitleColor'           =>	array('class'=>'.search-results-R .sr-R-categories ul li', 					'default'=>'323232', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultCatBgColor'              =>	array('class'=>'.search-results-R .sr-R-categories ul li', 					'default'=>'FFFFFF', 'property'=>'background-color', 'su'=>'#', 'pr'=>''),
		'resultTagHeadingColor'         =>	array('class'=>'.search-results-R .sr-R-tags .tagsMain', 						'default'=>'505050', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultTagColor'                =>	array('class'=>'.search-results-R .sr-R-tags ul li', 							'default'=>'7A7A7A', 'property'=>'color', 'su'=>'#', 'pr'=>''),
		'resultTitleFontSize'           =>  array('class'=>'.search-results-R div.search-results-title a, #siq_search_results .siq-ads h2.srch-sponsored-title a', 				'default'=>'20', 	'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultTitleHlFontSize'         =>	array('class'=>'.search-results-R div.search-results-title a em', 				'default'=>'20', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultAuthDateFontSize'        =>	array('class'=>'.search-results-R div.sr-R-author', 								'default'=>'13', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultTextFontSize'            =>	array('class'=>'.search-results-R .sr-R-cont div, #siq_search_results .siq-ads .srch-sponsored-R-cont p', 								'default'=>'15', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultTextHlFontSize'          =>	array('class'=>'.search-results-R .sr-R-cont div em', 							'default'=>'13', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultCatHeadingFontSize'      =>	array('class'=>'.search-results-R .sr-R-categories .categoriesMain', 		'default'=>'13', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultCatTitleFontSize'        =>	array('class'=>'.search-results-R .sr-R-categories ul li', 				'default'=>'12', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultTagHeadingFontSize'      =>	array('class'=>'.search-results-R .sr-R-tags .tagsMain', 					'default'=>'13', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultTagFontSize'             =>	array('class'=>'.search-results-R .sr-R-tags ul li', 						'default'=>'13', 'property'=>'font-size', 'su'=>'', 'pr'=>'px'),
		'resultSearchBarBackground'     => array('class' => '.siq_searchForm .siq_searchWrapper .siq_searchTop .siq_searchInner .siq_searchBox', 'default' => 'FFFFFF', 'property' => 'background-color', 'su' => '#', 'pr' => ''),
		'resultSearchBarColor'          => array('class' => '.siq_searchForm .siq_searchWrapper .siq_searchTop .siq_searchInner .siq_searchBox', 'default' => '323232', 'property' => 'color', 'su' => '#', 'pr' => ''),
		'resultSearchBarPoweredByColor' => array('class' => '.srch-poweredbysiq div, #siq_search_results .srch-poweredbysiq a', 'default' => 'AAAAAA', 'property' => 'color', 'su' => '#', 'pr' => ''),
		'paginationFontSize'            => array('class' => '._siq_pagination a, #siq_search_results ._siq_pagination span', 'default' => '14', 'property' => 'font-size', 'su' => '', 'pr' => 'px'),
		'paginationActiveBackground'    => array('class' => '._siq_pagination a', 'default' => 'FFFFFF', 'property' => 'background-color', 'su' => '#', 'pr' => ''),
		'paginationActiveColor'    => array('class' => '._siq_pagination a', 'default' => '000000', 'property' => 'color', 'su' => '#', 'pr' => ''),
		'paginationActiveBorderColor'    => array('class' => '._siq_pagination a', 'default' => 'DDDDDD', 'property' => 'border-color', 'su' => '#', 'pr' => ''),
		'paginationCurrentBackground'    => array('class' => '._siq_pagination span.current', 'default' => 'FFFFFF', 'property' => 'background-color', 'su' => '#', 'pr' => ''),
		'paginationCurrentColor'    => array('class' => '._siq_pagination span.current', 'default' => '323232', 'property' => 'color', 'su' => '#', 'pr' => ''),
		'paginationCurrentBorderColor'    => array('class' => '._siq_pagination span.current', 'default' => '808080', 'property' => 'border-color', 'su' => '#', 'pr' => ''),
		'paginationInactiveBackground'    => array('class' => '._siq_pagination span.disabled', 'default' => 'F1F1F1', 'property' => 'background-color', 'su' => '#', 'pr' => ''),
		'paginationInactiveColor'    => array('class' => '._siq_pagination span.disabled', 'default' => 'D2D2D2', 'property' => 'color', 'su' => '#', 'pr' => ''),
		'paginationInactiveBorderColor'    => array('class' => '._siq_pagination span.disabled', 'default' => 'DDDDDD', 'property' => 'border-color', 'su' => '#', 'pr' => ''),
		'customCss'                     =>	array('class'=>'', 'default'=>'', 'property'=>'', 'su'=>'', 'pr'=>'','exclude'=>1)
	);
	public $keysExepmtedFromSanitize = array('customCss', 'blackListUrls');
	public $defaultAutocompleteTextResults = "Results";
	public $defaultAutocompleteTextMoreLink = "Show all # results";
	public $defaultAutocompleteTextPoweredBy = "powered by";
	public $postTypesFilter = array("attachment","revision","nav_menu_item");
	public $allTaxonomies = array();
	public $allTaxonomiesWithPostType = array();
	public $metaFieldsSkipped = array('_edit_lock','_edit_last');
	public $woocommerceActive = false;
	public $customFieldPrefix       = "cf_";
	public $customTaxonomyPrefix    = "ct_";
	public $customAttributePrefix   = "ca_";
	public $siqCropResizeOptions    = array('crop'=>"Crop", 'resize'=>"Resize");
	protected $featureExcludeFields = false;
	protected $isProPack            = false;
	public $widgetBaseId			= 'siq_search_widget';
	public $getSyncSettingsCalled   = 0;
	public $siqSyncSettings         = array();
    protected $wcCurrencySymbol     = null;
    protected $wcCurrencySymbolPos  = null;
	protected $licensed = false;
	protected $allowHideLogo = false;
    private $builtInFacetFields = array("date");
    private $documentFieldMappings = array();
	protected $fromDate = "";
	protected $toDate = "";
	public $postTypeForPDF = "siq_pdf";
	private $woocommerceProductTermsArgs = array("fields"=>'names');
	
	function __construct(){
		$this->pluginOptions = array(
			'auth_code'                     => '_siq_authentication_code',
			'engine_name'                   => '_siq_engine_name',
			'engine_code'                   => '_siq_engine_code',
			'index_posts'                   => '_siq_indexed_posts',
			'document_types'                => '_siq_document_types',
			'use_custom_search'             => '_siq_use_custom_search',
			'custom_search_page'            => '_siq_custom_search_page',
			'custom_search_page_old'        => '_siq_custom_search_page_old',
			'num_indexed_posts'             => '_siq_num_indexed_posts',
			'show_autocomplete_images'      => '_siq_show_autocomplete_images',
			'show_search_page_images'       => '_siq_show_search_page_images',
			'custom_search_page_style'      => '_siq_custom_search_page_style',
			'engine_just_created'           => '_siq_engine_just_created',
			"graphic_editor_error"          => '_siq_graphic_editor_error',
			'autocomplete_style'            => '_siq_autocomplete_style',
			'mobile_style'                  => '_siq_mobile_style',
			'mobile_enabled'                => '_siq_mobile_enabled',
            'mobile_icon_enabled'           => '_siq_mobile_icon_enabled',
            'mobile_float_bar_enabled'      => '_siq_mobile_float_bar_enabled',
            'mobile_favicon_mode'           => '_siq_mobile_favicon_mode',
			"disable_autocomplete"          => "_siq_disable_autocomplete",
			"autocomplete_num_records"      => "_siq_autocomplete_num_records",
			"searchbox_name"                => "_siq_searchbox_name",
			"post_types_for_search"         => "_siq_post_types_for_search",
			"search_query_param_name"       => "_siq_search_query_param_name",
			"image_custom_field"            => "_siq_image_custom_field",
            "exclude_custom_fields"         => "_siq_exclude_custom_fields",
			"exclude_custom_taxonomies"     => "_siq_exclude_custom_taxonomies",
            "exclude_posts"                 => "_siq_exclude_posts",
			"autocomplete_text_results"     => "_siq_autocomplete_text_results",
			"autocomplete_text_poweredBy"   => "_siq_autocomplete_text_poweredBy",
			"autocomplete_text_moreLink"    => "_siq_autocomplete_text_moreLink",
			"custom_page_display_author"    => "_siq_custom_page_display_author",
			"custom_page_display_category"  => "_siq_custom_page_display_category",
			"custom_page_display_tag"       => "_siq_custom_page_display_tag",
			"search_algorithm"              => "_siq_search_algorithm",
			"custom_search_num_records"     => "_siq_custom_search_num_records",
			"custom_search_bar_placeholder" => "_siq_custom_search_bar_placeholder",
			"siq_menu_select_box"           => "_siq_menu_select_box",
			"siq_menu_select_box_color"     => "_siq_menu_select_box_color",
			"siq_menu_select_box_pos_right" => "_siq_menu_select_box_pos_right",
			"siq_menu_select_box_pos_top"   => "_siq_menu_select_box_pos_top",
			"siq_menu_select_box_pos_absolute" => "_siq_menu_select_box_pos_absolute",
			"siq_menu_select_box_direction" => "_siq_menu_select_box_direction",
			"siq_hide_icon_notice" => "_siq_hide_icon_notice",
			"customSearchResultsInfoText"=> "_siq_customSearchResultsInfoText",
			"customSearchResultsOrderRelevanceText" => "_siq_customSearchResultsOrderRelevanceText",
			"customSearchResultsOrderNewestText" 		=>	"_siq_customSearchResultsOrderNewestText",
			"customSearchResultsOrderOldestText"			=>	"_siq_customSearchResultsOrderOldestText",
			"noRecordsFoundText"												=>	"_siq_noRecordsFoundText",
			"paginationPrevText"												=>	"_siq_paginationPrevText",
			"paginationNextText"												=>	"_siq_paginationNextText",
			"siq_default_search_widget_text"        => "_siq_default_search_widget_text",
            "siq_search_sortby"                     => "_siq_search_sortby",
			"siq_crop_resize_thumb"                 => "_siq_crop_resize_thumb",
			"siq_field_for_excerpt"					=> "_siq_field_for_excerpt",
			"search_icon_selector"					=> "_siq_search_icon_selector",
			"siq_facets"							=> "_siq_facets",
			"siq_facets_autocomplete_enabled"		=> "_siq_facets_autocomplete_enabled",
			"siq_facets_result_page_enabled"		=> "_siq_facets_result_page_enabled",
			"featureExcludeFields"                  => "_siq_feature_exclude_fields",
			"isProPack"                             => "_siq_is_pro_pack",
			"siq_engine_not_found" => "_siq_engine_not_found",
			"siq_default_thumbnail"	=> "_siq_default_thumbnail",
            "facets_modified"       => "_siq_facets_modified",
            "facets_enabled"        => "_siq_facets_enabled",
            "resultPageLayout"      => "_siq_result_page_layout",
			"siq_postTypesForSearchSelection"=>"_siq_postTypesForSearchSelection",
			"blacklist_urls"						=> "_siq_blacklist_urls",
			"siq_activated"						=> "_siq_activated"
		);
		$this->menuSearchBoxDirection = array("right"=>"Open from right to left", 'left'=>"Open from left to right");
		$this->supported_image = array('gif','jpg', 'jpeg', 'png');
		$this->homeUrl		=	network_home_url();
		$this->upload_info	=	wp_upload_dir();
		$this->getPluginSettings();
        $this->excludeCustomFields      = $this->getExcludedCustomFields();
        $this->excludePostIds           = $this->getExcludedPostIds();
		$this->blackListUrls				= $this->getBlackListUrls();
		$this->excludeCustomTaxonomies  = $this->getExcludedCustomTaxonomies();
		$this->fieldForExcerpt 	= $this->getFieldForExcerpt();
		$this->includeClientAPI();
		$this->currentHost	= network_home_url();
		add_action('admin_init', array($this, 'getSyncSettings'), 9);
		add_action('init', array($this, 'getAllTaxonomies'), 12);
		add_action('init', array($this, 'isWoocommerceActive'), 12);
		add_action( 'current_screen',  array($this, 'check_current_screen' ) , 99);
	}

	public function check_current_screen(){
		$screen = get_current_screen();
		if($screen->id == 'widgets' && $this->getSyncSettingsCalled == 0){
			$this->_siq_get_sync_settings();
		}
	}
	public function getIsProPack(){
		if(is_admin()){
			if($this->getSyncSettingsCalled == 0) {
				$this->_siq_get_sync_settings();
			}
		}else{
			$this->isProPack = $this->pluginSettings['isProPack'];
		}
		return ($this->isProPack) ? $this->isProPack : false;
	}

	public function getSyncSettings(){
		global $pagenow;
		if($pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == 'dwsearch' && $this->getSyncSettingsCalled == 0) {
			$this->_siq_get_sync_settings();
		}
	}

	public static function syncTableName(){
		global $wpdb;
		return $wpdb->prefix . 'siq_sync';
	}

	public function addToSync($postIDs, $status=""){
		global $wpdb;	
		$result = array();
		$result["success"] = 0;
		$logError = false;
		$deletedPostIdsArray 	= array();
		$deletedPostIds				= "";
		$table_name 						= $this->syncTableName();	
		$deletedPostIdsString	= $this->getSyncPostIds('d');
		$postIDs = (!is_array($postIDs)) ? explode(',',$postIDs) : $postIDs;
		$this->log_error("POSTS IDS ARR",$logError);
		$this->log_error(print_r($postIDs, true),$logError);
		
		
		$this->log_error("POSTS TO STRING",$logError);
		$this->log_error(print_r($deletedPostIdsString, true),$logError);
		if(!empty($deletedPostIdsString)){
			$deletedPostIdsArray = explode(",",$deletedPostIdsString);		
			$deletedPostIdsArray = array_merge($deletedPostIdsArray, $postIDs);
		}else{
			$deletedPostIdsArray = array_merge($deletedPostIdsArray, $postIDs);
		}
		$this->log_error("POSTS TO DELETE",$logError);
		$this->log_error(print_r($deletedPostIdsArray, true),$logError);
		if(count($deletedPostIdsArray) > 0){
			$deletedPostIds	=implode(",",$deletedPostIdsArray);		
			$this->log_error(print_r($deletedPostIds, true),$logError);
			// DELETE Record by post id(s)
			$query = "DELETE FROM $table_name  WHERE post_id IN($deletedPostIds)"; 
			$this->log_error($query,$logError);
			$wpdb->query($query);
			$result["success"] = 1;
			$result["deleted"] = $deletedPostIdsArray;
		}
		if (empty($postIDs)) {
			return $result;
		}
		if(empty($status) && is_array($postIDs) && count($postIDs) > 0 ){
			$currentTime = current_time( 'mysql' );
			$query = "INSERT INTO $table_name (`post_id`,`sync_time`) VALUES ";				
			foreach($postIDs as $v){
				$query .=" (".$v.",'".$currentTime."'),";
			}
			$query =substr($query,0,-1);			
			$this->log_error($query, $logError);
			$wpdb->query($query);			
			$result["success"] = 1;
			$result["inserted"] = $postIDs;
		}
		return $result;
	}

	public function getSyncPostIds($status = 'd', $getCount = false, $limit = 0){
		global $wpdb;
		$addToLog					= false;
		$syncPosts 					= "";
		$table_name 				= $this->syncTableName();
		$post_table_name  			= $wpdb->posts;
		$this->getPostTypesForIndexing();
		 $allowedPostTypes = implode("','", $this->postsToIndexAndSearch);
		if($allowedPostTypes != ""){
			$allowedPostTypes = "'".$allowedPostTypes."'";
		}
		
		if($status == "d"){
			//  QUERY  TO GET DELETED DELTA i.e. POSTID'S that don't exist in posts table
			$postMimeTypes 	= " OR (tbl1.post_type = 'attachment' AND tbl1.post_mime_type = 'application/pdf' AND tbl1.post_parent ='') ";
			$postMimeTypes_1 	= " OR (tbl.post_type = 'attachment' AND tbl.post_mime_type = 'application/pdf' AND tbl.post_parent ='') ";
			
			$theQuery = "SELECT tbl.post_id FROM $table_name tbl"; 
			$theQuery .=" LEFT JOIN  $post_table_name tbl1 ON tbl.post_id=tbl1.id";
			$theQuery .=" WHERE tbl1.id IS NULL OR ( (tbl1.post_status!='publish' AND tbl1.post_type IN ($allowedPostTypes)) ".$postMimeTypes." )";
			$theQuery .=" UNION";
			$theQuery .=" SELECT tbl.id FROM  $post_table_name tbl";
			$theQuery .=" LEFT JOIN $table_name tbl1 ON tbl.id=tbl1.post_id";
			$theQuery .=" WHERE tbl1.post_id IS NULL AND ( (tbl.post_status!='publish' AND  tbl.post_type IN ($allowedPostTypes)) ".$postMimeTypes_1.")"; 
			$theQuery .=" ORDER by post_id ASC"; 	
			
			if($getCount){
					$query = "SELECT count(tblData.post_id) FROM ($theQuery) tblData";
			}else{
					$query = $theQuery; 		
			}				
			$this->log_error("POST DELETE QUERY", $addToLog);
			$this->log_error($query, $addToLog);
		}else if($status == "u"){
			 //  QUERY  TO GET UPDATED DELTA i.e. POSTID"S who's modified time is greater than this tables modified time
			$timelimitToTbl1 		= !empty($this->toDate) ? " AND tbl1.post_modified <= '".$this->toDate."'" : "";
			$timelimitFromTbl1 	= !empty($this->fromDate) ? " AND tbl1.post_modified >= '".$this->fromDate."'" : "";
			$timelimitTbl1 				= $timelimitFromTbl1.$timelimitToTbl1;

			$timelimitToTbl 			= !empty($this->toDate) ? " AND tbl.post_modified <= '".$this->toDate."'" : "";
			$timelimitFromTbl 	= !empty($this->fromDate) ? " AND tbl.post_modified >= '".$this->fromDate."'" : "";
			$timelimitTbl 				= $timelimitFromTbl.$timelimitToTbl;
			 
			 
			$postMimeTypes 				= " OR (tbl.post_type = 'attachment' AND tbl.post_mime_type = 'application/pdf' AND tbl.post_parent !='') ";
			$allowedFilter 				= (!empty($postMimeTypes)) ? " AND ( (tbl.post_status='publish' AND tbl.post_type IN ($allowedPostTypes))  ".$postMimeTypes." )" : " AND tbl.post_status='publish' AND tbl.post_type IN ($allowedPostTypes) ";
			$limitVar   = ($limit == 0) ? "" : "LIMIT 0, ".$limit;
			$theQuery = "SELECT post_id FROM $table_name tbl";
			$theQuery .=" INNER JOIN $post_table_name tbl1 ON tbl.post_id=tbl1.id AND tbl1.post_modified>tbl.sync_time $timelimitTbl1";
			$theQuery .=" UNION";
			$theQuery .=" SELECT id FROM $post_table_name tbl LEFT JOIN $table_name tbl1 ON tbl1.post_id=tbl.id";
			$theQuery .=" WHERE tbl1.post_id is null ".$allowedFilter." $timelimitTbl";
			 if($getCount){									
					$query = "SELECT count(tblData.post_id) FROM ($theQuery) tblData"; 
			}else{
					$query = "$theQuery $limitVar"; 				
			}		
			$this->log_error("POST UPDATE QUERY", $addToLog);
			$this->log_error($query, $addToLog);
		}
		 if($getCount) {
			 return  $wpdb->get_var($query);
		 }else{
			$allPosts = $wpdb->get_results($query);
			if(count($allPosts) > 0){
				foreach($allPosts as $k=>$v){
					$syncPosts .= $v->post_id.",";
				}
				if(strlen($syncPosts) > 0){
					$syncPosts = substr($syncPosts, 0 , -1);
				}
			}
			return $syncPosts;
		 }
	}

	public function removeFromSync($postID = ""){
		global $wpdb;
		$table_name = $this->syncTableName();
		if($postID != ""){
			if(is_array($postID) && count($postID) > 0){
				$where =  " IN(".implode(',',$postID).") ";
			}else{
				$where =  " =".$postID;
			}
			$query = "DELETE FROM $table_name WHERE `post_id`".$where.";";
		}
		if($query != ""){
			$this->log_error($query);
			$wpdb->query($query);
		}
	}

	public function log_error($error, $onlySelected = false){
		if($this->useErrorLog == true || $onlySelected == true){
			$this->logError(true);
			error_log(print_r($error, true));
		}
	}

	public function logError($logError = false){
		$this->errorFileDir	= SIQ_BASE_PATH.'/error_logs';
		$this->errorFile	= $this->errorFileDir.'/error.log';
		if(!file_exists($this->errorFileDir)){
			@mkdir($this->errorFileDir, 0777, true);
		}else if(substr(fileperms($this->errorFileDir), 0, -3) != '777' ){
			@chmod($this->errorFileDir,0777);
		}

		$this->logErrors = $logError;
		if($this->logErrors){
			ini_set('error_log', $this->errorFile);
			if (!file_exists($this->errorFile)) {
				$fh = @fopen($this->errorFile, 'w');
				@fclose($fh);
				@chmod($this->errorFile,0777);
			}
		}
	}

	function getPluginSettings($param = ''){
		$setting		= array();

		foreach($this->pluginOptions as $k => $v){
			$setting[$k]		= get_option($v, NULL);
		}
		if (is_null($setting['mobile_enabled'])) {
			$setting['mobile_enabled'] = self::DEFAULT_MOBILE_ENABLED;
			$this->setMobileEnabled(self::DEFAULT_MOBILE_ENABLED);
		}
		if (is_null($setting['mobile_icon_enabled'])) $setting['mobile_icon_enabled'] = self::DEFAULT_MOBILE_ICON_ENABLED;
		if (is_null($setting['mobile_float_bar_enabled'])) $setting['mobile_float_bar_enabled'] = self::DEFAULT_MOBILE_FLOAT_BAR_ENABLED;
		if (is_null($setting['mobile_favicon_mode'])) $setting['mobile_favicon_mode'] = self::DEFAULT_MOBILE_FAVICON_MODE;
		if (is_null($setting['siq_crop_resize_thumb'])) $setting['siq_crop_resize_thumb'] = self::DEFAULT_CROP_RESIZE_THUMB;
		if (is_null($setting['siq_field_for_excerpt'])) $setting['siq_field_for_excerpt'] = "";
		if (is_null($setting['featureExcludeFields'])) $setting['featureExcludeFields'] = false;
		if (is_null($setting['isProPack'])) $setting['isProPack'] = false;
		if (is_null($setting['siq_postTypesForSearchSelection'])) $setting['siq_postTypesForSearchSelection'] = "";
		$this->pluginSettings		=	$setting;
		return $setting;
	}

	function includeClientAPI(){
		global $siqAPIClient;
		include_once(SIQ_BASE_PATH.'/library/siq-search-api-client.php');
		$siqAPIClient = new siq_search_api_client();
		$siqAPIClient->logErrors($this->logErrors);
		$siqAPIClient->siq_set_api_key($this->pluginSettings['auth_code']);
	}

	public function siq_delete_post($postID, $post_type){
		return $this->_siq_delete_post($postID, $post_type);
	}

	private function _siq_delete_post($postID, $post_type){
		global $siqAPIClient;
		$api_key 	= $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];
		try{
			$params['params'] 		= array();
			$params['callMethod'] 	= 'DELETE';
			$params['callUrl']		= 'searchEngines/'.$engineKey.'/documents/?externalId='.$postID;
			$response 				= $siqAPIClient->makeAPICall($params);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
			}
			$thumb = get_post_meta($postID, self::POST_THUMB_META_KEY, true);
			$thumbUrl = get_post_meta($postID, self::POST_THUMB_URL_META_KEY, true);
			$origImageUrl = get_post_meta($postID, self::POST_ORIG_IMG_URL_META_KEY, true);

			$thumbPath = preg_replace('/^([\w\W]+?)(\.[a-zA-Z]{3,4})$/', '$1_s$2', $thumb);

			delete_post_meta($postID, self::POST_THUMB_META_KEY);
			delete_post_meta($postID, self::POST_THUMB_URL_META_KEY);
			delete_post_meta($postID, self::POST_ORIG_IMG_URL_META_KEY);

			$this->updateIndexCount('d');
			$this->removeFromSync($postID);
			$this->deleteAttachments($postID);
		}catch(Exception $e){
			$result['success'] 		= false;
			$result['message'] 		= $e->getMessage();
		}
		return $result;
	}
	private function deleteAttachments($postID){
		$pdfs 	= $this->getPostAttachments($postID);
		if(count($pdfs) > 0){
			foreach($pdfs as $k => $pdf){
				$this->_siq_delete_post($pdf['externalId'], $pdf['documentType']);
			}
		}
		return;
	}
	
	public function delete_domain($data){
		return $this->_delete_domain($data);
	}

	private function _delete_domain(){
		global $siqAPIClient;
		$api_key 	= $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];
		try{
			$params['params'] 		= array();
			$params['callMethod'] 	= 'DELETE';
			$params['callUrl']		= 'account/domain/delete/'.$engineKey.'/'.$api_key;

			$response 				= $siqAPIClient->makeAPICall($params);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
			}

		}catch(Exception $e){
			$result['success'] 		= false;
			$result['message'] 		= $e->getMessage();
		}
		return $result;
	}

	public function siq_insert_post($postID, $post){
		return $this->_siq_insert_update_post($postID, $post);
	}

	public function siq_update_post($postID, $post){
		return $this->_siq_insert_update_post($postID, $post, true);
	}

	private function _siq_insert_update_post($postID, $post, $update = false){
		global $siqAPIClient;
		$api_key 	= $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];
		$this->upload_info = wp_upload_dir();
		$postBulkDocuments = false;
		try{
			$this->generateThumbnails($post);
			$document				= $this->createDocumentFromPost($post);
			$pdfs 					= $this->getPostAttachments($postID);
			if(count($pdfs) > 0){
				$documentTemp = $document;
				$document = array();
				$document[] = $documentTemp;
				$document = array_merge($document, $pdfs);
				$postBulkDocuments = true;
			}
			if(is_array($document) && count($document) > 0){
				$params['params'] 		= $document;
				$params['callMethod'] 	= 'POST';
				$params['callUrl']		= ($postBulkDocuments == false) ? 'searchEngines/'.$engineKey.'/documents': 'searchEngines/'.$engineKey.'/documents/bulk';
				$response 				= $siqAPIClient->makeAPICall($params);
				if($response['response_code'] != ""){
					$result				= $response['response_body'];
					if($postBulkDocuments == true){
						if($result['success'] == 1){
							if(array_key_exists("created", $result)){
								$created = (int)$result["created"];
								if($created > 0){
									$this->updateIndexCount('i', $created);
								}
							}
							foreach($document as $k => $v){
								$this->addToSync($v["externalId"]);
							}
						}
					}else{
						if($result['success'] == 1 && (strpos($result['message'], 'created') !== FALSE || strpos($result['message'], 'updated') !== FALSE)){
							if(strpos($result['message'], 'created') !== FALSE){
								$this->updateIndexCount('i');
							}
							$this->addToSync($postID);
						}
					}
				}
			}else{
				$result['success'] 			= false;
				$result['message'] 		= "Document exempted from indexing";
			}
		}catch(Exception $e){
			$result['success'] 		= false;
			if ($e->getMessage() == "Domain not found") {
				$result['message'] = "Search engine not found. Try to reset configuration and create new search engine.";
			} else {
				$result['message'] = $e->getMessage() . ", please try again after some time.";
			}
		}
		return $result;
	}
	private function getPostAttachments($postID){
		global $wpdb;
		$pdfsFinal 	= array();
		$pdfs 		= get_attached_media("application/pdf", $postID);
		if(count($pdfs) > 0){
			foreach($pdfs as $k => $pdf ){
				$pdfsFinal[] = $this->createDocumentFromPost($pdf);
			}
		}
		return $pdfsFinal;
	}
	private function removeAnyShortcodes($content){ // remove any shortcodes using REGEX
		$content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content);
		return $content;
	}

	public function strip_shortcodes_from_content( $content ) {
		$content    = wp_strip_all_tags($content);
		return $this->removeAnyShortcodes($content);  // Execute all shortcodes and later strip the html tags

	}
	public function isUrl($string){ // check if a url is valid
		$regex = '/^(?:http|https)?(?:\:\/\/)?(?:www.)?(([A-Za-z0-9-]+\.)*[A-Za-z0-9-]+\.[A-Za-z]+)(?:\/.*)?$/im';
		if(preg_match($regex, $string, $matches))  {
			return true;
		}
		return false;
	}

	public function removeUnicode(&$string = ""){
		// Function not required should be removed
		/*if(!$this->isUrl($string))  { // don't process url's
			$string = preg_replace('/[^\x20-\x7f]+/', '', $string);
		}*/
		return $string;
	}

	private function postNotToBeIndexed($post, $url = ""){
			$flagExempt = false;
			if($this->checkIfPostIsProductAndHidden($post)){
				$flagExempt = true;
			}
			
			if(!empty( $url) && $this->checkIfBackListed($url)){
				$flagExempt = true;
			}

			return $flagExempt;
	}
	
	private function checkIfBackListed($url = ""){
		if(!empty($url)){
			if(is_array($this->blackListUrls) && count($this->blackListUrls) > 0){
				foreach($this->blackListUrls as $k => $v){
					if(strpos($url, $v) !== FALSE){
						return true;
					}
				}
			}
		}
		return false;
	}

	private function checkIfPostIsProductAndHidden($post){
		if($post->post_type == "product" && $this->woocommerceActive){
			$postMeta = get_post_meta($post->ID, '', true);
			if(isset($post->meta_key) && isset($post->meta_value)) {
				$meta_keys = explode('<>', $post->meta_key);
				$meta_values = explode('<>', $post->meta_value);
				if(in_array("_visibility", $meta_keys)){
					$key 	= array_search("_visibility", $meta_keys);
					$value =  $meta_values[$key];
					if($value == "hidden"){
						return true;
					}
				}
			}else{
				$postMeta = get_post_meta($post->ID, '', true);
				if(array_key_exists("_visibility", $postMeta)){
					$value =  $postMeta['_visibility'][0]; 
					if($value == "hidden"){
						return true;
					}
				}
			}
		}
		return false;
	}
	private function getPostUrl($ID, $post_type, $post_mime_type, $guid){
		$url = "";
		switch($post_mime_type){
			case "application/pdf";
				$url = $guid;
				return $url;
			break;
			
			default:
				$url = get_permalink($ID);
				return $url;
		}
	}
	
	private function getPostType($postType, $post_mime_type){
		$postTypeFinal = "";
			switch($postType){
				case "attachment":
					$postTypeFinal = ($post_mime_type == "application/pdf" && !empty($this->postTypeForPDF)) ? $this->postTypeForPDF : $postType;
				break;
				
				default:
				$postTypeFinal = $postType;
			}
		
		return $postTypeFinal;
	}
	
	public function createDocumentFromPost($post){
		$image				= "";
		$dataForSubmission	= array();
		$postUrl = $this->getPostUrl($post->ID, $post->post_type, $post->post_mime_type, $post->guid);
		if($this->postNotToBeIndexed($post, $postUrl)){
			$this->siq_delete_post($post->ID, $post->post_type);
			return $dataForSubmission;
		}
        $title = html_entity_decode( strip_tags( $post->post_title ), ENT_QUOTES, "UTF-8" );
		$dataForSubmission["url"] 					= $postUrl;
		$dataForSubmission["title"] 				= $this->removeUnicode($title);
        $body = html_entity_decode( strip_tags( $this->strip_shortcodes_from_content( $post->post_content ) ), ENT_QUOTES, "UTF-8" );
		$dataForSubmission["body"] 					= $this->removeUnicode($body);
		$dataForSubmission["externalId"] 			= (int)$post->ID;
        $author = get_the_author_meta( 'display_name', $post->post_author );
		$authors	= array( $this->removeUnicode($author));
		$dataForSubmission["author"] 				= $authors;
		$dataForSubmission["documentType"]		 	= $this->getPostType($post->post_type, $post->post_mime_type);

        $excludeFields = (is_array($this->excludeCustomFields) && array_key_exists($post->post_type, $this->excludeCustomFields) && is_array($this->excludeCustomFields[$post->post_type])) ? $this->excludeCustomFields[$post->post_type] : array();

		$excludeTaxonomies = (array_key_exists($post->post_type, $this->excludeCustomTaxonomies) && is_array($this->excludeCustomTaxonomies[$post->post_type])) ? $this->excludeCustomTaxonomies[$post->post_type] : array();

		$wpcats = wp_get_post_categories( $post->ID );
		$cats = array();
		if(is_array($wpcats) && count($wpcats) > 0){
			foreach ($wpcats as $c) {
			    $cat    = get_cat_name( $c );
				$cats[] = $this->removeUnicode($cat);
			}
		}
		$wptags = get_the_tags( $post->ID );
		$tags 	= array();
		if( is_array( $wptags ) && count($wptags) > 0 ) {
			foreach( $wptags as $tag ) {
			    $tagName = $tag->name;
				$tags[]  = $this->removeUnicode($tagName);
			}
		}

		$dataForSubmission["categories"]			= $cats;
		$dataForSubmission["tags"]					= $tags;
		$dataForSubmission["timestamp"]				= date('Y-m-d\TH:i:s\.\0\0\0', strtotime($post->post_date_gmt));
		$excerptValue								= $post->post_excerpt;
		$dataForSubmission["excerpt"] 				=  html_entity_decode( strip_tags( $excerptValue), ENT_QUOTES, "UTF-8" );
		list($image, $imageUrl, $origImageUrl) 		= $this->get_images_from_post($post);

		if (!empty($origImageUrl)) {
			$dataForSubmission["image"] = array($imageUrl, $origImageUrl);
		} else {
			$dataForSubmission["image"] = "";
		}

		// add post taxomony info with post
		/**
		 * Array key is taxonomy name e.g. product_tag and product_cat
		 * Value is array of term names set for each post
		 */
		if($this->allTaxonomies!= "" && is_array($this->allTaxonomies) && count($this->allTaxonomies) > 0) {
			foreach($this->allTaxonomies as $taxonomy) {
				if(!in_array($taxonomy, $excludeTaxonomies)) {
					$terms = wp_get_post_terms($post->ID, $taxonomy);
					if ($terms != "" && count($terms) > 0) {
						foreach ($terms as $k => $v) {
							$termName = $v->name;
							$dataForSubmission[$this->customTaxonomyPrefix . $taxonomy][] = $this->removeUnicode($termName);
						}
					}
				}
			}
		}
        // add post meta info with post
		$meta_keys   = array();
		$meta_values = array();
		if(isset($post->meta_key) && isset($post->meta_value)) {
			$meta_keys = explode('<>', $post->meta_key);
			$meta_values = explode('<>', $post->meta_value);
			if ($meta_keys !="" && is_array($meta_keys) && count($meta_keys) > 0) {
				foreach ($meta_keys as $key => $value) {
					if ($meta_values[$key] != "" && !in_array($value, $this->metaFieldsSkipped) && !in_array($value, $excludeFields)) {
						if($this->woocommerceActive) {
							$attributes = $this->processWoocommerceAttributes($post->ID, $value, $meta_values[$key]);
							$dataForSubmission = array_merge($dataForSubmission, $attributes);
						}else{
						    $cfv = $meta_values[$key];
							$dataForSubmission[$this->customFieldPrefix.$value] = $this->removeUnicode($cfv);
						}
					}
				}
			}
		}else {
			$postMeta = get_post_meta($post->ID, '', true);
			if ($postMeta != "" && is_array($postMeta) && count($postMeta) > 0){
				foreach ($postMeta as $k => $v) {
					if($v[0] != "" && !in_array($k, $this->metaFieldsSkipped) && !in_array($k, $excludeFields)) {
						if($this->woocommerceActive){
							$attributes = $this->processWoocommerceAttributes($post->ID, $k, $v[0]);
							$dataForSubmission = array_merge($dataForSubmission, $attributes);
						}else{
						    $cfv_ = $v[0];
							$dataForSubmission[$this->customFieldPrefix.$k] = $this->removeUnicode($cfv_);
						}
					}
				}
			}
		}
        $this->addWooCommerceDataToDocument($dataForSubmission);

		return $dataForSubmission; 
	}

    private function parseWooCommercePrice($priceStr) {
        $priceStr = str_replace(wc_get_price_thousand_separator(), "", $priceStr);
        $priceStr = str_replace(wc_get_price_decimal_separator(), ".", $priceStr);
        return str_replace(" ", "", $priceStr);
    }

    private function addWooCommerceDataToDocument(&$document) {
        if ($document['documentType'] === 'product' && $this->woocommerceActive
            && !is_null($this->wcCurrencySymbol)) {
            $document['currencySymbol'] = $this->wcCurrencySymbol;
            $document['currencySymbolPosition'] = strtoupper($this->wcCurrencySymbolPos);
            $document['regularPrice'] = $this->parseWooCommercePrice($document["cf__regular_price"]) + 0.0;
            if (!empty($document['cf__sale_price'])) {
                $document['salePrice'] = $this->parseWooCommercePrice($document['cf__sale_price']) + 0.0;
            }
            if (!empty($document['cf__sale_price_dates_from'])) {
                $document['salePriceFromDate'] = siq_core::prepareDateFieldForSubmission($document['cf__sale_price_dates_from'], null);
            }
            if (!empty($document['cf__sale_price_dates_to'])) {
                $document['salePriceToDate'] = siq_core::prepareDateFieldForSubmission($document['cf__sale_price_dates_to'], null);
            }
            if (isset($document['cf__wc_average_rating']) && is_numeric($document['cf__wc_average_rating'])) {
                $document['rating'] = $document['cf__wc_average_rating'] + 0.0;
            }
            if (!empty($document['cf__wc_rating_count'])) {
                $document['ratingCount'] = (int) preg_replace('/^a:(\d+):[^$]+$/', '$1', $document['cf__wc_rating_count']);
            }
        }
    }

	public function isWoocommerceActive(){
		if(!function_exists("is_plugin_active")){
			include_once(ABSPATH.'wp-admin/includes/plugin.php');
		}
		if(is_plugin_active( 'woocommerce/woocommerce.php')){
			$this->woocommerceActive = true;
            if (function_exists("get_woocommerce_currency_symbol")) {
                $this->wcCurrencySymbol = get_woocommerce_currency_symbol();
                $this->wcCurrencySymbolPos = get_option('woocommerce_currency_pos');
                if (strlen(trim($this->wcCurrencySymbolPos)) == 0) $this->wcCurrencySymbolPos = self::DEFAULT_CURRENCY_POS;
            }
		}else{
			$this->woocommerceActive = false;
		}
	}

	private function processWoocommerceAttributes($ID, $name, $value){
		$attributes = array();
			switch($name){
				case "_product_attributes":
					$attributes = $this->getWoocommerceAttributes($ID, $value);
					break;

				case "_product_image_gallery":
					$attributes = $this->getWoocommerceGalleryImages($name, $value);
					break;

				default:
					$attributes[$this->customFieldPrefix.$name] = $this->removeUnicode($value);
			}
		return $attributes;
	}

	private function getWoocommerceAttributes($ID, $attribute){
		$attributes = array();
		$excludeTaxonomies = (is_array($this->excludeCustomTaxonomies) && array_key_exists('product', $this->excludeCustomTaxonomies) && is_array($this->excludeCustomTaxonomies['product']) ) ? $this->excludeCustomTaxonomies['product'] : array();
		if($attribute != "") {
			$attributeArr = maybe_unserialize($attribute);
			if($attributeArr != "" && is_array($attributeArr) && count($attributeArr) > 0) {
				foreach ($attributeArr as $k => $v) {
					if(!in_array($k, $excludeTaxonomies)) {
						if ($v['is_taxonomy'] == 1) {
							$termData = wc_get_product_terms($ID, $k, $this->woocommerceProductTermsArgs);
							if (is_array($termData) && count($termData) > 0) {
								array_walk($termData, array($this, 'removeUnicode'));
							}
							$attributes[$this->customAttributePrefix . $k] = $termData;
						} else if ($v['is_taxonomy'] == 0) {
							$attributes[$this->customAttributePrefix . $k] = $this->removeUnicode($v["value"]);
						} else {
							$attributes[$this->customAttributePrefix . $k] = $this->removeUnicode($v["value"]);
						}
					}
				}
			}
		}
		return $attributes;
	}
	
	private function getWoocommerceGalleryImages($name, $value){
		$images = array();
		if($value != ""){
			$valueArr = explode(',',$value);
			if($valueArr != "" && is_array($valueArr) && count($valueArr) > 0){
				$images[$this->customFieldPrefix.$name] = array();
				foreach($valueArr as $k => $v){
					array_push($images[$this->customFieldPrefix.$name], wp_get_attachment_url($v));
				}
			}
		}
		return $images;
	}

	public function getAllTaxonomies(){
		$args = array(
			'public'   => true,
			'_builtin' => false
		);
		$output         = 'names'; // or objects
		$operator       = 'and'; // 'and' or 'or'
		$taxonomies     = get_taxonomies( $args, $output, $operator );
		if($taxonomies !="" && is_array($taxonomies) && count($taxonomies) > 0){
			$this->allTaxonomies = $taxonomies;
		}

		$args = array(
			'_builtin' => false,
			'show_ui'   => 1
		);
		$output         = 'objects'; // or objects
		$operator       = 'and'; // 'and' or 'or'
		$taxonomies     = get_taxonomies( $args, $output, $operator );

		if($taxonomies !="" && is_array($taxonomies) && count($taxonomies) > 0){
			foreach($taxonomies as $k => $taxonomy){
				foreach($taxonomy->object_type as $objectType){
					if(!array_key_exists($objectType, $this->allTaxonomiesWithPostType)){
						$this->allTaxonomiesWithPostType[$objectType] =  array();
					}
					array_push($this->allTaxonomiesWithPostType[$objectType], array('label'=>$taxonomy->labels->name, 'name'=>$taxonomy->name));
				}
			}
		}
	}

    protected function getCommonTaxonomies() {
        $postTypes = array_values($this->getAllpostTypes());
        $allTaxonomies = array();
        foreach ($postTypes as $postType) {
            array_push($allTaxonomies, $this->getPostTypeTaxonomies($postType));
        }
        return array_reduce($allTaxonomies, function($a, $b) {
            if (is_null($a)) {
                return $b;
            } else {
                return array_intersect($a, $b);
            }
        });
    }

    protected function getPostTypeTaxonomies($postType) {
        return get_object_taxonomies($postType, 'names');
    }

	protected function getTaxonomyTerms($taxonomy){
		$terms = get_terms( array(
			'taxonomy' => $taxonomy,
			'hide_empty' => false,
		) );
		if($terms != "" && is_array($terms) && count($terms) > 0){
			return $terms;
		}else{
			return array();
		}
	}

	private function get_images_from_post($post) {
		$thumb = get_post_meta($post->ID, self::POST_THUMB_META_KEY, true);
		$thumbUrl = get_post_meta($post->ID, self::POST_THUMB_URL_META_KEY, true);
		$origImageUrl = get_post_meta($post->ID, self::POST_ORIG_IMG_URL_META_KEY, true);

		if ($thumb == null) $thumb = "";
		if ($thumbUrl == null) $thumbUrl = "";

		if ($origImageUrl == "") {
			$origImageUrl = $this->get_orig_post_image($post);
			delete_post_meta($post->ID, self::POST_ORIG_IMG_URL_META_KEY);
			add_post_meta($post->ID, self::POST_ORIG_IMG_URL_META_KEY, $origImageUrl, true);
		}

		$thumbPath = preg_replace('/^([\w\W]+?)(\.[a-zA-Z]{3,4})$/', '$1_s$2', $thumb);

		if (!file_exists($thumbPath)) {
			$thumb = "";
			$thumbUrl = "";
		}

		return array($thumb, $thumbUrl, $origImageUrl);
	}

	protected function getPostImageCustomField($postType){
		$pluginSettingsICF = $this->pluginSettings["image_custom_field"];
		if($pluginSettingsICF != "" && strpos($pluginSettingsICF, ':') !== FALSE) {
			$pluginSettingArrICF = array();
			$pluginSettingArrICFFinal = array();
			if ($pluginSettingsICF != "") {
				$pluginSettingArrICF = explode(',', $pluginSettingsICF);
				if ($pluginSettingArrICF != "" && count($pluginSettingArrICF) > 0) {
					foreach ($pluginSettingArrICF as $k => $v) {
						$settingsICF = explode(':', $v);
						$pluginSettingArrICFFinal[$settingsICF[0]] = $settingsICF[1];
					}
				}
			}
			if (count($pluginSettingArrICFFinal) > 0 && !empty($pluginSettingArrICFFinal[$postType])) {
				return $pluginSettingArrICFFinal[$postType];
			}
		}else{
			return $pluginSettingsICF;
		}
		return "";
	}
	protected function getFieldForExcerpt($postType = ""){
		$pluginSettingsICF = $this->pluginSettings["siq_field_for_excerpt"];
		if($pluginSettingsICF != "" && strpos($pluginSettingsICF, ':') !== FALSE) {
			$pluginSettingArrICF = array();
			$pluginSettingArrICFFinal = array();
			if ($pluginSettingsICF != "") {
				$pluginSettingArrICF = explode(',', $pluginSettingsICF);
				if ($pluginSettingArrICF != "" && count($pluginSettingArrICF) > 0) {
					foreach ($pluginSettingArrICF as $k => $v) {
						$settingsICF = explode(':', $v);
						if( isset($settingsICF[0]) && !empty($settingsICF[0])){
							$pluginSettingArrICFFinal[$settingsICF[0]] = $settingsICF[1];
						}
					}
				}
			}
			if ($postType != "" && count($pluginSettingArrICFFinal) > 0 && !empty($pluginSettingArrICFFinal[$postType])) {
				return $pluginSettingArrICFFinal[$postType];
			}else{
				return $pluginSettingArrICFFinal;
			}
		}else{
			return $pluginSettingsICF;
		}
		return "";
	}
	
    protected function getExcludedCustomFields($postType = ""){
        $pluginSettingsECF = $this->pluginSettings["exclude_custom_fields"];
        if($pluginSettingsECF != "" && strpos($pluginSettingsECF, ';') !== FALSE) {
            $pluginSettingsArrECF = array();
            $pluginSettingArrECFFinal = array();
            $pluginSettingArrECF = explode(';', $pluginSettingsECF);
            if ($pluginSettingArrECF != "" && count($pluginSettingArrECF) > 0) {
                foreach ($pluginSettingArrECF as $k => $v) {
                    $settingsICF = explode(':', $v);
                    $pluginSettingArrECFFinal[$settingsICF[0]] = (!empty($settingsICF[1])) ? explode(',',$settingsICF[1]) : array();
                }
            }
            if ($postType != "" && count($pluginSettingArrECFFinal) > 0 && !empty($pluginSettingArrECFFinal[$postType])) {
                return $pluginSettingArrECFFinal[$postType];
            }else{
                return $pluginSettingArrECFFinal;
            }
        }else if($pluginSettingsECF != "" && strpos($pluginSettingsECF, ':') !== FALSE){
	        $settingsICF = explode(':', $pluginSettingsECF);
	        $pluginSettingArrECFFinal = array();
	        $pluginSettingArrECFFinal[$settingsICF[0]] = (!empty($settingsICF[1])) ? explode(',',$settingsICF[1]) : array();
	        if ($postType != "" && count($pluginSettingArrECFFinal) > 0 && !empty($pluginSettingArrECFFinal[$postType])) {
		        return $pluginSettingArrECFFinal[$postType];
	        }else{
		        return $pluginSettingArrECFFinal;
	        }
        }else{
            return (is_array($pluginSettingsECF) ? $pluginSettingsECF : array());
        }
        return array();
    }

	protected function getExcludedCustomTaxonomies($postType = ""){
		$pluginSettingsECF = $this->pluginSettings["exclude_custom_taxonomies"];
		if($pluginSettingsECF != "" && strpos($pluginSettingsECF, ';') !== FALSE) {
			$pluginSettingsArrECF = array();
			$pluginSettingArrECFFinal = array();
			$pluginSettingArrECF = explode(';', $pluginSettingsECF);
			if ($pluginSettingArrECF != "" && count($pluginSettingArrECF) > 0) {
				foreach ($pluginSettingArrECF as $k => $v) {
					$settingsICF = explode(':', $v);
					$pluginSettingArrECFFinal[$settingsICF[0]] = (!empty($settingsICF[1])) ? explode(',',$settingsICF[1]) : array();
				}
			}
			if ($postType != "" && count($pluginSettingArrECFFinal) > 0 && !empty($pluginSettingArrECFFinal[$postType])) {
				return $pluginSettingArrECFFinal[$postType];
			}else{
				return $pluginSettingArrECFFinal;
			}
		}else if($pluginSettingsECF != "" && strpos($pluginSettingsECF, ':') !== FALSE){
			$settingsICF = explode(':', $pluginSettingsECF);
			$pluginSettingArrECFFinal = array();
			$pluginSettingArrECFFinal[$settingsICF[0]] = (!empty($settingsICF[1])) ? explode(',',$settingsICF[1]) : array();
			if ($postType != "" && count($pluginSettingArrECFFinal) > 0 && !empty($pluginSettingArrECFFinal[$postType])) {
				return $pluginSettingArrECFFinal[$postType];
			}else{
				return $pluginSettingArrECFFinal;
			}
		}else{
			return (is_array($pluginSettingsECF) ? $pluginSettingsECF : array());
		}
		return array();
	}

    protected function getExcludedPostIds(){
        $pluginExcludePosts = $this->pluginSettings["exclude_posts"];
        if($pluginExcludePosts != ""){
            $pluginExcludePostsArr      = explode(',',$pluginExcludePosts);
            $pluginExcludePostsFinalArr = array();
            if(count($pluginExcludePostsArr) > 0){
                foreach($pluginExcludePostsArr as $post){
                    if(!empty($post) && (int)$post > 0){
                        array_push($pluginExcludePostsFinalArr, (int)$post);
                    }
                }
            }
            if(count($pluginExcludePostsFinalArr) > 0){
                return implode(',',$pluginExcludePostsFinalArr);
            }
        }
        return "";
    }

	private function get_orig_post_image($post) {
		$origImageUrl = "";
		$imgCustomField = $this->getPostImageCustomField($post->post_type);
		if (!empty($imgCustomField)) {
			$metaValue = get_post_meta($post->ID, $imgCustomField, true);
			if (!empty($metaValue)) {
				if (is_array($metaValue) && !empty($metaValue['url'])) {
					$origImageUrl = $metaValue['url'];
				} else if (is_numeric($metaValue)) {
					$origImageUrl = wp_get_attachment_url($metaValue, "full");
				} else if (is_string($metaValue) && preg_match('/^https?:\/\/[^$]+/', $metaValue)) {
					$origImageUrl = $metaValue;
				}
			}
		}
		if ( $origImageUrl == "" && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) ) {
			$origImageUrl = wp_get_attachment_url( get_post_thumbnail_id( $post->ID) );
		}
		if($origImageUrl == ""){
			$origImageUrl = $this->getImageFromHtml($post);
		}
		return $origImageUrl;
	}

	public function generateThumbnails($post){
		$this->log_error("POSTID: ".$post->ID);

		list($image, $imageUrl, $origImageUrl) = $this->get_images_from_post($post);

		$this->log_error("saved images: " . $image . " :: " . $imageUrl . " :: " . $origImageUrl);

		$latestOrigImage = $this->get_orig_post_image($post);
		// if image exists then create thumbnail
		$thumbPath = $image != "" ? preg_replace('/^([\w\W]+?)(\.[a-zA-Z]{3,4})$/', '$1_s$2', $image) : "";
		if($origImageUrl != "") { // If original image is not empty generate the thumbnail
			if(file_exists($thumbPath)){ // If thumbnail is already present. Delete that first
				$this->log_error("EXISTING THUMB PATH: " . $thumbPath);
				@unlink($thumbPath);
			}
			if ($origImageUrl != $latestOrigImage) {
				$origImageUrl = $latestOrigImage;
				delete_post_meta($post->ID, self::POST_ORIG_IMG_URL_META_KEY);
				if (empty($origImageUrl)) {
					delete_post_meta($post->ID, self::POST_THUMB_META_KEY);
					delete_post_meta($post->ID, self::POST_THUMB_URL_META_KEY);
					return;
				}
				add_post_meta($post->ID, self::POST_ORIG_IMG_URL_META_KEY, $origImageUrl, true);
			}
			delete_post_meta($post->ID, self::POST_THUMB_META_KEY);
			delete_post_meta($post->ID, self::POST_THUMB_URL_META_KEY);
			list($image, $imageUrl) = $this->generateSmallThumbnails($post, $origImageUrl);
			$this->log_error("NEW THUMBNAIL GENERATED: " . $image . " :: " . $imageUrl);
			add_post_meta($post->ID, self::POST_THUMB_META_KEY, str_replace("\\", "/", $image), true);
			add_post_meta($post->ID, self::POST_THUMB_URL_META_KEY, $imageUrl, true);
		} else if ($image == "" || $imageUrl == "") {
			delete_post_meta($post->ID, self::POST_THUMB_META_KEY);
			delete_post_meta($post->ID, self::POST_THUMB_URL_META_KEY);
		}
	}

	/**
	 * This method creates thumbnail for autocomplete with `_s` suffix before extension and returns thumbnail path and URL without `_s`
	 * @param type $post
	 * @param type $image
	 * @return boolean
	 */
	public function generateSmallThumbnails($post, $image){
		$this->upload_info	=	wp_upload_dir();
		$deleteBeforeExit = false;
		if ($this->isNativeImage($image)) {
			$imagePath = preg_replace('/\/{2,}/', '/', str_ireplace($this->currentHost, ABSPATH, $image));
		} else {
			list($image, $imagePath) = $this->downloadRemoteImage($image, $post->ID);
			$deleteBeforeExit = true;
		}

		if ($image != "" && $imagePath != "") {
			list($width, $height, $type, $attr) = @getimagesize($imagePath);
			$changeImage = 0;
			if ($width > $height) {
				$this->imageWidth = $height;
				$this->imageHeight = $height;
				$changeImage = 1;
			} else if ($height > $width) {
				$this->imageWidth = $width;
				$this->imageHeight = $width;
				$changeImage = 1;
			}

			$src_info = pathinfo($imagePath);
			$croppedThumbPath = $src_info['dirname'] . '/' . $src_info['filename'] . "_s." . $src_info['extension'];
			$croppedThumbUrl = str_replace($this->upload_info['basedir'], $this->upload_info['baseurl'], $croppedThumbPath);

			if ($changeImage == 1) {
				$croppedImagePath = $src_info['dirname'] . '/' . $src_info['filename'] . "_" . $this->imageWidth . "X" . $this->imageHeight . "." . $src_info['extension'];
			} else {
				$croppedImagePath = $src_info['dirname'] . '/' . $src_info['basename'];
			}
			$croppedImageUrl = str_replace($this->upload_info['basedir'], $this->upload_info['baseurl'], $croppedImagePath);
			$this->log_error("CroppedImageUrl: " . $croppedImageUrl);
			if (!file_exists($croppedThumbPath)) {
				$imageT = $this->checkResizedImage($croppedImagePath, $croppedImageUrl, $imagePath, $changeImage);
				if ($imageT != "") {
					$this->generateTheImage($croppedThumbPath, $croppedThumbUrl, $croppedImagePath, $this->smallImageWidth, $this->smallImageHeight);

				}
			} else {
				$this->log_error("AlreadyExists: " . $croppedThumbUrl);
				$changeImage = 0;
			}

			if ($changeImage && file_exists($croppedImagePath)) {
				@unlink($croppedImagePath);
			}
			if ($deleteBeforeExit && file_exists($imagePath)) {
				@unlink($imagePath);
			}

		}
		return array($imagePath, $image);
	}

	public function generateTheImage( $croppedImagePath, $croppedImageUrl, $imagePath, $width, $height){
		$imageArr = wp_get_image_editor($imagePath);
		if ( ! is_wp_error( $imageArr ) ) {
			if($this->pluginSettings["siq_crop_resize_thumb"] == self::DEFAULT_CROP_RESIZE_THUMB){
				$imageArr->resize( $width, $height, true ); // crop the thumbs
			}else{
				$imageArr->resize( $width, $height, false ); // resize the thumbs
			}
			$image = $croppedImageUrl;
			$this->log_error("GeneratedNew: ".$croppedImagePath);
			$imageArr->save($croppedImagePath);
			//update_post_meta($post->ID, '_siq_post_thumb', $croppedImageUrl);
			$image = $croppedImageUrl;
			return $image;
		}else{
			$this->log_error("ImageSaveError: ".$imageArr->get_error_message());
		}
	}

	public function checkResizedImage($croppedImagePath, $croppedImageUrl, $imagePath, $changeImage){
		$this->upload_info = wp_upload_dir();
		if(file_exists($croppedImagePath) && $changeImage == 0){
			$image = $croppedImageUrl;
			$this->log_error("AlreadyExists: ".$croppedImageUrl);
		}else{
			$this->log_error("GenerateThumbPath: ".$croppedImagePath."\nBaseDir: ".$this->upload_info['basedir']."\nGenerateThumb: ".$croppedImageUrl." \nimagePath: ".$imagePath);
			$image = $this->generateTheImage( $croppedImagePath, $croppedImageUrl, $imagePath, $this->imageWidth, $this->imageHeight);
		}
		return $image;
	}

	public function checkIfThumbnailCanBeCreated($image){
		$flag = 0;
		$ext  = substr(strrchr($image,'.'),1);
		if(in_array($ext, $this->supported_image) && strpos($image, '/cdn') == FALSE){
			$imageHeaders = get_headers($image);
			if(count($imageHeaders) > 0 && strpos($imageHeaders[0], '404') == FALSE){
				$flag = 1;
			}
		}

		return $flag;
	}

	public function getImageFromHtml($post){
		$content = $post->post_content;
		$image	= "";
		$img 	= array();
		if($content != ""){
			preg_match_all('/<img[^>]+>/i',$content, $results);
			if(count($results) > 0){
				$img[] = $results[0];
				if(count($img) > 0){
					foreach( $img as $img_tag){
					    if(isset($img_tag[0])) {
                            preg_match('#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im', $img_tag[0], $resultsArr);
                            if (count($resultsArr) > 0) {
                                $image = $resultsArr[2];
                                break;
                            }
                        }
					}
				}
			}
		}
		return $image;
	}

	private function isNativeImage($image) {
		if (stripos(strtolower($image), strtolower($this->currentHost)) !== FALSE) {
			return true;
		} else {
			return false;
		}
	}

	public function checkIfNativeImage($image, $postId, $generate = true, $returnUrl = true, &$imagePathJustCreated = "", &$downloaded = false){
		$this->log_error("CurrentHost: ".$this->currentHost."\n Image: ".$image);
		if(strpos(strtolower($image), strtolower($this->currentHost)) !== FALSE){
			$this->log_error("nativeImage:".$image);
			$imagePathJustCreated = str_ireplace($this->currentHost, ABSPATH, $image);
			if($returnUrl){
				return $image;
			}else{
				return str_ireplace($this->currentHost, ABSPATH, $image);
			}
		}else{
			$image = $this->createThumb($image, $generate, $returnUrl, $postId, true, true, $imagePathJustCreated);
			$downloaded = true;
			$this->log_error("remoteImage:".$image);

		}

		return $image;
	}

	private function downloadRemoteImage($image, $postId) {
		$this->upload_info = wp_upload_dir();
		$src_info 	= pathinfo($image);
		if (empty($src_info['extension']) && function_exists("getimagesize")) {
			$tmpImageSize = getimagesize($image);
			if (!empty($tmpImageSize['mime'])) {
				$mime = strtolower($tmpImageSize['mime']);
				switch($mime) {
					case "image/gif":
						$src_info['extension'] = "gif";
						break;
					case "image/jpeg":
					case "image/pjpeg":
						$src_info['extension'] = "jpg";
						break;
					case "image/png":
						$src_info['extension'] = "png";
						break;
				}
			}
		}

		if(!is_null($src_info) && count($src_info) > 0 && $src_info['extension'] != "" && in_array($src_info['extension'], $this->supported_image)){
			$sourceFile	= $src_info["filename"]."-".$postId;

			$sourceFile = md5($sourceFile);
			$thumb_name = $sourceFile.".".$src_info['extension'];
			$thumb_path = $this->upload_info['path'].'/'.$thumb_name;
			$thumb_url = $this->upload_info['url'].'/'.$thumb_name;
			$thumb_path_s = preg_replace('/^([\w\W]+?)(\.[a-zA-Z]{3,4})$/', '$1_s$2', $image);

			if (!file_exists($thumb_path_s) && !@copy($image, $thumb_path)) {
				$this->log_error('NotCopied: ' . $image. " to " . $thumb_path);
				return array("", "");
			}

			return array($thumb_url, $thumb_path);
		}
		return array("", "");
	}


	public function createThumb($src_url='', $generate = false, $returnUrl = true, $postID = "", $crop = true, $cached = true, &$imagePathJustCreated = ""){

		if ( empty( $src_url ) ) return false;

		$this->upload_info = wp_upload_dir();
		$src_info 	= pathinfo($src_url);
		if (empty($src_info['extension']) && function_exists("getimagesize")) {
			$tmpImageSize = getimagesize($src_url);
			if (!empty($tmpImageSize['mime'])) {
				$mime = strtolower($tmpImageSize['mime']);
				switch($mime) {
					case "image/gif":
						$src_info['extension'] = "gif";
						break;
					case "image/jpeg":
					case "image/pjpeg":
						$src_info['extension'] = "jpg";
						break;
					case "image/png":
						$src_info['extension'] = "png";
						break;
				}
			}
		}
		$sourceFile	= md5($src_info["filename"]."-".$postID);
		$upload_dir = $this->upload_info['basedir'];
		$upload_url = $this->upload_info['baseurl'];
		if(!is_null($src_info) && count($src_info) > 0 && $src_info['extension'] != "" && in_array($src_info['extension'], $this->supported_image)){
			$thumb_name = $sourceFile.".".$src_info['extension'];
			$thumbS_name = $sourceFile."_s.".$src_info['extension'];
			$thumb_pathS = '';

			if ( FALSE === stripos( $src_url,  $this->homeUrl) ){
				$thumb_path = $this->upload_info['path'].'/'.$thumb_name;
				$thumb_pathS = $this->upload_info['path'].'/'.$thumbS_name;
				$thumb_url = $this->upload_info['url'].'/'.$thumb_name;
				if($generate){
					if ((!file_exists($thumb_pathS)) && !file_exists($thumb_path) && !@copy($src_url, $thumb_path)) {
						$this->log_error('NotCopied: ' . $src_url. " to " . $thumb_path);
						return false;
					}
				}
			}else{
				// define path of image
				$source_path = str_ireplace( $upload_url,$upload_dir, $src_url );
				//$source_path = $this->upload_dir . $rel_path;
				$source_path_info = pathinfo($source_path);
				if(!is_null(source_path_info) && count($source_path_info) > 0 && $source_path_info['extension'] != "" && in_array($src_info['extension'], $this->supported_image)){
					$thumb_name = $sourceFile.".".$source_path_info['extension'];
					$thumb_path = $source_path_info['dirname'].'/'.$thumb_name;
					$thumb_pathS = $source_path_info['dirname'].'/'.$thumbS_name;
					$thumb_rel_path = str_replace( $upload_dir, '', $thumb_path);
					$thumb_url = $upload_url . $thumb_rel_path;
				}
			}

			if(file_exists($thumb_path) || (file_exists($thumb_pathS))) {
				$imagePathJustCreated = $thumb_path;
				if($returnUrl == false){
					return $thumb_path;
				}else{
					return $thumb_url;
				}
			}
			if($generate){
				$editor = wp_get_image_editor( $source_path );
				$new_image_info = $editor->save( $thumb_path );
				if(empty($new_image_info)) return false;
				$imagePathJustCreated = $thumb_path;
				if($returnUrl == false){
					return $thumb_path;
				}else{
					return $thumb_url;
				}
			}else{
				$imagePathJustCreated = $thumb_path;
				if($returnUrl == false){
					return $thumb_path;
				}else{
					return $thumb_url;
				}
			}

		}else{
			$this->log_error("thumbPath: No Source");
		}
		return false;
	}

	public function verify_auth($data){
		return $this->_verify_auth($data);
	}


	private function _verify_auth($data){
		global $siqAPIClient;

		try{
			$params['params'] 		= array('username'=>$data['username'], 'password' => $data['password']);
			$params['callMethod'] 	= 'GET';
			$params['callUrl']		= 'users/apiKey';
			$params['auth']		    = true;
			$params['body']		    = true;
			$response 				= $siqAPIClient->makeAPICall($params, false);

			if($response['response_code'] != "" && $response['response_body']['success'] == true){
				if($response['response_body'] != "" && count($response['response_body']) > 0){
					$result['response']	= $response['response_body'];
					$result['message']	= "ok";
				}else{
					$result['message']	= $response['response_message'];
				}

			}else{
				$message = $response['response_body']['message'];
				if(strpos(strtolower($message), '<!doctype') !== FALSE || strpos(strtolower($message), 'unauthorized') !== FALSE){
					$errorMsg = "Invalid username or password";
				}else{
					$errorMsg = $message.", please try again.";
				}
				$result['success'] 		= false;
				$result['message'] 		= $errorMsg;
			}

		}catch(Exception $e){
			$message 	= $e->getMessage();
			$errorMsg 	= $e->getMessage();
			if(strpos(strtolower($message), '<!doctype') !== FALSE || strpos(strtolower($message), 'unauthorized') !== FALSE){
				$errorMsg = "Invalid username or password";
			}else{
				$errorMsg = $errorMsg.", please try again after some time.";
			}
			$result['success'] 		= false;
			$result['message'] 		= $errorMsg;
		}
		return $result;
	}

	public function verify_subscription($data){
		return $this->_verify_subscription($data);
	}


	private function _verify_subscription($data){
		global $siqAPIClient;

		try{
			$params['params'] 		= array('apiKey'=>$data['api_key']);
			$activation_status 		= $this->pluginSettings["siq_activated"];
			if($activation_status !== false && !empty($activation_status)){
					$params['params']['id'] =  $activation_status;
			}
			$params['callMethod'] 	= 'GET';
			$params['callUrl']		= 'searchEngines';
			$params['verify']		= true;
			$response 				= $siqAPIClient->makeAPICall($params, true);

			if($response['response_code'] != "" && $response['response_body']['success'] == true){
				if($response['response_body'] != "" && count($response['response_body']) > 0){
					$result['response']	= $response['response_body'];
					$result['message']	= "ok";
					$result['success']	= true;
				}else{
					$result['success']	= false;
					$result['message']	= $response['response_message'];
				}

			}else{
				$message = $response['response_body']['message'];
				if(strpos(strtolower($message), '<!doctype') !== FALSE || strpos(strtolower($message), 'unauthorized') !== FALSE){
					$errorMsg = "Enter valid API key";
				}else{
					$errorMsg = $message.", please try again.";
				}
				$result['success'] 		= false;
				$result['message'] 		= $errorMsg;
			}

		}catch(Exception $e){
			$message 	= $e->getMessage();
			$errorMsg 	= $e->getMessage();
			if(strpos(strtolower($message), '<!doctype') !== FALSE || strpos(strtolower($message), 'unauthorized') !== FALSE){
				$errorMsg = "Enter valid API key";
			}else{
				$errorMsg = $errorMsg.", please try again after some time.";
			}
			$result['success'] 		= false;
			$result['message'] 		= $errorMsg;
		}
		return $result;
	}

	public function submit_for_indexing($data, $total = 0){
		return $this->_submit_for_indexing($data, $total);
	}

	private function _submit_for_indexing($data, $total = 0){
		global $siqAPIClient;
		$api_key 	= $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];

		try{
			$params['params'] 		= $data;
			$params['callMethod'] 	= 'POST';
			$params['callUrl']		= 'searchEngines/'.$engineKey.'/documents/bulk';
			$response 				= $siqAPIClient->makeAPICall($params, true);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
				$result['response_code'] = $response['response_code'];
				if($response['response_body']['total'] > 0 || ($response['response_body']['total'] == 0 && count($response['response_body']['unsupported_document_type']) == $total)){
					$result['success'] = true;
					$result['response_body'] = $response["response_body"];
				}
			}

		}catch(Exception $e){
			$result['success'] 		= false;
			if ($e->getMessage() == "Domain not found") {
				$result['message'] = "Search engine not found. Try to reset configuration and create new search engine.";
			} else {
				$result['message'] = $e->getMessage() . ", please try again after some time.";
			}
		}
		return $result;
	}

	public function submit_for_bulk_deletion($data){
		return $this->_submit_for_bulk_deletion($data);
	}

	private function _submit_for_bulk_deletion($data){
		global $siqAPIClient;
		$api_key 	= $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];

		try{
			$params['params'] 		= $data;
			$params['callMethod'] 	= 'DELETE';
			$params['callUrl']		= 'searchEngines/'.$engineKey.'/documents/bulk';
			$response 				= $siqAPIClient->makeAPICall($params, true);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
				$result['response_code'] = $response['response_code'];
				if($response['response_body']['total'] > 0 || ($response['response_body']['total'] == 0 && count($response['response_body']['unsupported_document_type']) == $total)){
					$result['success'] = true;
					$result['response_body'] = $response["response_body"];					
				}
			}

		}catch(Exception $e){
			$result['success'] 		= false;
			if ($e->getMessage() == "Domain not found") {
				$result['message'] = "Search engine not found. Try to reset configuration and create new search engine.";
			} else {
				$result['message'] = $e->getMessage() . ", please try again after some time.";
			}
		}
		return $result;
	}
	
	public function submit_engine($data){
		return $this->_submit_engine($data);
	}

	private function _submit_engine($data){
		global $siqAPIClient;
		$api_key = $siqAPIClient->siq_get_api_key();

		try{
			$params['params'] 		= array('name'=>$data['name'], 'domain'=>$data['domain']);
			$params['callMethod'] 	= 'POST';
			$params['callUrl']		= 'searchEngines';
			$response 				= $siqAPIClient->makeAPICall($params);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
			}
		}catch(Exception $e){
			$result['success'] 		= false;
			$result['message'] 		= $e->getMessage().", please try again after some time.";;
		}

		return $result;
	}

	public function log_api($data){
		return $this->_log_api($data);
	}

	private function _log_api($data){
		global $siqAPIClient;
		$api_key 		= $siqAPIClient->siq_get_api_key();
		$engineKey		= $this->pluginSettings['engine_code'];
		$engineToken	= $this->pluginSettings['engine_token'];
		try{

			$params['params'] 		= array();
			$params['callMethod'] 	= 'PUT';
			if($data['type'] == 'search'){
				$params['callUrl']		= 'search/click/log?q='.$data['search_query'].'&documentId='.$data['id'].'&engineKey='.$engineKey.'';
				if($data['is_custom_search'] == 1){
					$params['callUrl'].= "&target=search_page";
				}

			}else if($data['type'] == 'autocomplete'){
				$params['callUrl']		= 'search/click/log?q='.$data['search_query'].'&documentId='.$data['id'].'&engineToken='.$engineToken.'';
			}

			$response 				= $siqAPIClient->makeAPICall($params);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
			}
		}catch(Exception $e){
			$result['success'] 		= false;
			$result['message'] 		= $e->getMessage().", please try again after some time.";;
		}
		return $result;

	}

	public function siq_search($query, $params){
		return $this->_siq_search($query, $params);
	}

	private function _siq_search($query, $params){
		global $siqAPIClient;
		$api_key = $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];

		try{
			$params['params'] 		= array('q'=>$query, 'engineKey' => $engineKey, 'documentTypes'=> $params['documentTypes'], 'page' => $params['page'], 'itemsPerPage' => $params['itemsPerPage'], 'target'=>'search_page');
			$params['callMethod'] 	= 'GET';
			$params['callUrl']		= 'search/results';
			$response 				= $siqAPIClient->makeAPICall($params, false);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
			}
		}catch(Exception $e){
			$result['success'] 		= false;
			$result['message'] 		= $e->getMessage().", please try again after some time.";;
		}
		return $result;
	}

	public function delete_all_posts(){
		return $this->_delete_all_posts();
	}

	private function _delete_all_posts(){
		global $siqAPIClient;
		$api_key = $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];
		try{
			$params['params'] 		= array();
			$params['callMethod'] 	= 'DELETE';
			$params['callUrl']		= 'searchEngines/'.$engineKey.'/documents/all';
			$response 				= $siqAPIClient->makeAPICall($params, true);
			if($response['response_code'] != ""){
				$result				= $response['response_body'];
			}
		}catch(Exception $e){
			$result['success'] 		= false;
			if ($e->getMessage() == "Domain not found") {
				$result['message']      = "Search engine not found. Taking you to search engine creation step. Please wait..";
				$result['searchengine'] = false;
				$this->searchEngineNotFound();
			} else {
				$result['message'] = $e->getMessage() . ", please try again after some time.";
			}
		}
		return $result;
	}

	public function updateIndexCount($action = 'i', $count = 1){
		$value = (int)get_option('_siq_num_indexed_posts', 0);
		if($action == 'i'){
			$value = $value + $count;
			update_option('_siq_num_indexed_posts', $value);
		}else if($action == 'd'){
			$value = ($value > 0 )? $value - $count: 0;
			update_option('_siq_num_indexed_posts', $value);
		}
	}

	public function _siq_set_option($key, $value, $delete = false){
		if(!$delete){
			update_option($key,$value);
		}else{
			delete_option($key);
		}
	}

	public function decodeServerResponse($res){
		$responseArray = array();
		if( is_wp_error( $res ) ) {
			$msg = "";
			$msg = $res->get_error_message();
			if(strpos($msg, "Connection refused") !== FALSE){
				$msg = "issues";
			}
			$responseArray['success'] 	= false;
			$responseArray['message'] 	= $msg;
			$retrieve_response_code		= 500;
		}else{
			$retrieve_response_code 	= wp_remote_retrieve_response_code( $res );
			$retrieve_response_message 	= wp_remote_retrieve_response_message( $res );

			if( ($retrieve_response_code >= 200 && $retrieve_response_code < 300) || $retrieve_response_code == 403 || $retrieve_response_code == 401) {
				$response_body = wp_remote_retrieve_body( $res );
				$responseArray = json_decode($response_body, true);
				if(is_array($responseArray)){
					//$responseArray['success'] = true;
					if(strpos($responseArray['message'], "Connection refused") !== FALSE || strpos($responseArray['message'], "experiencing temporary") !== FALSE){
						$responseArray['message'] = "issues";
					}
				}else if($response_body != "" && ($retrieve_response_code == 403 || $retrieve_response_code == 401)){
					$responseArray = array();
					$responseArray['success'] = false;
					$responseArray['message'] = $response_body;
				}else if($response_body != ""){
					$responseArray = array();
					$responseArray['success'] = true;
					$responseArray['message'] = $response_body;
				}else if($retrieve_response_message !=""){
					$responseArray = array();
					$responseArray['success'] = true;
					$responseArray['message'] = $retrieve_response_message;
				}else{
					$responseArray = array();
					$responseArray['success'] = true;
					$responseArray['message'] = 'Unknown Error';
				}
			}elseif( ! empty( $retrieve_response_message ) ) {
				$response_body = wp_remote_retrieve_body( $res );
				if($response_body != ""){
					$body 		= json_decode($response_body, true);
					if(is_array($body)){
						$message 	= $body['message'];
					}else{
						$message 	= $response_body;
					}
				}else{
					$message 	= $retrieve_response_message;
				}
				$responseArray['success'] = true;
				$responseArray['message'] = $message;
			}else if($retrieve_response_code == 0 && empty($retrieve_response_message)){
				$responseArray['success'] = true;
				$responseArray['message'] = "Unable to connect to server, please check your network";
			}else{
				$responseArray['success'] = true;
				$responseArray['message'] = "Unknown Error";
			}
		}
		return array( 'response_code' => $retrieve_response_code, 'response_body' => $responseArray);
	}

	protected function getSearchboxName() {
		return !empty($this->pluginSettings['searchbox_name']) ? $this->pluginSettings['searchbox_name'] : $this->searchbox_name;
	}

	protected function getPostTypesForIndexing() {
		$postTypesForSearch = (isset($this->pluginSettings["post_types_for_search"]) && $this->pluginSettings["post_types_for_search"] !="") ? explode(",", $this->pluginSettings["post_types_for_search"]) : array();
		if($postTypesForSearch !="" && count($postTypesForSearch)  > 0){
			$result = $postTypesForSearch;
		}else{
			$result = $this->postTypesToIndex();
		}
		$result = array_diff($result, $this->postTypesFilter);
		if (count($result) == 0) {
			$result = $this->postTypesToIndex();
		}
		$this->postsToIndexAndSearch = $result;
		return $result;
	}


	public function processStyling($style = ""){
		if($style != ""){
			$newcss      = $this->parse_css_array($this->parse_css($style));
			return $newcss;
		}
		return $style;
	}

	protected function parse_css($css)
	{
		$css_array = array(); // master array to hold all values
		$element = array_map('trim',explode('}', $css));
		$num    = 0;
		$media  = -1;
		$arrImport  = array();
		foreach($element as $k => $v){
			if( strpos($v, '@import') !== FALSE) {
				$arrNoImport = explode(';', $v);
				foreach($arrNoImport as $key => $val){
					if(strpos($val, '@import') !== FALSE){
						$arrImport[] = trim($val);
						unset($arrNoImport[$key]);
					}
				}

				$element[$k] = implode(' ',array_map('trim',$arrNoImport));
			}
		}
		foreach ($element as $k=>$element) {
			// get the name of the CSS element
			$a_name = explode('{', $element);
			$name = $a_name[0];
			if(strpos(trim($name), '@media') !== FALSE){
				$media = 0;
				$mediaArr   = array_shift($a_name);

				$css_array[$num]['media'] = trim($mediaArr);
				$element = implode("{", $a_name);
				$name    = array_shift($a_name);
			}
			if(trim($name) != "") {
				if($media != -1){
					$media++;
				}
				// get all the key:value pair styles
				$a_styles = explode(';', $element);
				// remove element name from first property element
				$a_styles[0] = str_replace($name . '{', '', $a_styles[0]);
				// loop through each style and split apart the key from the value
				$count = count($a_styles);
				if($media > 0){
					$css_array[$num]['elements'][$media] = array_map('trim', explode(',', trim($name))); // fill the master array with elements as array
				}else {
					$css_array[$num]['elements'] = array_map('trim', explode(',', trim($name))); // fill the master array with elements as array
				}
				for ($a = 0; $a < $count; $a++) {
					if ($a_styles[$a] != '') {
						$a_key_value = explode(':', $a_styles[$a]);
						// fill the master css array with rules
						if (isset($a_key_value[0]) && !empty($a_key_value[0]) && isset($a_key_value[1]) && !empty($a_key_value[1])) {
							if(strpos(trim($name), '.search-results-R') === FALSE && strpos(trim($name), '.search-results-row') === FALSE && strpos(trim($a_key_value[1]), '!important') === FALSE){
								$a_key_value[1] = trim($a_key_value[1])."!important";
							}
							if($media > 0) {
								$css_array[$num]['rules'][$media][trim($a_key_value[0])] = trim($a_key_value[1]);
							}else{
								$css_array[$num]['rules'][trim($a_key_value[0])] = trim($a_key_value[1]);
							}
						}
					}
				}
				if($media <= 0) {
					$num++;
				}
			}else{
				if($media > -1){
					$media = -1;
					$num++;
				}
			}
		}
		$arrayReturn['css']     = $css_array;
		$arrayReturn['import']  = $arrImport;
		return $arrayReturn;
	}
	
	protected function parse_css_array($arrayReturn){
		$cssArray    = $arrayReturn['css'];
		$importArray = $arrayReturn['import'];
		$cssString = "";
		if($importArray != "" && count($importArray) > 0){
			foreach($importArray as $k => $v) {
				$cssString .= $v.";\n";
			}
		}
		$bodyClass = array_merge(get_body_class(), array()); // get wordpress body classes
		if($cssArray != "" && count($cssArray) > 0){
			foreach($cssArray as $k => $v){
				if( isset($v['elements']) && !empty($v['elements']) && count($v['elements']) > 0 && isset($v['rules']) && !empty($v['rules']) && count($v['rules']) > 0) {
					if(isset($v['media'])) {
						$cssString .= $v["media"] . " {\n";
						foreach ($v['elements'] as $k => $elements) { // process get each element from elements array
							foreach ($elements as $element) {
								$pop = trim(str_replace(array("."), array(""), array_shift(explode(" ", $element)))); // get leading class/element from element.
								if (strpos(trim($element), '.search-results-R') === FALSE && strpos(trim($element), '.search-results-row') === FALSE && $pop != 'body' && !in_array($pop, $bodyClass)) { // Cheking if body or any wordpress body class is not the leading class/element. Add body as leading element
									$cssString .= 'body ' . $element . ', ';
								} else {
									$cssString .= $element . ', ';
								}
							}
							$cssString = substr($cssString, 0, -2) . "{ ";
							foreach ($v['rules'][$k] as $ruleKey => $ruleValue) { // concatinate all rules to form the required rule
								$cssString .= $ruleKey . ":" . $ruleValue . "; ";
							}
							$cssString .= "}\n";
						}
						$cssString .= "}\n";

					}else{
						foreach ($v['elements'] as $k => $element) { // process get each element from elements array
							$expEl = explode(" ", $element);
							$pop = trim(str_replace(array("."), array(""), array_shift($expEl))); // get leading class/element from element.
							if (strpos(trim($element), '.search-results-R') === FALSE && strpos(trim($element), '.search-results-row') === FALSE && $pop != 'body' && !in_array($pop, $bodyClass)) { // Cheking if body or any wordpress body class is not the leading class/element. Add body as leading element
								$cssString .= 'body ' . $element . ', ';
							} else {
								$cssString .= $element . ', ';
							}
						}
						$cssString = substr($cssString, 0, -2) . "{ ";
						foreach ($v['rules'] as $ruleKey => $ruleValue) { // concatinate all rules to form the required rule
							$cssString .= $ruleKey . ":" . $ruleValue . "; ";
						}
						$cssString .= "}\n";
					}
				}
			}
		}
		return $cssString;
	}

	public function isMobileEnabled() {
		return !!$this->pluginSettings['mobile_enabled'];
	}

	public function getMobileFaviconURL() {
        return $this->pluginSettings['mobile_favicon_mode'] > 0 && !empty($this->pluginSettings['mobile_style']['barFavicon']) ? $this->pluginSettings['mobile_style']['barFavicon'] : null;
    }

    public function getDefaultFaviconURL() {
        return home_url("/") . "favicon.ico";
    }

	public function setMobileEnabled($enabled = null) {
        if (is_null($enabled)) $enabled = self::DEFAULT_MOBILE_ENABLED;
		if($enabled === false) $enabled = "";
		update_option($this->pluginOptions['mobile_enabled'], $enabled);
	}

	public function setMobileIconEnabled($enabled = null) {
        if (is_null($enabled)) $enabled= self::DEFAULT_MOBILE_ICON_ENABLED;
		if($enabled === false) $enabled = "";
        update_option($this->pluginOptions['mobile_icon_enabled'], $enabled);
    }

    public function setMobileFaviconMode($mode = null) {
        if (is_null($mode)) $mode = self::DEFAULT_MOBILE_FAVICON_MODE;
        update_option($this->pluginOptions['mobile_favicon_mode'], $mode);
    }

    public function isMobileIconEnabled() {
        return !!$this->pluginSettings['mobile_icon_enabled'];
    }

    public function setMobileFloatBarEnabled($enabled = null) {
        if (is_null($enabled)) $enabled = self::DEFAULT_MOBILE_FLOAT_BAR_ENABLED;
	    if($enabled === false) $enabled = "";
        update_option($this->pluginOptions['mobile_float_bar_enabled'], $enabled);
    }

    public function isMobileFloatBarEnabled() {
        return !! $this->pluginSettings['mobile_float_bar_enabled'];
    }

	public function getSearchAlgorithm() {
		if (is_null($this->pluginSettings['search_algorithm']) || !in_array($this->pluginSettings['search_algorithm'], $this->availableSearchAlgorithms, true)) {
			return self::DEFAULT_SEARCH_ALGORITHM;
		}
		return $this->pluginSettings['search_algorithm'];
	}

	public function setSearchAlgorithm($searchAlgorithm) {
		if (!is_null($searchAlgorithm) && in_array($searchAlgorithm, $this->availableSearchAlgorithms, true)) {
			update_option($this->pluginOptions['search_algorithm'], $searchAlgorithm);
			$this->_siq_sync_settings();
		}
	}

	public function is_custom_search_page_set(){
		if(($this->pluginSettings['use_custom_search'] == 'yes' || isset($_GET['result']) && $_GET['result'] == "on") && !empty($this->pluginSettings['custom_search_page'])){
			$this->pluginSettings['use_custom_search'] = 'yes';
			return true;
		}
		return false;
	}

	protected function getAutocompleteNumRecords() {
		return !empty($this->pluginSettings['autocomplete_num_records']) ? $this->pluginSettings['autocomplete_num_records'] : $this->autocompleteDefaultNumRecords;
	}

	protected function getSearchQueryParamName(){
		return !empty($this->pluginSettings['search_query_param_name']) ? $this->pluginSettings['search_query_param_name'] : $this->search_query_param_name;
	}

	protected function setSearchboxName($post) {
		$siq_searchbox_name = $post['newName'];
		if (empty($siq_searchbox_name) || $siq_searchbox_name === $this->searchbox_name) {
			delete_option($this->pluginOptions['searchbox_name']);
		} else {
			update_option($this->pluginOptions['searchbox_name'], $siq_searchbox_name);
		}
		$this->_siq_sync_settings();
		return array('success'=>1, 'message'=>'Searchbox name changed successfully');
	}

	protected function setSearchQueyParamName($post) {
		$siq_search_query_param_name = $post['paramName'];
		if (empty($siq_search_query_param_name) || $siq_search_query_param_name === $this->search_query_param_name) {
			delete_option($this->pluginOptions['search_query_param_name']);
		} else {
			update_option($this->pluginOptions['search_query_param_name'], $siq_search_query_param_name);
		}
		$this->_siq_sync_settings();
		return array('success'=>1, 'message'=>'Parameter name changed successfully');
	}

	protected function setPostTypesForSearch() {
		$types = $this->sanitizeVariables($_POST['post_types']);
		$postTypes = $this->postTypesToIndex();
		$postTypesForSearch = array_intersect($types, $postTypes);
		$postTypesForSearch = array_diff($postTypesForSearch, $this->postTypesFilter);
		if(!empty($this->postTypeForPDF) && !in_array($this->postTypeForPDF, $postTypesForSearch)){ array_push($postTypesForSearch, $this->postTypeForPDF); }
		update_option($this->pluginOptions["post_types_for_search"], implode(",", $postTypesForSearch));
		$this->_siq_sync_settings();
	}
	protected function _siq_get_sync_settings(){
		
		global $siqAPIClient;
		$api_key 	= $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];
		if(!empty($engineKey)) {
			try {
				$params['params'] = array();
				$params['callMethod'] = 'GET';
				$params['callUrl'] = 'searchEngines/' . $engineKey . '/settings';
				$response = $siqAPIClient->makeAPICall($params);
				if (!empty($response['response_code'])) {
					$result = $response['response_body'];
					$this->siqSyncSettings = $result;
					$this->getSyncSettingsCalled = 1;
					if(is_array($result) && count($result) > 0){
						if(isset($result['featureExcludeFields'])) {
							$this->featureExcludeFields = $result['featureExcludeFields'];
							update_option($this->pluginOptions["featureExcludeFields"], $result['featureExcludeFields']);
						}else{
							update_option($this->pluginOptions["featureExcludeFields"], 0);
						}
						if(isset($result['isProPack'])) {
							$this->isProPack = $result['isProPack'];
							update_option($this->pluginOptions["isProPack"], $result['isProPack']);
						}else{
							update_option($this->pluginOptions["isProPack"], 0);
						}
						if(isset($result['licensed'])) {
							$this->licensed = $result['licensed'];
						}
                        if (isset($result["allowHideLogo"])) {
                            $this->allowHideLogo = $result['allowHideLogo'];
                        }
                        if (isset($result['enableFacetFeature']) && !!$result['enableFacetFeature']) {
                            $this->pluginSettings['facets_enabled'] = '1';
                            update_option($this->pluginOptions["facets_enabled"], "1");
                            if ($this->pluginSettings["facets_modified"] != "1") {
                                $this->pluginSettings["facets_modified"] = "1";
                                update_option($this->pluginOptions["facets_modified"], '1');
                                $this->createDefaultFacets();
                            }
                        } else {
                            update_option($this->pluginOptions["facets_enabled"], "0");
                        }
					} else {
						update_option($this->pluginOptions["featureExcludeFields"], 0);
						update_option($this->pluginOptions["isProPack"], 0);
                        update_option($this->pluginOptions["facets_enabled"], "0");
					}
				}
			} catch (Exception $e) {
			}
		}
		if(isset($result) && is_array($result) && count($result) > 0){
			return $result;
		}
		return array();
	}

	protected function areExcludeFeaturesEnabled(){
		if(is_admin()) {
			if ($this->getSyncSettingsCalled == 0) {
				$this->_siq_get_sync_settings();
			}
		}else{
			$this->featureExcludeFields = $this->pluginSettings['featureExcludeFields'];
			$this->isProPack            = $this->pluginSettings['isProPack'];
		}
		return ($this->featureExcludeFields || $this->isProPack) ? true: false;
	}

    protected function createDefaultFacets() {
        $facets = array(
            array(
                "postType"      => "_siq_all_posts",
                "type"          => "date",
                "label"         => "Date",
                "field"         => "timestamp",
                "dateFormat"    => 'Y-m-d\TH:i:s\.\0\0\0'
            ),
            array(
                "postType"      => "_siq_all_posts",
                "type"          => "string",
                "label"         => "Category",
                "field"         => "categories"
            ),
            array(
                "postType"      => "_siq_all_posts",
                "type"          => "string",
                "label"         => "Tag",
                "field"         => "tags"
            ),
            array(
                "postType"      => "_siq_all_posts",
                "type"          => "string",
                "label"         => "Author",
                "field"         => "author"
            )
        );
        $this->saveFacets($facets);
    }

	protected function _siq_sync_settings($syncSettings = array()){
		global $siqAPIClient;
		$this->getPluginSettings();
		if (is_null($this->pluginSettings['mobile_enabled'])) {
			update_option($this->pluginOptions['mobile_enabled'], self::DEFAULT_MOBILE_ENABLED);
			$this->getPluginSettings();
		}
		$api_key 	= $siqAPIClient->siq_get_api_key();
		$engineKey	= $this->pluginSettings['engine_code'];

        $style	= $this->pluginSettings['custom_search_page_style'];
//		$style = $this->getStyling($stylingVar);
        $mobileStyle = $this->pluginSettings['mobile_style'];
		$openResultInTab = false;
		$hideLogo 			 = false;
		try{
			$params['params'] = array(
				"searchBoxName"                 => $this->getSearchboxName(),
				"postTypesForSearch"            => $this->getPostTypesForSearchSelection("", true),
				"sortBy"                        => !empty($this->pluginSettings['siq_search_sortby']) ? $this->pluginSettings['siq_search_sortby'] : null,
				"customSearchNumRecords"        => (int) $this->getCustomSearchNumRecords(),
				"customSearchResultsInfoText" =>  !empty($this->pluginSettings['customSearchResultsInfoText']) ? $this->pluginSettings['customSearchResultsInfoText'] : null,
				"customSearchResultsOrderRelevanceText" =>  !empty($this->pluginSettings['customSearchResultsOrderRelevanceText']) ? $this->pluginSettings['customSearchResultsOrderRelevanceText'] : null,
				"customSearchResultsOrderNewestText" =>  !empty($this->pluginSettings['customSearchResultsOrderNewestText']) ? $this->pluginSettings['customSearchResultsOrderNewestText'] : null,
				"customSearchResultsOrderOldestText" =>  !empty($this->pluginSettings['customSearchResultsOrderOldestText']) ? $this->pluginSettings['customSearchResultsOrderOldestText'] : null,
				"noRecordsFoundText" =>  !empty($this->pluginSettings['noRecordsFoundText']) ? $this->pluginSettings['noRecordsFoundText'] : null,
				"customSearchBarPlaceholder"    => $this->pluginSettings["custom_search_bar_placeholder"] ? $this->pluginSettings["custom_search_bar_placeholder"] : null,
				"customSearchBarBackground"    => !empty($style['resultSearchBarBackground']) ? $style['resultSearchBarBackground'] : null,
				"customSearchBarTextColor"    => !empty($style['resultSearchBarColor']) ? $style['resultSearchBarColor'] : null,
				"customSearchBarPoweredByColor"    => !empty($style['resultSearchBarPoweredByColor']) ? $style['resultSearchBarPoweredByColor'] : null,
				"customSearchItemBackground"    => !empty($style['resultBoxBg']) ? $style['resultBoxBg'] : null,
				"customSearchItemTitleFontSize"    => ((int)($style['resultTitleFontSize']) > 0) ? $style['resultTitleFontSize'] : null,
				"customSearchItemTitleColor"    => !empty($style['resultTitleColor']) ? $style['resultTitleColor'] : null,
				"customSearchItemBodyFontSize"    => ((int)($style['resultTextFontSize']) > 0) ? $style['resultTextFontSize'] : null,
				"customSearchItemBodyColor"    => !empty($style['resultTextColor']) ? $style['resultTextColor'] : null,
				"showAuthorAndDate"             => $this->pluginSettings["custom_page_display_author"] === "0" ? false : true,
				"customSearchItemAuthorAndDateFontSize"    => ((int)($style['resultAuthDateFontSize']) > 0) ? $style['resultAuthDateFontSize'] : null,
				"customSearchItemAuthorAndDateColor"    => !empty($style['resultAuthDateColor']) ? $style['resultAuthDateColor'] : null,
				"showCategory"                  => $this->pluginSettings["custom_page_display_category"] === "0" ? false : true,
				"customSearchItemCategoryFontSize"    => ((int)($style['resultCatTitleFontSize']) > 0) ? $style['resultCatTitleFontSize'] : null,
				"customSearchItemCategoryColor"    => !empty($style['resultCatTitleColor']) ? $style['resultCatTitleColor'] : null,
				"customSearchItemCategoryBackground"    => !empty($style['resultCatBgColor']) ? $style['resultCatBgColor'] : null,
				"showTag"                       => $this->pluginSettings["custom_page_display_tag"] === "0" ? false : true,
				"customSearchItemTagFontSize"    => ((int)($style['resultTagFontSize']) > 0) ? $style['resultTagFontSize'] : null,
				"customSearchItemTagColor"    => !empty($style['resultTagColor']) ? $style['resultTagColor'] : null,
				
				"paginationPrevText" =>  !empty($this->pluginSettings['paginationPrevText']) ? $this->pluginSettings['paginationPrevText'] : null,
				"paginationNextText" =>  !empty($this->pluginSettings['paginationNextText']) ? $this->pluginSettings['paginationNextText'] : null,
				"customSearchPaginationFontSize"    => ((int)($style['paginationFontSize']) > 0) ? $style['paginationFontSize'] : null,
				"customSearchPaginationCurrentBackground"    => !empty($style['paginationCurrentBackground']) ? $style['paginationCurrentBackground'] : null,
				"customSearchPaginationCurrentColor"    => !empty($style['paginationCurrentColor']) ? $style['paginationCurrentColor'] : null,
				"customSearchPaginationCurrentBorderColor"    => !empty($style['paginationCurrentBorderColor']) ? $style['paginationCurrentBorderColor'] : null,
				"customSearchPaginationActiveBackground"    => !empty($style['paginationActiveBackground']) ? $style['paginationActiveBackground'] : null,
				"customSearchPaginationActiveColor"    => !empty($style['paginationActiveColor']) ? $style['paginationActiveColor'] : null,
				"customSearchPaginationActiveBorderColor"    => !empty($style['paginationActiveBorderColor']) ? $style['paginationActiveBorderColor'] : null,
				"customSearchPaginationDisabledBackground"    => !empty($style['paginationInactiveBackground']) ? $style['paginationInactiveBackground'] : null,
				"customSearchPaginationDisabledColor"    => !empty($style['paginationInactiveColor']) ? $style['paginationInactiveColor'] : null,
				"customSearchPaginationDisabledBorderColor"    => !empty($style['paginationInactiveBorderColor']) ? $style['paginationInactiveBorderColor'] : null,
				
				"showACImages"                  => $this->pluginSettings["show_autocomplete_images"] == "yes",
				"disableAutocomplete"           => $this->pluginSettings["disable_autocomplete"] == "yes",
				"customSearchThumbnailsEnabled" => $this->pluginSettings["show_search_page_images"] == "yes",
				"customCss"                     => $this->processStyling(stripslashes($style['customCss'])),
				"resultPageUrl"                 => ( !! $this->is_custom_search_page_set() ? get_permalink($this->pluginSettings["custom_search_page"]) : null ),
				"queryParameter"                => $this->getSearchQueryParamName(),
				
				"autocompleteTextResults"       => $this->pluginSettings["autocomplete_text_results"] ? $this->pluginSettings["autocomplete_text_results"] : "",
				"autocompleteTextMoreLink"      => $this->pluginSettings["autocomplete_text_moreLink"] ? $this->pluginSettings["autocomplete_text_moreLink"] : "",
				"autocompleteTextPoweredBy"     => $this->pluginSettings["autocomplete_text_poweredBy"] ? $this->pluginSettings["autocomplete_text_poweredBy"] : "",
				"autocompleteNumRecords"        => (int) $this->getAutocompleteNumRecords(),
				"autocompleteWidth"             => ( (int) ($this->pluginSettings["autocomplete_style"]["autocompleteWidth"]) > 0 )? (int) $this->pluginSettings["autocomplete_style"]["autocompleteWidth"] : null ,
				"autocompleteBackground"    => !empty( $this->pluginSettings["autocomplete_style"]["autocompleteBackground"])  ? $this->pluginSettings["autocomplete_style"]["autocompleteBackground"] : null ,
				"autocompleteSectionTitleColor" => !empty( $this->pluginSettings["autocomplete_style"]["sectionTitleColor"])  ? $this->pluginSettings["autocomplete_style"]["sectionTitleColor"] : null ,
				"autocompleteMoreLinkColor" => !empty( $this->pluginSettings["autocomplete_style"]["moreLinkColor"])  ? $this->pluginSettings["autocomplete_style"]["moreLinkColor"] : null ,
				"autocompleteMoreLinkHoverColor" => !empty( $this->pluginSettings["autocomplete_style"]["hoverMoreLinkColor"])  ? $this->pluginSettings["autocomplete_style"]["hoverMoreLinkColor"] : null ,
				"autocompleteResultFontSize" => ((int)( $this->pluginSettings["autocomplete_style"]["resultFontSize"]) > 0)  ? $this->pluginSettings["autocomplete_style"]["resultFontSize"] : null ,
				"autocompleteResultColor" => !empty( $this->pluginSettings["autocomplete_style"]["resultFontColor"])  ? $this->pluginSettings["autocomplete_style"]["resultFontColor"] : null ,
				"autocompleteResultHighlightFontSize" => ((int)( $this->pluginSettings["autocomplete_style"]["highlightFontSize"]) > 0)  ? $this->pluginSettings["autocomplete_style"]["highlightFontSize"] : null ,
				"autocompleteResultHighlightColor" => !empty( $this->pluginSettings["autocomplete_style"]["highlightFontColor"])  ? $this->pluginSettings["autocomplete_style"]["highlightFontColor"] : null ,
				"autocompleteResultImagePlaceholderBackground" => !empty( $this->pluginSettings["autocomplete_style"]["imagePlacehoderBackground"])  ? $this->pluginSettings["autocomplete_style"]["imagePlacehoderBackground"] : null ,
				"autocompleteResultHoverBackground" => !empty( $this->pluginSettings["autocomplete_style"]["hoverResultBackground"])  ? $this->pluginSettings["autocomplete_style"]["hoverResultBackground"] : null ,
				"autocompleteResultHoverFontSize" => ((int)( $this->pluginSettings["autocomplete_style"]["hoverResultFontSize"]) > 0)  ? $this->pluginSettings["autocomplete_style"]["hoverResultFontSize"] : null ,
				"autocompleteResultHoverColor" => !empty( $this->pluginSettings["autocomplete_style"]["hoverResultFontColor"])  ? $this->pluginSettings["autocomplete_style"]["hoverResultFontColor"] : null ,
				"autocompleteResultHoverHighlightFontSize" => ((int)( $this->pluginSettings["autocomplete_style"]["hoverHighlightFontSize"]) > 0)  ? $this->pluginSettings["autocomplete_style"]["hoverHighlightFontSize"] : null ,
				"autocompleteResultHoverHighlightColor" => !empty( $this->pluginSettings["autocomplete_style"]["hoverHighlightFontColor"])  ? $this->pluginSettings["autocomplete_style"]["hoverHighlightFontColor"] : null ,
				"autocompleteResultHoverImagePlaceholderBackground" => !empty( $this->pluginSettings["autocomplete_style"]["hoverImagePlacehoderBackground"])  ? $this->pluginSettings["autocomplete_style"]["hoverImagePlacehoderBackground"] : null ,
				
				"mobileStylingBarBgColor"               => !empty($mobileStyle["barBgColor"]) ? $mobileStyle["barBgColor"] : null,
                "mobileStylingBarInputBoxBgColor"       => !empty($mobileStyle["barInputBgColor"]) ? $mobileStyle["barInputBgColor"] : null,
                "mobileStylingBarInputBoxTextColor"     => !empty($mobileStyle["barInputTextColor"]) ? $mobileStyle["barInputTextColor"] : null,
                "mobileStylingBarFavicon"               => $this->getMobileFaviconURL(),
                "mobileStylingBarInputBoxPlaceholder"   => !empty($mobileStyle["barPlaceholder"]) ? $mobileStyle["barPlaceholder"] : null,
                "mobileBarPlaceholderTextColor"   => !empty($mobileStyle["barPlaceholderTextColor"]) ? $mobileStyle["barPlaceholderTextColor"] : null,
				
				"mobileEnabled"                 => $this->isMobileEnabled(),
				"mobileSearchIconSelector"=>!empty($this->pluginSettings['search_icon_selector']) ? $this->pluginSettings['search_icon_selector'] : null,
				"mobileStylingSearchIconBoxBg"  => !empty($mobileStyle["searchIconBoxBg"]) ? $mobileStyle["searchIconBoxBg"] : null,
				"mobileStylingSearchIconColor"  => !empty($mobileStyle["searchIconColor"]) ? $mobileStyle["searchIconColor"] : null,
				"mobileStylingSearchIconTopOffset"      => !empty($mobileStyle["searchIconTopOffset"]) ? $mobileStyle["searchIconTopOffset"] : null,
				"mobileStylingSearchIconTopOffsetUnit"  => !empty($mobileStyle["searchIconTopOffsetUnit"]) ? $mobileStyle["searchIconTopOffsetUnit"] : (!empty($mobileStyle["searchIconTopOffset"]) ? "px" : null),
				"searchAlgorithm"               => $this->getSearchAlgorithm(),
                "mobileFloatSearchIconEnable"   => $this->isMobileIconEnabled(),
                "mobileFloatSearchBarEnable"    => $this->isMobileFloatBarEnabled(),
                "mobileItemTitleTextSize"       => !empty($mobileStyle["resultTitleFontSize"]) ? $mobileStyle["resultTitleFontSize"] : null,

				"thumbnailType"                 =>!empty($this->pluginSettings["siq_crop_resize_thumb"]) ? $this->pluginSettings["siq_crop_resize_thumb"] : self::DEFAULT_CROP_RESIZE_THUMB,
				"descriptionFields" =>$this->fieldForExcerpt,
				"defaultThumbnailUrl" => !empty($this->pluginSettings["siq_default_thumbnail"]) ? $this->pluginSettings["siq_default_thumbnail"] : null,
                "resultPageLayout" => $this->pluginSettings['resultPageLayout'] === self::RP_LAYOUT_GRID ? self::RP_LAYOUT_GRID : self::RP_LAYOUT_LIST
			);
			if(is_array($syncSettings) && count($syncSettings) > 0){
				foreach($syncSettings as $settingKey => $settingValue){
					$params['params'][$settingKey] = $settingValue; 
				}
			}else{
				$this->siqSyncSettings = $syncSettings = $this->_siq_get_sync_settings();
				if(!empty($syncSettings) && is_array($syncSettings) && count($syncSettings) > 0){
					if(array_key_exists('openResultInTab', $syncSettings)){
						$openResultInTab = ($syncSettings['openResultInTab'] === true);
					}
					if(array_key_exists('hideLogo', $syncSettings)){
						$hideLogo = ($syncSettings['hideLogo'] === true);
					}
				}
				$params['params']['openResultInTab'] = $openResultInTab; 
				$params['params']['hideLogo'] 				= $hideLogo; 
			}

			// FACETS
			$facets = isset($this->pluginSettings['siq_facets']) && is_array($this->pluginSettings['siq_facets']) ? $this->pluginSettings['siq_facets'] : array();
			if (count($facets) > 0) {
				$compiledFacets = array();
				$fields = $this->getDocumentAdditionalFields();
				for ($i = 0; $i < count($facets) && $i < self::FACETS_LIMIT; ++$i) {
					$facet = $facets[$i];
					$compiledFacet = array(
						"label" => $facet["label"],
                        "postType" => $facet["postType"],
						"type" => strtoupper($facet["type"]),
						"order" => $i,
                        "srcField" => empty($facet['targetField']) ? $facet["field"] : $facet['targetField']
					);
					array_push($compiledFacets, $compiledFacet);
				}
				$additionalParams = array(
					"enableAutocompleteFacet" => $this->getAutocompleteFacetsEnabled(),
					"enableResultsPageFacet" => $this->getResultPageFacetsEnabled(),
					"facets" => $compiledFacets
				);
				$params["params"] = array_merge($params["params"], $additionalParams);
			}
			// END PRO PACK
			$params['callMethod'] = 'POST';
			$params['callUrl'] = 'searchEngines/'.$engineKey.'/settings';
			$response = $siqAPIClient->makeAPICall($params);
			if (!empty($response['response_code'])) {
				$result = $response['response_body'];
			}
		}catch(Exception $e){
			$result['success'] 		= false;
			$result['message'] 		= $e->getMessage();
		}
		return $result;
	}

    private function getSIQFacetField($wpField, &$siqFields) {
        if (in_array($wpField, $this->builtInFacetFields)) {
            return $wpField;
        } else {
            return array_shift($siqFields);
        }
    }

	private function getDocumentAdditionalFields() {
        $fields = array(
            "number" => array("genericNum1", "genericNum2", "genericNum3", "genericNum4", "genericNum5"),
            "date" => array("genericDate1", "genericDate2", "genericDate3", "genericDate4", "genericDate5"),
            "string" => array("genericString1", "genericString2", "genericString3", "genericString4", "genericString5")
        );
        $fields["rating"] = &$fields["number"];
        return $fields;
    }

	protected function getCustomSearchNumRecords() {
		return is_numeric($this->pluginSettings['custom_search_num_records']) && $this->pluginSettings['custom_search_num_records'] > 0 ? $this->pluginSettings['custom_search_num_records'] : self::DEFAULT_CUSTOM_SEARCH_NUM_RECORDS;
	}

	protected function setCustomSearchNumRecords($numRecords) {
		if (is_numeric($numRecords) && $numRecords > 0) {
			update_option($this->pluginOptions['custom_search_num_records'], $numRecords);
		}
	}

	protected function postTypesToIndex() {
		if ( function_exists( 'get_post_types' ) ) {
			$this->postsToIndex = array_diff(array_merge(
				get_post_types( array( 'exclude_from_search' => '0' ) ),
				get_post_types( array( 'exclude_from_search' => false ) )
			), $this->postTypesFilter);
			return $this->postsToIndex;
		}
	}

	protected function getAllpostTypes() {
		if ( function_exists( 'get_post_types' ) ) {
			$this->allPostTypes = array_diff(get_post_types(), $this->postTypesFilter);
			return $this->allPostTypes;
		}
	}

	protected function sanitizeVariables( $input ){
		$output = array();
		if(is_array($input) && count($input) > 0 ){
			foreach($input as $k => $v){
				if(!in_array($k, $this->keysExepmtedFromSanitize)) {
					$output[$k] = sanitize_text_field($v);
				}else{
					$output[$k] = $v;
				}
			}
		}
		return $output;
	}

	protected function getAllCustomFields($postTypes = array()) {
		global $wpdb;
		$arrReturn = array();
		if(count($postTypes) == 0) {
			$regularFields = $wpdb->get_col("SELECT `meta_key` FROM `$wpdb->postmeta` WHERE meta_key NOT LIKE '\\_%' GROUP BY meta_key ORDER BY meta_key;");
			$systemFields = $wpdb->get_col("SELECT `meta_key` FROM `$wpdb->postmeta` WHERE meta_key LIKE '\\_%' GROUP BY meta_key ORDER BY meta_key;");
			return array(
				"regular_fields" => $regularFields,
				"system_fields" => $systemFields
			);
		}else{
			$postTypeExcluded = "'".implode("','",$this->postTypesFilter)."'";
			$queryRegularFields = "select pp.meta_key, GROUP_CONCAT(pp.post_type SEPARATOR ',') as post_type from (select pm.meta_key as meta_key, po.post_type as post_type from `$wpdb->postmeta` pm left join `$wpdb->posts` po on pm.post_id = po.ID where pm.meta_key NOT LIKE '\\_%' AND po.post_type NOT IN (".$postTypeExcluded.") group by pm.meta_key, po.post_type) pp group by pp.meta_key order by pp.meta_key";
			$regularFields = $wpdb->get_results($queryRegularFields);
			$querySystemFields = "select pp.meta_key, GROUP_CONCAT(pp.post_type SEPARATOR ',') as post_type from (select pm.meta_key as meta_key, po.post_type as post_type from `$wpdb->postmeta` pm left join `$wpdb->posts` po on pm.post_id = po.ID where pm.meta_key LIKE '\\_%' AND po.post_type NOT IN (".$postTypeExcluded.") group by pm.meta_key, po.post_type) pp group by pp.meta_key order by pp.meta_key";
			$systemFields = $wpdb->get_results($querySystemFields);
			foreach($postTypes as $key => $val){
				$regularFieldsArr = array();
				$systemFieldsArr  = array();
				foreach($regularFields as $k=>$v){
					$postTypes = explode(',',$v->post_type);
					if(in_array($val, $postTypes) && !in_array($v->meta_key, $this->metaFieldsSkipped)) {
						array_push($regularFieldsArr, $v->meta_key);
					}
				}
				foreach($systemFields as $k=>$v){
					$postTypes = explode(',',$v->post_type);
					if(in_array($val, $postTypes) && !in_array($v->meta_key, $this->metaFieldsSkipped)) {
						array_push($systemFieldsArr, $v->meta_key);
					}
				}
				$arrReturn[$val] = array(
					"regular_fields" => $regularFieldsArr,
					"system_fields" => $systemFieldsArr
				);

			}
			return $arrReturn;
		}
	}

	protected function savePostTypes($data){
		if($data != "") {
			$dataArr = explode(',', $data);
			$types = $this->sanitizeVariables($dataArr);
			$postTypes = $this->getAllpostTypes();
			$postTypesForSearch = array_intersect($types, $postTypes);
			if(!empty($this->postTypeForPDF) && !in_array($this->postTypeForPDF, $postTypesForSearch)){ array_push($postTypesForSearch, $this->postTypeForPDF); }
			update_option($this->pluginOptions["post_types_for_search"], implode(",", $postTypesForSearch));
			$this->pluginSettings['post_types_for_search'] = implode(",", $postTypesForSearch);
			$this->_siq_sync_settings();
		}
	}

    protected function saveFieldsToExclude($data){
        if(!empty($data)) {
            update_option($this->pluginOptions["exclude_custom_fields"], $data);
            $this->pluginSettings["exclude_custom_fields"]= $data;
        }else{
            delete_option($this->pluginOptions["exclude_custom_fields"]);
            $this->pluginSettings["exclude_custom_fields"] = "";
        }
        $this->excludeCustomFields = $this->getExcludedCustomFields();
    }

    protected function savePostsToExclude($data){
        if(!empty($data)) {
            update_option($this->pluginOptions["exclude_posts"], $data);
            $this->pluginSettings["exclude_posts"] = $data;
        }else{
            delete_option($this->pluginOptions["exclude_posts"]);
            $this->pluginSettings["exclude_posts"] = "";
        }
        $this->excludePostIds = $this->getExcludedPostIds();
    }

	protected function saveTaxonomiesToExclude($data){
		if(!empty($data)) {
			update_option($this->pluginOptions["exclude_custom_taxonomies"], $data);
			$this->pluginSettings["exclude_custom_taxonomies"]= $data;
		}else{
			delete_option($this->pluginOptions["exclude_custom_taxonomies"]);
			$this->pluginSettings["exclude_custom_taxonomies"] = "";
		}
		$this->excludeCustomTaxonomies = $this->getExcludedCustomTaxonomies();
	}
	
	protected function saveFieldForExcerpt($data, $syncWithSearchIQ = false){
		if(!empty($data)) {
			update_option($this->pluginOptions["siq_field_for_excerpt"], $data);
			$this->pluginSettings["siq_field_for_excerpt"]= $data;
		}else{
			delete_option($this->pluginOptions["siq_field_for_excerpt"]);
			$this->pluginSettings["siq_field_for_excerpt"] = "";
		}
		$this->fieldForExcerpt = $this->getFieldForExcerpt();
		$result["success"] = 1;
		$result["message"] = "Settings saved successfully";
		if($syncWithSearchIQ){
			$result = $this->_siq_sync_settings();
		}
		return $result;
	}
	protected function save_and_sync_settings($data = array(), $syncWithSearchIQ = true){
		if(count($data) > 0) {
			
			if ($data['setImageCustomField'] && !empty($data['imageCustomField'])) {
				update_option($this->pluginOptions['image_custom_field'], $data['imageCustomField']);
				$this->pluginSettings["image_custom_field"] = $data['imageCustomField'];
			}
			if(!empty($data["postTypesToSearch"])) {
				$this->savePostTypes($data["postTypesToSearch"]);
			}
			if(isset($data["customFieldsToExclude"])) {
				$this->saveFieldsToExclude($data["customFieldsToExclude"]);
			}
			if(isset($data["customTaxonomiesToExclude"])) {
				$this->saveTaxonomiesToExclude($data["customTaxonomiesToExclude"]);
			}
			if(isset($data["excludePostIds"])) {
				$this->savePostsToExclude($data["excludePostIds"]);
			}
			if(isset($data["blackListUrls"])) {
				$this->saveBlackListUrls($data["blackListUrls"]);
			}
			if(isset($data["siq_field_for_excerpt"])) {
				$this->saveFieldForExcerpt($data["siq_field_for_excerpt"]);
			}
			if(isset($data["postTypesForSearchSelection"])) {
				$this->savePostTypesForSearchSelection($data["postTypesForSearchSelection"]);
			}
		}
		$result["success"] = 1;
		$result["message"] = "Settings saved successfully";
		if($syncWithSearchIQ){
			$result = $this->_siq_sync_settings();
		}
		return $result;
	}
	
	protected function savePostTypesForSearchSelection($data = "", $sync = false){
		if(!empty($data)) {
			if(!empty($this->postTypeForPDF)){
				$pdfSupport = ",".$this->postTypeForPDF.":yes";
				if(strpos($data, "") === FALSE){ $data.=$pdfSupport; }
			}
			update_option($this->pluginOptions["siq_postTypesForSearchSelection"], $data);
			$this->pluginSettings["siq_postTypesForSearchSelection"]= $data;
		}else{
			delete_option($this->pluginOptions["siq_postTypesForSearchSelection"]);
			$this->pluginSettings["siq_postTypesForSearchSelection"]="";
		}
		if($sync == true){
			$result = $this->_siq_sync_settings();
		}
	}
	
	protected function getPostTypesForSearchSelection($postType = "", $onlyString = false){
		$selection = $this->pluginSettings["siq_postTypesForSearchSelection"];
		$stringPostTypes = "";
		$arrPostTypes		= array();
		$postTypesIndexed = array();
		if(!empty($selection) && strpos($selection, ":") !== FALSE){
			$allPostTypes = explode(",", $selection);
			if(is_array($allPostTypes) && count($allPostTypes) > 0){
				$postTypesIndexed = $this->getPostTypesForIndexing();
				foreach($allPostTypes  as $k => $v){
					if(strpos($v, ":") !== FALSE){
						$data = explode(":", $v);
						$arrPostTypes[$data[0]] = $data[1];
						if($data[1] == "yes" && in_array($data[0], $postTypesIndexed)){
							$stringPostTypes .= $data[0].",";
						}
					}
				}
			}
		}
		
		if(!empty($stringPostTypes)){
			$stringPostTypes = substr($stringPostTypes, 0, -1);
		}
	
		if($onlyString == true){
			return $stringPostTypes;
		}
		if(!empty($postType) && array_key_exists($postType, $arrPostType)){
			return $arrPostTypes[$postType];
		}
		return $arrPostTypes;
	}
	
	protected function saveCropResize($data){
		if(!empty($data)) {
			if(array_key_exists($data, $this->siqCropResizeOptions)) {
				update_option($this->pluginOptions["siq_crop_resize_thumb"], $data);
				$this->pluginSettings["siq_crop_resize_thumb"] = $data;
				$this->_siq_sync_settings();
			}
		}
	}

	protected function saveFacets($facets) {
		$this->pluginSettings["siq_facets"] = $facets;
		update_option($this->pluginOptions['siq_facets'], $facets);
	}

	protected function setAutocompleteFacetsEnabled($enabled) {
		$this->pluginSettings["siq_facets_autocomplete_enabled"] = !!$enabled ? 1 : 0;
		update_option($this->pluginOptions["siq_facets_autocomplete_enabled"], $this->pluginSettings["siq_facets_autocomplete_enabled"]);
	}

	protected function getAutocompleteFacetsEnabled() {
		return is_null($this->pluginSettings["siq_facets_autocomplete_enabled"]) ? self::DEFAULT_AUTOCOMPLETE_FACETS_ENABLED : $this->pluginSettings["siq_facets_autocomplete_enabled"] == 1;
	}

	protected function setResultPageFacetsEnabled($enabled) {
		$this->pluginSettings["siq_facets_result_page_enabled"] = !!$enabled ? 1 : 0;
		update_option($this->pluginOptions["siq_facets_result_page_enabled"], $this->pluginSettings["siq_facets_result_page_enabled"]);
	}

	protected function getResultPageFacetsEnabled() {
		return is_null($this->pluginSettings["siq_facets_result_page_enabled"]) ? self::DEFAULT_RESULT_PAGE_FACETS_ENABLED : $this->pluginSettings["siq_facets_result_page_enabled"] == 1;
	}

    private static function castArrayItemsToDoubleRecursive($arr) {
        return array_map(function($item){return is_array($item) ? siq_core::castArrayItemsToDoubleRecursive($item) : (double) $item;}, $arr);
    }

    private static function prepareDateFieldForSubmission($obj, $format) {
        if (is_array($obj)) {
            $arr = array_map(function($item) use ($format) {return siq_core::prepareDateFieldForSubmission($item, $format);}, $obj);
            $arr = array_filter($arr, function($item) {return !is_null($item);});
            return $arr;
        } else {
            if (is_null($format)) {
                return gmdate('Y-m-d\TH:i:s\.\0\0\0', $obj);
            }
            $parsedDate = date_parse_from_format($format, $obj);
            if ($parsedDate["error_count"] == 0) {
                $unixTime = mktime($parsedDate["hour"], $parsedDate["minute"], $parsedDate["second"], $parsedDate["month"], $parsedDate["day"], $parsedDate["year"]);
                return gmdate('Y-m-d\TH:i:s\.\0\0\0', $unixTime);
            } else {
                return null;
            }
        }
    }

    private static function castArrayItemsToStringRecursive($arr) {
        return array_map(function($item){return is_array($item) ? siq_core::castArrayItemsToStringRecursive($item) : $item . "";}, $arr);
    }

    protected function getAllWoocommerceAtributeNames() {
        global $wpdb;
        $names = array();

        // if woocommerce plugin is active then collect all the attribute names
        if ($this->woocommerceActive) {
            $allRecords = $wpdb->get_col("SELECT `meta_value` FROM `{$wpdb->postmeta}` WHERE meta_key = '_product_attributes';");
            foreach ($allRecords as $rec) {
                $attrs = @unserialize($rec);
                if (!$attrs || !is_array($attrs) || count($attrs) == 0) continue;
                foreach ($attrs as $key => $attr) {
                    if (!empty($attr["name"])) {
                        $name = array(
                            "key" => $key,
                            "name" => $attr["name"]
                        );
                        if (!in_array($name, $names)) array_push($names, $name);
                    }
                }
            }
        }

        return $names;
    }
	public function removeFacetsNotice(){
		return delete_option(self::FACETS_NOTICE_KEY);
	}
	
	protected function searchEngineNotFound($remove = false){
		if(!$remove){
			update_option($this->pluginOptions["siq_engine_not_found"],1);
		}else{
			delete_option($this->pluginOptions["siq_engine_not_found"]);
		}
	}

    private function loadDocumentFieldMapping($documentType, $fields) {
        global $siqAPIClient;
        $params = array(
            "callMethod"    => "POST",
            "callUrl"       => "searchEngines/schema/detect?documentType=$documentType",
            "params"        => array(
                "fieldSet"      => $fields
            ),
            "body"          => true
        );
        try {
            $response = $siqAPIClient->makeAPICall($params);
            if (!empty($response['response_code']) && $response['response_code'] == 200) {
                $mapping = $response['response_body'];
                if (isset($mapping['success'])) {
                    unset($mapping['success']);
                }
                $this->documentFieldMappings[$documentType] = $mapping;
            } else {
                $this->documentFieldMappings[$documentType] = array();
            }
        } catch (Exception $e) {
            $this->documentFieldMappings[$documentType] = array();
        }
        return $this->documentFieldMappings[$documentType];
    }

    private function loadBulkDocumentFieldMapping($documentTypeFields) {
        global $siqAPIClient;
        $request = array();
        foreach ($documentTypeFields as $documentType => $fields) {
            $request[$documentType] = array("fieldSet" => $fields);
        }
        $params = array(
            "callMethod"    => "POST",
            "callUrl"       => "searchEngines/schema/detect/bulk",
            "params"        => $request,
            "body"          => true
        );
        try {
            $response = $siqAPIClient->makeAPICall($params);
            if (!empty($response['response_code']) && $response['response_code'] == 200) {
                $mappings = $response['response_body'];
                if (isset($mappings['success'])) {
                    unset($mappings['success']);
                }
                foreach ($mappings as $documentType => $mapping) {
                    $this->documentFieldMappings[$documentType] = $mapping;
                }
                return $mappings;
            }
        } catch (Exception $e) {
            // do nothing
        }
        return array();
    }

    protected function getDocumentFieldMapping($documentType, $fields) {
        if (array_key_exists($documentType, $this->documentFieldMappings)) {
            return $this->documentFieldMappings[$documentType];
        } else {
            return $this->loadDocumentFieldMapping($documentType, $fields);
        }
    }

    protected function getBulkDocumentFieldMapping($documentTypeFields) {
        $undetectedDocTypeFields = array();
        $detectedDocFieldMappings = array();
        foreach ($documentTypeFields as $documentType => $fields) {
            if (array_key_exists($documentType, $this->documentFieldMappings)) {
                $detectedDocFieldMappings[$documentType] = $this->documentFieldMappings[$documentType];
            } else {
                $undetectedDocTypeFields[$documentType] = $fields;
            }
        }
        if (count($undetectedDocTypeFields) > 0) {
            $detectedDocFieldMappings = array_merge($detectedDocFieldMappings, $this->loadBulkDocumentFieldMapping($undetectedDocTypeFields));
        }
        return $detectedDocFieldMappings;
    }

	protected function getSearchablePostTypes(){
		$searchablePostTypes = array();
		return $searchablePostTypes;
	}

	protected function saveBlackListUrls($data){
        if(!empty($data)) {
            update_option($this->pluginOptions["blacklist_urls"], $data);
            $this->pluginSettings["blacklist_urls"] = $data;
        }else{
            delete_option($this->pluginOptions["blacklist_urls"]);
            $this->pluginSettings["blacklist_urls"] = "";
        }
        $this->blackListUrls = $this->getBlackListUrls();
    }

	protected function getBlackListUrls(){
		$regExp = '/^https?:\/\/(www\.)?/';
        $pluginBlackListUrls = $this->pluginSettings["blacklist_urls"];
        if(!empty($pluginBlackListUrls)){
            $pluginBlackListUrlsArr      = explode("\n",$pluginBlackListUrls);
            $pluginBlackListUrlsFinalArr = array();
            if(count($pluginBlackListUrlsArr) > 0){
                foreach($pluginBlackListUrlsArr as $url){
                    if(!empty($url)){
                    	$url = preg_replace($regExp, '', $url);
                        array_push($pluginBlackListUrlsFinalArr, $url);
                    }
                }
            }
            if(count($pluginBlackListUrlsFinalArr) > 0){
                return $pluginBlackListUrlsFinalArr;
            }
        }
        return "";
    }
	protected function sendActivationInfo(){
		$activation_status = get_option($this->pluginOptions["siq_activated"], false);
		if($activation_status === false){
				$this->recordActivation();
		}
	}
	private function recordActivation(){
		$activationNumber = time().rand(1,9999);
		$args			  = array();
		$callParams["id"] = $activationNumber;
		$CallUrl  = SIQ_SERVER_BASE."siq/install";
		$CallUrl .= '?' . $this->serialize_params( $callParams );
		$res = wp_remote_request( $CallUrl, $args );
		if(!is_wp_error( $res ) ) {
			update_option($this->pluginOptions["siq_activated"], $activationNumber);
		}
	}
	private function serialize_params( $params ) {
		$query_string = "";
		if(is_array($params) && count($params) > 0) {
			foreach ($params as $k => $v) {
				$query_string .= $k . "=" . $v . '&';
			}
			$query_string = substr($query_string, 0, -1);
		}
		return $query_string; 
	}
	
	protected function addPdfToSearchiq($media, $postID = ""){
		$log = false;
		if(is_array($media) && count($media) > 0){
			foreach($media as $mediaID){
				$dataMedia = get_post($mediaID);
				if($dataMedia->post_mime_type = "application/pdf"){
					$this->siq_insert_post($mediaID, $dataMedia);
					$this->log_error("=== save pdf ==", $log);
					$this->log_error(print_r($dataMedia, true), $log);
				}
			}
		}else if(!empty($media) && (int)$media > 0){
			$dataMedia = get_post($media);
			if($dataMedia->post_mime_type = "application/pdf"){
				$this->siq_insert_post($mediaID, $dataMedia);
				$this->log_error("=== save pdf ==", $log);
				$this->log_error(print_r($dataMedia, true), $log);
			}
		}
	}
	
	protected function deletePdfFromSearchiq($media, $postID = ""){
		$log = false;
		if(is_array($media) && count($media) > 0){
			foreach($media as $mediaID){
				$dataMedia = get_post($mediaID);
				if(($dataMedia->post_mime_type = "application/pdf" && empty($postID)) || ($dataMedia->post_mime_type = "application/pdf" && !empty($postID) && $dataMedia->post_parent == $postID)){
					$this->siq_delete_post($dataMedia->ID, $dataMedia->post_type);
					$this->log_error("=== remove pdf ==", $log);
					$this->log_error(print_r($dataMedia, true), $log);
				}
			}
		}else if(!empty($media) && (int)$media > 0){
			$dataMedia = get_post($media);
			if(($dataMedia->post_mime_type = "application/pdf" && empty($postID)) || ($dataMedia->post_mime_type = "application/pdf" && !empty($postID) && $dataMedia->post_parent == $postID)){
				$this->siq_delete_post($dataMedia->ID, $dataMedia->post_type);
				$this->log_error("=== remove pdf ==", $log);
				$this->log_error(print_r($dataMedia, true), $log);
			}
		}
	}
}

