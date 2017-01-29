<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Постраничный вывод</title>
	</head>
	<body>
		<?php
		
			define('RecordInPage', 10);
			
			$currentPage = Controller();
			
			$numberRecord = 100;
			for ($i = 0; $i < $numberRecord; $i++){
				$content[$i] = 'Сообщение ' . $i;
			}
			$numberOfPages = $numberRecord/RecordInPage;
			
			Model($currentPage, $numberOfPages);		
			
			View ($currentPage, $content, $numberOfPages);
			
		?>
	</body>
</html>
<?php 

	function Controller (){
		$page = empty($_GET['page']) ? 1 : intval($_GET['page']);
		return $page;
	}
			
	function Model ($currentPage, $numberOfPages){
		if ($currentPage <= 0 || $currentPage > $numberOfPages){
			die('Неправильный ввод данных!');
		}
	}
	
	function View ($currentPage, $data, $numberOfPages){
				$start = ($currentPage - 1)*RecordInPage;	$end = $start + RecordInPage;
				for ($i = $start; $i < $end; $i++){
					echo '<p>' . $data[$i] . '</p>';
				}
				function viewHref($hrefPage){
					echo ' <a href="Task1.php?page=' . $hrefPage .'">' . $hrefPage . '</a> ';
				}
					echo '<p>';
					$prev = $currentPage - 1; $next = $currentPage + 1;
					for ($i = 1; $i <= $numberOfPages; $i++){
						if ($i == 1){
							viewHref($i);
							if (!(($prev-1) == 1 || $prev == 1)){
								echo '...';
							}
							continue;
						}
						if ($prev == 0 || $next == ($numberOfPages+1)){
							viewHref($numberOfPages);
							break;
						}
						if ($i == $numberOfPages){
							if (!(($next) == $numberOfPages || ($next+1) == $numberOfPages)){
								echo '...';
							}
							viewHref($i);
							continue;
						}
						if ($i == $prev)
							viewHref($i);
						if ($i == $currentPage)
							viewHref($i);
						if ($i == $next)
							viewHref($i);
					}
					echo '</p>';
			}
?>
