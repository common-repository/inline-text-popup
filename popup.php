<?php
if ( ! defined( 'ABSPATH' ) ) {
	die("You can't access this file directly");
}

if($this->aPopups)
{
	foreach($this->aPopups as $aVar)
	{
		$wps_modal_id = $aVar['popup_id'];
		$wps_shortcode_content = $aVar['shortcode_content'];
		$wps_modal_content = $aVar['popup_content'];
		$wps_modal_title = $aVar['popup_title'];

?>
	<div id="<?php echo $wps_modal_id ?>" class="wps-inline-modal">
	  <div class="wps-inline-modal-content">  	
		<div class="wps-inline-modal-header">
			<span class="wps-inline-modal-close" onclick="wpsCloseModalPopup('<?php echo $wps_modal_id ?>');">&times;</span>
			<h4 class="wps-inline-modal-title"><?php echo $wps_modal_title ?></h4>
		</div>	
		<div class="wps-inline-modal-body">
			<p><?php echo $wps_modal_content; ?></p>
		</div>	
	  </div>
	</div>
<?php } } ?>	