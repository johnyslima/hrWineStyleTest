<!DOCTYPE html> 
<html lang="ru"> 
<head> 
  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Image - generator</title> 
  <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="fancybox/jquery.fancybox.css" type="text/css" media="screen" /> 
</head> 
<body> 
<div class="container"> 
  <h1> Image - generator test</h1>
    <div class="row">  
      <div class="col-xs-2"> 
        <a class="fancyimage" rel="group"  >
          <img src="generator.php?name=1&size=mic" />
        </a> 
      </div>
      <div class="col-xs-2"> 
        <a class="fancyimage" rel="group" >
          <img src="generator.php?name=2&size=mic" />
        </a> 
      </div> 
     <div class="col-xs-2"> 
        <a class="fancyimage" rel="group" >
          <img src="generator.php?name=3&size=mic" />
        </a> 
      </div> 
      <div class="col-xs-2"> 
        <a class="fancyimage" rel="group" >
          <img src="generator.php?name=4&size=mic" />
        </a> 
      </div> 
      <div class="col-xs-2"> 
        <a class="fancyimage" rel="group" >
          <img src="generator.php?name=5&size=mic" />
        </a> 
      </div>  <!----> 
    </div> 
</div> 
  <script src="jquery/jquery-1.11.2.min.js"></script> 
  <script src="bootstrap-3.3.2/js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="fancybox/jquery.fancybox.pack.js"></script> 
  <script type="text/javascript"> 
    $(document).ready(function() {
      //$("a.fancyimage").fancybox();
      $("a.fancyimage").click(
        function () {
          var nameImg = $(this).children("img").attr("src");
          nameImg = nameImg.substring(0, nameImg.length - 3);
           $.fancybox([
            nameImg + 'big',
            nameImg + 'med',
            nameImg + 'min',
            nameImg + 'mic'
              ], {
            'padding'     : 0,
            'transitionIn'    : 'none',
            'transitionOut'   : 'none',
            'type'              : 'image',
            'changeFade'        : 0
              });
        }
      ); 
     
    }); 
  </script> 
</body> 
</html>