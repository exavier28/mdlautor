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
		
        $this->add_action_buttons(true, $unregisterlabel);
		
    }                           
}   


function executa_lib_post(){
	global $DB,$USER;
	//$DB->set_debug(true);
	if ($_POST['acao'] == 'crianovooai'){
		$table = 'local_mdlautor_oai';
		$dataobject = array("nome"=>"".$_POST['nome']."", "type"=>"".$_POST['oai_type']."", "descricaobreve"=>"".$_POST['descricaobreve']."", "id_user_criador"=>"".$USER->id."");
		$DB->insert_record($table, $dataobject, $returnid=true, $bulk=false);
	}
	//$DB->set_debug(false);
}

?>