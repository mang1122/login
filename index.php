<? php
  $page = basename($_SERVER["PHP_SELF"]);
  $path = $_REQUEST["path"];
    if(empty($path)){
        $tempFileName = basename(__FILE__);
        $tempPath = realpath(__FILE__);
        $path=str_replace($tempFileName,"",$tempPath);
        $path=str_replace("\\","/",$path);
    }else {
        $path=realpath($path)."/";
        $path=str_replace("\\","/",$path);
    }
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
      
  </head>
  <body>
    <span><?=$path?><?=$page?><span>
  </body>

