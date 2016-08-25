<?php

echo "<div>";
echo 	"<div class='autorleft'>";
echo 		$OUTPUT->heading_with_help(get_string('meuscursos', 'local_mdlautor'), 'meuscursos', $component = 'local_mdlautor', $icon = '', $iconalt = '', $level = 3, $classnames = null);
echo 		"<a href='".$CFG->wwwroot."/local/mdlautor/view.php?aba=autor&content=addoai'>";
echo 			"<img id='autor-add' src='".$CFG->wwwroot."/local/mdlautor/pix/add.png'>";
echo 		"</a>";
echo 	"</div>";
echo 	"<div class='autorrigth'>";
	
	if (!isset($_GET['content']) or $_GET['content'] == ''){
		
		if (isset($_GET['page'])){$page = $_GET['page'];}else{$page=1;}
		
		$table = "local_mdlautor_oai";
		$count = $DB->count_records($table,array('ativo'=>1));
		$cursos_por_tela = $GLOBALS["cursos_por_tela"];
		$records = $DB->get_records($table, $conditions=array('ativo'=>1), $sort='', $fields='*', $limitfrom=(($cursos_por_tela*$page) - $cursos_por_tela), $limitnum=$cursos_por_tela );
		
		$page_qd = intval($count/12)+1;
		if($page_qd>1){
			echo "<div class='mdlautor_paginacao'>";
				if ($page>1){echo "<a href='?page=".($page-1)."'><<&nbsp; Anterior </a>";}			
				echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				if ($page<$page_qd){echo "<a <a href='?page=".($page+1)."'> Próxima  &nbsp; >></a>";}
			echo "</div>";
		}
		
		foreach ($records as $value){ 
			
		output_bloco_curso_by_id($value->id);		
		
		}
	}
	
	
	
	if ($_GET['content'] == 'addoai'){    
			$add_oai_form = new add_oai_form();
			$add_oai_form->display();
	}
echo 	"</div>";


?>