<?php

echo "<div>";
echo 	"<div class='autorleft'>";

		$value = get_curso_by_id($_GET['idoa']);
		
			echo "<div class='mdlautor_curso_edit'>";
			echo 	"<div class='mdlautor_curso_title_edit'>";
			echo 	"	<h4>".$value->nome."</h3>";
			echo 	"</div>";
			echo 	"<div>";
			echo 	"	<div class='mdlautor_curso_edit'>";
			echo 	"		<a href='".$CFG->wwwroot."/local/mdlautor/view.php?idoa=".$value->id."&aba=".$_GET['aba']."&content=oaedit'>Editar </a>";
			echo 	"	</div>";
			echo 	"</div>";			
			echo 	"<div>";
			echo 	"<a href='".$CFG->wwwroot."/local/mdlautor/view.php?idoa=".$value->id."'>".get_file_image_by_id($value->imgcurso, $class='mdlautor_img_curso')."</a>";
			echo 	"</div>";

			echo "</div>";	
	
echo 	"</div>";
echo 	"<div class='autorrigth'>";

			if (!isset($_GET['content'])){
						echo 		"<a href='".$CFG->wwwroot."/local/mdlautor/view.php?aba=autor&content=addoai'>";
						echo 			"<img id='unidade-add' src='".$CFG->wwwroot."/local/mdlautor/pix/addua.jpg'>";
						echo 		"</a>";
			}
			
			if ($_GET['content']=="oaedit"){
						$output_oai_form_edit = new output_oai_form_edit();
						$output_oai_form_edit->display();
			}

echo 	"</div>";


?>