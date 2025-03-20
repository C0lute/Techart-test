<?php
include 'Controller/NewsController.php';
//$last_news = mysqli_fetch_array($sql);
//var_dump($row);
$limit = 4;
$count = 0;
$count_rows1 = $sql->num_rows;
if ($count_rows1 % $limit) { //считаем кол-во страниц на сайте (5)
	$count_rows = intdiv($count_rows1, $limit) + 1;
}
$url = $_SERVER['QUERY_STRING'];

function translit($str) //транслит для страниц
{
	$tr = array( //словарь транслита
		"А" => "A",
		"Б" => "B",
		"В" => "V",
		"Г" => "G",
		"Д" => "D",
		"Е" => "E",
		"Ж" => "J",
		"З" => "Z",
		"И" => "I",
		"Й" => "Y",
		"К" => "K",
		"Л" => "L",
		"М" => "M",
		"Н" => "N",
		"О" => "O",
		"П" => "P",
		"Р" => "R",
		"С" => "S",
		"Т" => "T",
		"У" => "U",
		"Ф" => "F",
		"Х" => "H",
		"Ц" => "TS",
		"Ч" => "CH",
		"Ш" => "SH",
		"Щ" => "SCH",
		"Ъ" => "",
		"Ы" => "YI",
		"Ь" => "",
		"Э" => "E",
		"Ю" => "YU",
		"Я" => "YA",
		"а" => "a",
		"б" => "b",
		"в" => "v",
		"г" => "g",
		"д" => "d",
		"е" => "e",
		"ж" => "j",
		"з" => "z",
		"и" => "i",
		"й" => "y",
		"к" => "k",
		"л" => "l",
		"м" => "m",
		"н" => "n",
		"о" => "o",
		"п" => "p",
		"р" => "r",
		"с" => "s",
		"т" => "t",
		"у" => "u",
		"ф" => "f",
		"х" => "h",
		"ц" => "ts",
		"ч" => "ch",
		"ш" => "sh",
		"щ" => "sch",
		"ъ" => "y",
		"ы" => "yi",
		"ь" => "",
		"э" => "e",
		"ю" => "yu",
		"я" => "ya",
		"Ё" => "E",
		"Є" => "E",
		"Ї" => "YI",
		"ё" => "e",
		"є" => "e",
		"ї" => "yi",
		" " => "_",
		"/" => "_"
	);
	if (preg_match('/[^A-Za-z0-9_\-]/', $str)) {
		$str = strtr($str, $tr);
		$str = preg_replace('/[^A-Za-z0-9_\-.]/', '', $str);
	}
	else{
		return 0;
	}
	return $str;
}
mysqli_data_seek($sql, 0);
function pr($all)
{
	static $int = 0;
	echo '<pre><b style="background: red;padding: 1px 5px;">' . $int . '</b> ';
	print_r($all);
	echo '</pre>';
	$int++;
}


?>
<?php ///отрисовка главной новости
//pr($all);
for ($count; ($count < $all[$count]); $count++) {
	if ($url == 'page=' . translit($all[$count][2])) { //выгрузка детальной страницы
		//pr($all);
		$convernt_date = new DateTimeImmutable($all[$count][1]);
		$convernt_date = $convernt_date->format('d.m.Y');
		$count = 0;
		echo "
				<hr style='margin: 0 0 1% 0;'></hr>  
				<ul class='detal_new_ul'>
    				<li><a href='?page=1' class='detal_new_mainPage'>Главная</a></li>
					<li>/</li>
					<li><span class = 'detal_new_span'>". $all[$count][2]."</span></li>
				</ul>
				<h1 class='detal_new_h1'>". $all[$count][2]."</h1>
				<span class = 'detal_news_date'>$convernt_date</span>
				<div class='detal_new'>
					<div class='detal_new_1'>
							<span class='detal_new_annonce'>" . strip_tags(($all[$count][3])) . "</span>
						".$all[$count][4]."
					
					</div>
					<img src='images/". $all[$count][5]."' class='detal_new_img''>
				</div>
				<a href='?page=1' class='news_img' style='margin: 0 10% 5% 10%'>
									<svg style='transform: rotate(180deg);' height='25px'  width='32px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
										<g fill='none' fill-rule='evenodd'>
											<path d='m9.88528137 7.48578644 1.41421353 1.41421356-6.0994949 6.0997864 25.4426407.0002136v2l-25.4286407-.0002136 6.0854949 6.085495-1.41421353 1.4142135-8.48528137-8.4852813.022-.0214272-.022-.0217186z'
											fill='#841844' transform='matrix(-1 0 0 -1 32.04264 31.985282)' />
										</g>
									</svg>
									<span style='display: inline-block; '>НАЗАД К НОВОСТЯМ</span>
								</a>
			";
		break;
	}
	if (($url == 'page=' . $count) || ($url == null)) { //выгрузка новостей 
		$count = 0;
		echo "	
				<div class='last_news' style='background-image: url(\"/images/{$last_news['image']}\"); background-position: center; background-repeat: no-repeat; background-size: cover; height: 750px; -webkit-box-shadow: 0px 0px 20px 15px rgba(0, 0, 0, 0.71) inset; '>
					<div class= 'last_news_text'>
						<h1 class='last_news_text_h1'>{$last_news['title']}</h1>
						<p class='last_news_text_p'>" . strip_tags(($last_news['announce'])) . "</p>
					</div>
				</div>
			";
		mysqli_data_seek($sql, 0);
		echo "
					<h2 class = 'big_news'>Новости</h2>
					<div class = 'news'>
			";	///ниже отрисовка остальных новостей в блоке news
		for ($count; $count < $count_rows1; $count++) { /// Проверяем все страницы, если count = значению нынешней страницы, отрисовываем ее и обнуляем count
			if (('page=' . $count == $url) || ($url == "")) {
				mysqli_data_seek($sql, ($count - 1) * $limit); //корректировка указателя в массиве новостей
				$count = 0;
				for ($count; ($count < $limit); $count++) { // xz?
					
					$row = mysqli_fetch_array($sql);
					//var_dump($row);
					$convernt_date = new DateTimeImmutable($row['date']);
					$convernt_date = $convernt_date->format('d.m.Y');
					if ($row == NULL){
						
					}
					else{
						echo "
									<div class = 'all_news'>
										<span class = 'news_date'>$convernt_date</span>
										<h3 class='news_h3'>{$row['title']}</h3>
										<p class='all_news_p'>" . strip_tags(($row['announce'])) . "</p>
										<a href='?page=" . translit($row['title']) . "' class='news_img'>ПОДРОБНЕЕ
											<svg height='25px'  width='32px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
												<g fill='none' fill-rule='evenodd'>
													<path d='m9.88528137 7.48578644 1.41421353 1.41421356-6.0994949 6.0997864 25.4426407.0002136v2l-25.4286407-.0002136 6.0854949 6.085495-1.41421353 1.4142135-8.48528137-8.4852813.022-.0214272-.022-.0217186z'
													fill='#841844' transform='matrix(-1 0 0 -1 32.04264 31.985282)' />
												</g>
											</svg>
										</a>
									</div>
							";
					}
				}
				break;
			}
		}
		echo "<div class='btn_menu' style='justify-content: end;'>"; ///отрисовка кнопок снизу
		if ($url == "") { //отрисовка для index страницы
			$count = 1;
			echo "
						<a href='?page=" . ($count) . "'class='btn_menu_chislo'>  " . ($count) . "</a>
						<a href='?page=" . ($count + 1) . "'class='btn_menu_chislo'>  " . ($count + 1) . "</a>
						<a href='?page=" . ($count + 2) . "'class='btn_menu_chislo'>  " . ($count + 2) . "</a>
						<a href='?page=" . ($count + 1) . "' class='btn_menu_svg'>
							<svg height='25px'  width='32px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
								<g fill='none' fill-rule='evenodd'>
									<path d='m9.88528137 7.48578644 1.41421353 1.41421356-6.0994949 6.0997864 25.4426407.0002136v2l-25.4286407-.0002136 6.0854949 6.085495-1.41421353 1.4142135-8.48528137-8.4852813.022-.0214272-.022-.0217186z'
									fill='#841844' transform='matrix(-1 0 0 -1 32.04264 31.985282)' />
								</g>
							</svg>
						</a>";
		}
		for ($count = 1; $count <= $count_rows1; $count++) { //16/4=5 страниц
			if ('page=' . $count == $url) { //если нынешняя страница = странице count (1..)
				if (($count >= 2) && ($count != $count_rows)) { //для остальных страниц
					echo "
								<a href='?page=" . ($count - 1) . "' class='btn_menu_svg' style='order:-1; transform: rotate(180deg);'>
									<svg height='25px'  width='32px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
										<g fill='none' fill-rule='evenodd'>
											<path d='m9.88528137 7.48578644 1.41421353 1.41421356-6.0994949 6.0997864 25.4426407.0002136v2l-25.4286407-.0002136 6.0854949 6.085495-1.41421353 1.4142135-8.48528137-8.4852813.022-.0214272-.022-.0217186z'
											fill='#841844' transform='matrix(-1 0 0 -1 32.04264 31.985282)' />
										</g>
									</svg>
								</a>
								<a href='?page=" . ($count - 1) . "'class='btn_menu_chislo'>  " . ($count - 1) . "</a>
								<a href='?page=" . ($count) . "'class='btn_menu_chislo' style='background-color: #841844; color: white;'>  " . ($count) . "</a>
								<a href='?page=" . ($count + 1) . "'class='btn_menu_chislo'>  " . ($count + 1) . "</a>
								<a href='?page=" . ($count + 1) . "' class='btn_menu_svg'>
									<svg height='25px'  width='32px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
										<g fill='none' fill-rule='evenodd'>
											<path d='m9.88528137 7.48578644 1.41421353 1.41421356-6.0994949 6.0997864 25.4426407.0002136v2l-25.4286407-.0002136 6.0854949 6.085495-1.41421353 1.4142135-8.48528137-8.4852813.022-.0214272-.022-.0217186z'
											fill='#841844' transform='matrix(-1 0 0 -1 32.04264 31.985282)' />
										</g>
									</svg>
								</a>";
				} elseif ($count == $count_rows) { //для последней страницы
					echo "
								<a href='?page=" . ($count - 1) . "' class='btn_menu_svg' style='order:-1; transform: rotate(180deg);'>
									<svg height='25px'  width='32px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
										<g fill='none' fill-rule='evenodd'>
											<path d='m9.88528137 7.48578644 1.41421353 1.41421356-6.0994949 6.0997864 25.4426407.0002136v2l-25.4286407-.0002136 6.0854949 6.085495-1.41421353 1.4142135-8.48528137-8.4852813.022-.0214272-.022-.0217186z'
											fill='#841844' transform='matrix(-1 0 0 -1 32.04264 31.985282)' />
										</g>
									</svg>
								</a>
								<a href='?page=" . ($count - 2) . "'class='btn_menu_chislo'>  " . ($count - 2) . "</a>
								<a href='?page=" . ($count - 1) . "'class='btn_menu_chislo'>  " . ($count - 1) . "</a>
								<a href='?page=" . ($count) . "'class='btn_menu_chislo' style='background-color: #841844; color: white;'>  " . ($count) . "</a>";
				} else { //для первой страницы
					echo "
								<a href='?page=" . ($count) . "'class='btn_menu_chislo' style='background-color: #841844; color: white;'>  " . ($count) . "</a>
								<a href='?page=" . ($count + 1) . "'class='btn_menu_chislo'>  " . ($count + 1) . "</a>
								<a href='?page=" . ($count + 2) . "'class='btn_menu_chislo'>  " . ($count + 2) . "</a>
								<a href='?page=" . ($count + 1) . "' class='btn_menu_svg'>
									<svg height='25px'  width='32px' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
										<g fill='none' fill-rule='evenodd'>
											<path d='m9.88528137 7.48578644 1.41421353 1.41421356-6.0994949 6.0997864 25.4426407.0002136v2l-25.4286407-.0002136 6.0854949 6.085495-1.41421353 1.4142135-8.48528137-8.4852813.022-.0214272-.022-.0217186z'
											fill='#841844' transform='matrix(-1 0 0 -1 32.04264 31.985282)' />
										</g>
									</svg>
								</a>";
				}
			}
		}
		echo "
				</div> 
			</div>"; //закрытие блока btn_menu и news
		break;
	}
	else{

	}
	
}
?>