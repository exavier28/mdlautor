<?php

class add_oai_form extends moodleform {
    function definition() {
        global $CFG;

        $mform = $this->_form; 
		
		$title = ucfirst(get_string('nome', 'local_mdlautor'));
		$mform->addElement('text', 'nome', $title, 'maxlength="100" size="25" ');
		
		$oai_types = $GLOBALS["oai_types"];
		foreach ($oai_types as $value){ 
			$oai_types_output[$value] = get_string($value, 'local_mdlautor');
		}
		
		$title = ucfirst(get_string('oai_type', 'local_mdlautor'));
		$mform->addElement('select', 'oai_type', $title, $oai_types_output, $attributes);
		
		$title = ucfirst(get_string("descricaobreve", "local_mdlautor"));
		$mform->addElement('textarea', 'descricaobreve', $title, 'wrap="virtual" rows="6" cols="70"');
		
        $mform->addElement('hidden', 'acao', 'crianovooai');
        $mform->setType('acao', PARAM_TEXT);		
		
		$mform->addElement('filepicker', 'imgcurso', get_string('file'), null, array('maxbytes' => '', 'accepted_types' => '*'));
		
        $this->add_action_buttons(true, $unregisterlabel);
		
    }                           
}   


function executa_lib_post(){
	global $DB,$USER,$CFG;

	if ($_POST['acao'] == 'crianovooai'){
		$table = 'local_mdlautor_oai';
		$dataobject = array("nome"=>"".$_POST['nome']."", 
							"type"=>"".$_POST['oai_type']."", 
							"descricaobreve"=>"".$_POST['descricaobreve']."", 
							"id_user_criador"=>"".$USER->id."",
							"imgcurso"=>"".$_POST['imgcurso']."",		
							"ativo"=>1
							);
		$id = $DB->insert_record($table, $dataobject, $returnid=true, $bulk=false);
		$urltogo = $CFG->wwwroot.'/local/mdlautor/view.php?idoa='.$id;
		redirect($urltogo);
	}
	
		if ($_POST['acao'] == 'editaoai'){
		$table = 'local_mdlautor_oai';
		$dataobject = array("nome"=>"".$_POST['nome']."", 
							"type"=>"".$_POST['oai_type']."", 
							"descricaobreve"=>"".$_POST['descricaobreve']."", 
							"id_user_criador"=>"".$USER->id."",
							"imgcurso"=>"".$_POST['imgcurso_filemanager']."",		
							"ativo"=>1,
							"id"=>$_POST['id']
							);
		$DB->update_record($table, $dataobject, $bulk=false);
		$urltogo = $CFG->wwwroot.'/local/mdlautor/view.php?idoa='.$_POST['id'];
		redirect($urltogo);
	}
	
	
}


function get_file_image_by_id($itemid,$class){
		global $DB,$CFG;

		//Aqui vamos recuperar os registros do file no bano de dados
		//Está sendo gerado 2 linha na tabela para cada arquivo, sendo que a primeira linha apresenta todos os registros completos, usaremos essa.
		$table = "files";
		$file_records = $DB->get_records($table, array('itemid'=>''.$itemid.''));

		//Não sei por qual motivo mas os registros da tabela mdl_files são duplicados
		//Aqui vamos selecionar a linha que possui filename é diferente de um ponto '.'
		foreach ($file_records as $value){ if ($value->filename!='.'){$file_record = $value;} 	}		
		
 		$fs = get_file_storage();

		$fileinfo = array(
			'component' => $file_record->component,     // usually = table name
			'filearea' => $file_record->filearea,     // usually = table name
			'itemid' => $itemid,               // usually = ID of row in table
			'contextid' => $file_record->contextid, // ID of context
			'filepath' => $file_record->filepath,           // any path beginning and ending in /
			'filename' => $file_record->filename); // any filename
		 
		$file = $fs->get_file($fileinfo['contextid'], $fileinfo['component'], $fileinfo['filearea'],
							  $fileinfo['itemid'], $fileinfo['filepath'], $fileinfo['filename']);
		
		if($file){
			$contents = base64_encode($file->get_content());		
			return "<img class='".$class."' alt='Não de certo' src='data:image/gif;base64,".$contents."'>";
		}else{
			return "<img class='".$class."' src='".$CFG->wwwroot."/local/mdlautor/pix/imgcurso.jpg'>";
		}
		
}

function return_object_file_image_by_id($itemid){
		global $DB,$CFG;

		//Aqui vamos recuperar os registros do file no bano de dados
		//Está sendo gerado 2 linha na tabela para cada arquivo, sendo que a primeira linha apresenta todos os registros completos, usaremos essa.
		$table = "files";
		$file_records = $DB->get_records($table, array('itemid'=>''.$itemid.''));
		
		foreach ($file_records as $value){ if ($value->filename!='.'){$file_record = $value;} 	}		
		
 		$fs = get_file_storage();

		$fileinfo = array(
			'component' => $file_record->component,     // usually = table name
			'filearea' => $file_record->filearea,     // usually = table name
			'itemid' => $itemid,               // usually = ID of row in table
			'contextid' => $file_record->contextid, // ID of context
			'filepath' => $file_record->filepath,           // any path beginning and ending in /
			'filename' => $file_record->filename); // any filename
		 
		 return (object)$fileinfo;
}
		

function mdlautor_limitarTexto($texto, $limite){
    $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
    return $texto;
}		

function output_bloco_curso_by_id($idoa){
		global $DB,$CFG;
	
		$table = "local_mdlautor_oai";
		$records = $DB->get_records($table, $conditions=array('ativo'=>1,'id'=>$idoa), $sort='', $fields='*', $limitfrom=(($cursos_por_tela*$page) - $cursos_por_tela), $limitnum=$cursos_por_tela );
	
		
		foreach ($records as $value){ 
			
			echo "<div class='mdlautor_curso'>";
			echo 	"<div class='mdlautor_curso_title'>";
			echo 	"<h4>".$value->nome."</h3>";
			echo 	"</div>";
			echo 	"<div>";
			echo 	"<a href='".$CFG->wwwroot."/local/mdlautor/view.php?idoa=".$value->id."'>".get_file_image_by_id($value->imgcurso, $class='mdlautor_img_curso')."</a>";
			echo 	"</div>";
			echo 	"<div class='mdlautor_curso_descricao'>";
			echo 	"<p>".mdlautor_limitarTexto($value->descricaobreve,$limite = 160)."</p>";
			echo 	"</div>";	
			echo 	"<div  class='mdlautor_curso_type'>";
			echo 	"	<div class='type'><span>".get_string($value->type.'_sigla', 'local_mdlautor')."</span>";	
			echo 	"		<div class='comentario'> ".get_string($value->type, 'local_mdlautor')." </div>";
			echo 	"   </div>";
			echo 	"</div>";
			echo "</div>";			
		}	
}
		
function get_curso_by_id($idoa){
		global $DB,$CFG;
	
		$table = "local_mdlautor_oai";
		$records = $DB->get_records($table, $conditions=array('ativo'=>1,'id'=>$idoa), $sort='', $fields='*', $limitfrom=(($cursos_por_tela*$page) - $cursos_por_tela), $limitnum=$cursos_por_tela );
	
		return $records[$idoa];			
}	

class output_oai_form_edit extends moodleform { 
		function definition() {
			global $CFG;
			//Essa função merece ser bem comentada devido à sua complexidade
			//Primeiramente vamos recuperar os records do objeto de aprendizagem (mdl_local_mdlautor_oai), do file (mdl_files) 
			//Vamos também recuperar os records do contexto do file (mdl_context)
			$valueoa = get_curso_by_id($_GET['idoa']);
			$fileinfo = return_object_file_image_by_id($valueoa->imgcurso);
			if (strlen($fileinfo->filename)>0){$context = context::instance_by_id($fileinfo->contextid);}
			
			//$url = new moodle_url('/mdlautor/view.php');
			//$PAGE->set_url($url);
						
			$mform = $this->_form; 
			
			$title = ucfirst(get_string('nome', 'local_mdlautor'));
			$mform->addElement('text', 'nome', $title, 'maxlength="100" size="25" ');
			$mform->setDefault('nome', ''.$valueoa->nome.'');
			
			$oai_types = $GLOBALS["oai_types"];
			foreach ($oai_types as $value){ $oai_types_output[$value] = get_string($value, 'local_mdlautor'); 	}
			$title = ucfirst(get_string('oai_type', 'local_mdlautor'));
			$mform->addElement('select', 'oai_type', $title, $oai_types_output, $attributes);
			$mform->getElement('oai_type')->setSelected(''.$valueoa->type.'');
			
			$title = ucfirst(get_string("descricaobreve", "local_mdlautor"));
			$mform->addElement('textarea', 'descricaobreve', $title, 'wrap="virtual" rows="6" cols="70"');
			$mform->setDefault('descricaobreve', ''.$valueoa->descricaobreve.'');
			
			$mform->addElement('hidden', 'acao', 'crianovooai');
			$mform->setType('acao', PARAM_TEXT);	
			
			//Aqui temos que definir as opções do editor, o cotexto do editor deve ser o mesmo do file
			//Antes de abrir o editor filemanager é necessário recuperar a imagem com a função $this->set_data(file_prepare_standard_filemanager())
				$editoroptions = array('maxfiles' => 1, 'maxbytes'=>$CFG->maxbytes, 'trusttext'=>false, 'noclean'=>true);
				$editoroptions['accepted_types'] = Array([0] => '.jpg', [1] => '.gif', [2] => '.png');			
				$editoroptions['context'] = $context;
				$editoroptions['subdirs'] = $fileinfo->filepath;		
			$entry = file_prepare_standard_filemanager($entryid, 'imgcurso', $editoroptions, $context, $fileinfo->component, $fileinfo->filearea, $fileinfo->itemid);
			$this->set_data($entry);
			$mform->addElement('filemanager', 'imgcurso_filemanager', get_string('courseoverviewfiles'), null, $editoroptions);					
			
			$mform->addElement('hidden', 'acao', 'editaoai');
			$mform->setType('acao', PARAM_TEXT);
			
			$mform->addElement('hidden', 'id', $valueoa->id);
			$mform->setType('acao', PARAM_TEXT);			
			
			$this->add_action_buttons(true, $unregisterlabel);
			
		}                           
}	

?>