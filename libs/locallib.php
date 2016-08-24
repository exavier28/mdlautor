<?php

require_once($CFG->libdir.'/formslib.php');

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
		//$success = $mform->save_file('imgcurso', $fullpath, $override);
		//$storedfile = $mform->save_stored_file('imgcurso', ...);
		
        $this->add_action_buttons(true, $unregisterlabel);
		
    }                           
}   


function executa_lib_post(){
	global $DB,$USER;
	//print_r($_POST);
	//$DB->set_debug(true);
	if ($_POST['acao'] == 'crianovooai'){
		$table = 'local_mdlautor_oai';
		$dataobject = array("nome"=>"".$_POST['nome']."", 
							"type"=>"".$_POST['oai_type']."", 
							"descricaobreve"=>"".$_POST['descricaobreve']."", 
							"id_user_criador"=>"".$USER->id."",
							"imgcurso"=>"".$_POST['imgcurso']."",		
							"ativo"=>1
							);
		$DB->insert_record($table, $dataobject, $returnid=true, $bulk=false);
	}
	//$DB->set_debug(false);
}


function get_file_image_by_id($itemid,$class){
		global $DB,$CFG;

		//Aqui vamos recuperar os registros do file no bano de dados
		//Está sendo gerado 2 linha na tabela para cada arquivo, sendo que a primeira linha apresenta todos os registros completos, usaremos essa.
		$table = "files";
		$file_record = $DB->get_record($table, array('itemid'=>''.$itemid.''));

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
		$file_record = $DB->get_record($table, array('itemid'=>''.$itemid.''));
		
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
			$fileinfo = return_object_file_image_by_id(516723633);
			print_r($fileinfo);
			
			$get_curso_by_id = get_curso_by_id($_GET['idoa']);
			//print_r($get_curso_by_id);
			//echo "<br>";
			//print_r(return_object_file_image_by_id($get_curso_by_id->imgcurso));			
			
			$mform = $this->_form; 
			
			$title = ucfirst(get_string('nome', 'local_mdlautor'));
			$mform->addElement('text', 'nome', $title, 'maxlength="100" size="25" ');
			$mform->setDefault('nome', ''.$get_curso_by_id->nome.'');
			
			$oai_types = $GLOBALS["oai_types"];
			foreach ($oai_types as $value){ $oai_types_output[$value] = get_string($value, 'local_mdlautor'); 	}
			$title = ucfirst(get_string('oai_type', 'local_mdlautor'));
			$mform->addElement('select', 'oai_type', $title, $oai_types_output, $attributes);
			$mform->getElement('oai_type')->setSelected(''.$get_curso_by_id->type.'');
			
			$title = ucfirst(get_string("descricaobreve", "local_mdlautor"));
			$mform->addElement('textarea', 'descricaobreve', $title, 'wrap="virtual" rows="6" cols="70"');
			$mform->setDefault('descricaobreve', ''.$get_curso_by_id->descricaobreve.'');
			
			$mform->addElement('hidden', 'acao', 'crianovooai');
			$mform->setType('acao', PARAM_TEXT);		
			
			//$definitionoptions = Array ( ['maxfiles'] => '1',['maxbytes'] => '0', ['subdirs'] => '0', ['accepted_types'] => Array ( ['0'] => '.jpg', ['1'] => '.gif', ['2'] => '.png' ), ['context'] => 5 ) ;
			//$definitionoptions = array('maxfiles' => '1', 'maxbytes'=>'0', 'trusttext'=>false, 'noclean'=>true, 'accepted_types' => '*');
			//$definitionoptions['context'] = Array (['_id:protected'] => '5', ['_contextlevel:protected'] => '50', ['_instanceid:protected'] => '2', ['_path:protected'] => '/1/3/26',['_depth:protected'] => '3') ;
			//$definitionoptions['subdirs'] = 0;
			
			//print_r($overviewfilesoptions);
			$definitionoptions = array('subdirs'=>false, 'maxfiles'=>1, 'maxbytes'=>$maxbytes, 'accepted_types' => '*');
			//$entry = file_prepare_standard_editor($entry, 'definition', $definitionoptions, 5,'user', 'draft', 1831055);
			//$entry = file_prepare_standard_filemanager($entry, 'imgcurso_filemanager', $definitionoptions, 5,'user', 'draft', 1831055);
            //$mform->addElement('filemanager', 'imgcurso_filemanager', get_string('courseoverviewfiles'), null, $definitionoptions);
			
			$entry = $fileinfo;
			$entry->id = $fileinfo->itemid;
			$entry->definition = '';
			$entry->format = '*';
			//$draftitemid = file_get_submitted_draft_itemid('imgcurso');
			//echo "<br>";  print_r($draftitemid);
			file_prepare_draft_area($draftitemid, 5, 'user', 'draft', $entry->id, $definitionoptions);
			$entry->attachments = $draftitemid;
			file_prepare_standard_filemanager($entry, 'imgcurso', $definitionoptions, 5, 'user', 'draft', $entry->id);
			echo "<br>";  print_r($entry);
			//$mform->addElement('filemanager', 'imgcurso_filemanager', get_string('attachment', 'moodle'), null, $definitionoptions);
			//$mform->set_data($entry);

			
			//$mform->addElement('filepicker', 'imgcurso', get_string('file'), null, array('maxbytes' => $maxbytes, 'accepted_types' => '*'));
					//$return_object_file_image_by_id = return_object_file_image_by_id($get_curso_by_id->imgcurso);
					//$textfieldoptions = array('trusttext'=>true, 'subdirs'=>true, 'maxfiles'=>$maxfiles,'maxbytes'=>$maxbytes, //'context'=>$return_object_file_image_by_id->contextid);
					//$mform->addElement('filemanager', 'imgcurso', get_string('file'),null, $textfieldoptions);
					//$data = file_prepare_standard_editor($data, 'imgcurso', $textfieldoptions, //$return_object_file_image_by_id->contextid,$return_object_file_image_by_id->component, $return_object_file_image_by_id->filearea, //$return_object_file_image_by_id->itemid);
								

			//$success = $mform->save_file('imgcurso', $fullpath, $override);
			//$storedfile = $mform->save_stored_file('imgcurso', ...);
			
			$this->add_action_buttons(true, $unregisterlabel);
			
		}                           
}	

?>