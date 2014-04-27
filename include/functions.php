<?php
?>
<!doctype html>
<?php
	
	//SAE会有时候会失败...
	function isImg($url){
		 $params = array('http' => array(
					  'method' => 'HEAD'
				   ));
		 $ctx = stream_context_create($params);
		 $fp = @fopen($url, 'rb', false, $ctx);
		 if (!$fp) 
			return false;  // Problem with url

		$meta = stream_get_meta_data($fp);
		if ($meta === false)
		{
			fclose($fp);
			return false;  // Problem reading data from url
		}

		$wrapper_data = $meta["wrapper_data"];
		if(is_array($wrapper_data)){
		  foreach(array_keys($wrapper_data) as $hh){
			  if (substr($wrapper_data[$hh], 0, 19) == "Content-Type: image") // strlen("Content-Type: image") == 19 
			  {
				fclose($fp);
				return true;
			  }
		  }
		}
		fclose($fp);
		return false;
	}//isImg

	function isImage($url){
		$pos = strrpos( $url, ".");
		if ($pos === false)
			return false;
		$ext = strtolower(trim(substr( $url, $pos)));
		$imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif"); // this is far from complete but that's always going to be the case...
		if ( in_array($ext, $imgExts) )
			return true;
		return false;
	}

	function tpl_isImageStr($params){
		$temp = $params['url'];
		$tid = $params['tid'];
        if(isImage($temp)){
			echo '';
		} else {
			echo '<i class="icon-fullscreen" title="view article" onclick="viewArticle('.$tid.');"></i>';
		}
	}

	function tpl_echoContent($params){
		$temp = $params['url'];
		$tid = $params['tid'];
        if(isImage($temp)){
			echo '<img style="cursor:pointer" onclick="viewImage('.$tid.');" class="img-rounded" src="'.$temp.'">';
		} else {
			echo $temp;
		}
	}
	//
	spAddViewFunction('isImageStr','tpl_isImageStr');//模板中调用
	spAddViewFunction('echoContent','tpl_echoContent');//模板中调用

?>