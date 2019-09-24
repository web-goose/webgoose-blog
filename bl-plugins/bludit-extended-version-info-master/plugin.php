<?php
class BluditExtendedVersionInfo extends Plugin {
	var $autoUpdaterInstalled = false;//future integration with bludit auto updater
	public function adminSidebar(){
		$html = '<span class="badge badge-info">BUILD '.BLUDIT_BUILD.'</span><br>';
		$html .= '<span class="badge badge-info">VERSION '.BLUDIT_VERSION.'</span><br>';
		$html .= '<span class="badge badge-success" id="current-version">up to date</span><br>';
		
		if($this->autoUpdaterInstalled){
			$html .= '<a style="color: white;" href="'.HTML_PATH_ADMIN_ROOT.'configure-plugin/BluditUpdater" class="btn btn-block btn-primary new-version">new version available<br>update now <span class="oi oi-reload" style="color: white;"></span></a><br>';
		} else {
			$html .= '<a style="color: white;" href="https://github.com/bludit/bludit/archive/master.zip" class="btn btn-block btn-primary new-version">new version available<br>Download newest version <span class="oi oi-reload" style="color: white;"></span></a><br>';
		}
		
		return $html;
	}
	public function adminBodyEnd(){
		$script  = '<script>function getLatestVersion(){$.ajax({url: "https://version.bludit.com",method: "GET",dataType: "json",success: function(json){if (json.stable.build > BLUDIT_BUILD){$("#current-version").hide();$(".new-version").show();}},error: function(json){console.log("error getting the current Bludit version status");}});}$(".new-version").hide();getLatestVersion();</script>';
		return $script;
	}
}
?>