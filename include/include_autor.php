<?php

echo "<div>";
echo 	"<div class='autorleft'>";
echo 		$OUTPUT->heading_with_help(get_string('meuscursos', 'local_mdlautor'), 'meuscursos', $component = 'local_mdlautor', $icon = '', $iconalt = '', $level = 3, $classnames = null);
echo 		"<a href='".$CFG->wwwroot."/local/mdlautor/view.php?aba=autor&content=addoai'>";
echo 			"<img id='autor-add' src='".$CFG->wwwroot."/local/mdlautor/pix/add.png'>";
echo 		"</a>";
echo 	"</div>";
echo 	"<div class='autorrigth'>";
	
	if (!isset($_GET['content'])){
		if (isset($_GET['page'])){$page = $_GET['page'];}else{$page=1;}
		$table = "local_mdlautor_oai";
		$records = $DB->get_records($table, $conditions=null, $sort='', $fields='*', $limitfrom=(10*($page) - 10), $limitnum=(10*($page)) );
		print_r($records);
		
		foreach ($records as $value){ 
			echo "</pre>";
			print_r($value);
			echo "X";
			echo "<pre>";			
		}
	}
	
	if ($_GET['content'] == 'addoai'){    
			$add_oai_form = new add_oai_form();
			$add_oai_form->display();
	}
echo 	"</div>";


?>