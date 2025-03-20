
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Тестовое задание Techart</title>
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/detal_view.css">
    <link rel="stylesheet" href="./styles/resolution_main.css">
    <link rel="stylesheet" href="./styles/resolution_detal.css">

  </head>
  	<body> <?php //head.php ?>
        <header> <?php //header.php ?>
               <!-- Шапка сайта -->
            <div class="top">
				      <a href="/" ><img src="images\logo.svg"></a>
            </div>
            
        </header> <?php //header.php ?>
        <?php
            include 'View/newsView.php';
        ?>

		<footer class="footer">
            <hr></hr>     
			<div class="footer__left">© 2023 - 2412 «Галактический вестник»</div>
		</footer>
  	</body>
</html>