<?php
/************************************
Tumblr-uploader &copy;  lolimilk.com
 index.php  Created on 2013.08.06
Weibo: http://weibo.com/614520789
************************************/
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tumblr</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
	<input type="file" name="data" />
    <input type="submit" />
</form>
</body>
</html>
