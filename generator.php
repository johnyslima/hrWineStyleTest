<?php
	// задаем имена переменным
	$imageName = $_GET['name'];
	$imageSize = $_GET['size'];
	$imagePath = "gallery/{$imageName}.jpg";
	
	// проверка на наличия файла в папке gallery
	if (!file_exists($imagePath)){
		header("HTTP/1.0 404 Not Found");
		exit;
	}

	// проверка на значения переменных
	if (!isset($imageSize) || trim($imageSize)===''){
		header("HTTP/1.0 404 Not Found");
		exit;
	}

	// подключаемся к базе
	$username = "root";
	$servername = "localhost";
	$password = "";
	$link = mysql_connect($servername, $username, $password)
		or die ("bad connection");
	mysql_select_db("testWineStyle",$link) 
  		or die("Could not select examples");

  	

  	// формируем запрос на получения высоты и ширины 
  	$querySize = sprintf("SELECT * FROM Size WHERE name ='%s'",	mysql_real_escape_string($imageSize));
  	$result = mysql_query($querySize);
  	$result = mysql_fetch_assoc($result);
  	if (!isset($result)) {
		header("HTTP/1.0 404 Not Found");
		exit;
  	}
  	$dstWidth = $result['Width'];
  	$dstHeight = $result['Height'];
  	
  	// создаем папку с названием параметра "size" в каталоге "cache"
  	Header("Content-type: image/jpg");
  	$imageCacheDirectory = "cache/{$imageSize}";
  	if (!file_exists($imageCacheDirectory)){ 
  		mkdir($imageCacheDirectory);
  	}

  	// генерируем рисунок
  	$imagePathCache = "{$imageCacheDirectory}/{$imageName}.jpg";
  	if  (!file_exists($imagePathCache)){
		list($srcWidth, $srcHeight) = getimagesize($imagePath);
		$src = imageCreateFromJpeg($imagePath);
		if ($srcWidth < $dstWidth && $srcHeight < $dstHeight){ // сравниваем параметры рисунка с параметрами, указанными в базе
			imageJpeg($src);									//в случае, если файл не загружен в cache, берем его из gallery
			imageDestroy($src);
			exit;
		}

		$dstRatio = $dstHeight / $dstWidth; // высчитываем соотношения сторон, для сохранения пропорций при масштабировании
		$srcRatio =	$srcHeight / $srcWidth;
		if ($srcRatio > $dstRatio){
			$newHeight = $dstHeight;
			$newWidth = round($newHeight / $srcRatio);
		}
		else {
			$newWidth = $dstWidth;
			$newHeight = round($newWidth * $srcRatio);
		}

		$dst = imagecreatetruecolor($newWidth, $newHeight);

		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);
		
		imageJpeg($dst, $imagePathCache); //сохранения рисунка в папке cache/[указанный параметр size]
		imageDestroy($dst);
		imageDestroy($src);		
	}
	
	$cachedImg = imageCreateFromJpeg($imagePathCache);
	imageJpeg($cachedImg);
	imageDestroy($cachedImg); /**/
?>