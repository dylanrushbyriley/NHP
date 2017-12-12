<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$settings 		= $this->getPluginSettings();
	$code 			= $settings['auth_code'];
	$engine 		= stripslashes($settings['engine_name']);
	$engineCode		= $settings['engine_code'];
	$indexed 		= $settings['index_posts'];
	
	$tab1Selected = isset($_GET['tab']) ? ( ($_GET['tab']=='tab-1')? 'selected': 'notselected') : "selected";
	$tab2Selected = isset($_GET['tab']) ? ( ($_GET['tab']=='tab-2')? 'selected': 'notselected') : "notselected";
	$tab3Selected = isset($_GET['tab']) ? ( ($_GET['tab']=='tab-3')? 'selected': 'notselected') : "notselected";
	$tab4Selected = isset($_GET['tab']) ? ( ($_GET['tab']=='tab-4')? 'selected': 'notselected') : "notselected";
        $tab5Selected = isset($_GET['tab']) ? ( ($_GET['tab'] == 'tab-5') ? 'selected' : 'notselected') : 'notselected';
	$tab6Selected = !!$this->pluginSettings["facets_enabled"] && isset($_GET['tab']) && $_GET['tab'] == "tab-6" ? "selected" : "notselected";
    if (isset($_GET['tab']) && $_GET['tab'] == 'tab-6' && $tab6Selected != "selected") {
        $tab1Selected = "selected";
    }

	$tab2Selected .= ($code == "" && $engineCode=="" && ($indexed == "" || $indexed == 0)) ? " hide": "";
	$tab3Selected .= ($code == "" && $engineCode=="" && ($indexed == "" || $indexed == 0)) ? " hide": "";
	$tab4Selected .= ($code == "" && $engineCode=="" && ($indexed == "" || $indexed == 0)) ? " hide": "";
        $tab5Selected .= ($code == "" && $engineCode=="" && ($indexed == "" || $indexed == 0)) ? " hide": "";
    $tab6Selected .= (!$this->pluginSettings["facets_enabled"] || empty($code) || empty($engineCode) || empty($indexed)) ? " hide" : "";
?>
<div class="backendTabbed" id="searchIqBackend">
	<div class="tabsHeading">
		<ul>
			<li id="tab-1" class="<?php echo $tab1Selected;?>">
				<a href="<?php echo admin_url( 'admin.php?page=dwsearch&tab=tab-1'); ?>">Configuration</a>
			</li>
			<li id="<?php echo $tab2Selected == "notselected hide" ? "" : "tab-2";?>" class="<?php echo $tab2Selected;?>">
				<a href="<?php echo admin_url( 'admin.php?page=dwsearch&tab=tab-2'); ?>">Options</a>
			</li>
			<li id="<?php echo $tab3Selected == "notselected hide" ? "" : "tab-3";?>" class="<?php echo $tab3Selected;?>">
				<a href="<?php echo admin_url( 'admin.php?page=dwsearch&tab=tab-3'); ?>">Results Page</a>
			</li>
			<li id="<?php echo $tab4Selected == "notselected hide" ? "" : "tab-4";?>" class="<?php echo $tab4Selected;?>">
				<a href="<?php echo admin_url( 'admin.php?page=dwsearch&tab=tab-4'); ?>">Autocomplete</a>
			</li>
			<li id="<?php echo $tab5Selected == "tab-5 hide" ? "" : "tab-5";?>" class="<?php echo $tab5Selected;?>">
				<a href="<?php echo admin_url( 'admin.php?page=dwsearch&tab=tab-5'); ?>">Mobile</a>
			</li>
            <?php
            if (!!$this->pluginSettings["facets_enabled"]) {
                ?>
                <li id="tab-6" class="<?php echo $tab6Selected; ?>">
                    <a href="<?php echo admin_url('admin.php?page=dwsearch&tab=tab-6'); ?>">Facets</a>
                </li>
                <?php
            }
            ?>
		</ul>
	</div>
	<div class="tabsContent">
		<div class="tab tab-1 <?php echo $tab1Selected;?>">
			<?php include_once(SIQ_BASE_PATH.'/templates/backend/config.php'); ?>
		</div>
		<div class="tab tab-2 <?php echo $tab2Selected;?>">
			<?php include_once(SIQ_BASE_PATH.'/templates/backend/optionsPage.php'); ?>
		</div>
		<div class="tab tab-3 <?php echo $tab3Selected;?>">
			<?php include_once(SIQ_BASE_PATH.'/templates/backend/appearance.php'); ?>
		</div>
		<div class="tab tab-4 <?php echo $tab4Selected;?>">
			<?php include_once(SIQ_BASE_PATH.'/templates/backend/appearance-autocomplete.php'); ?>
		</div>
                <div class="tab tab-5 <?php echo $tab5Selected;?>">
			<?php include_once(SIQ_BASE_PATH.'/templates/backend/appearance-mobile.php'); ?>
		</div>
        <?php
        if (!!$this->pluginSettings["facets_enabled"]) {
            ?>
            <div class="tab tab-6 <?php echo $tab6Selected;?>">
                <?php include_once(SIQ_BASE_PATH . '/templates/backend/facets.php'); ?>
            </div>
            <?php
        }
        ?>
	</div>
	<script type="text/javascript">
		var siq_admin_nonce = "<?php  echo wp_create_nonce( $this->adminNonceString ); ?>";
	</script>
</div>
<script type="text/javascript">
	$jQu	= jQuery;
	$jQu(document).on('click', '.clearColor', function(){
		$jQu(this).prev('.color').val("").attr("style", "").attr("value", "");
	});
</script>
