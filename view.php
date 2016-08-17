<?php

/////////////////////////////////////////////////////////////////////////////
//                                                                         //
// NOTICE OF COPYRIGHT: CAMPUS VIRTUAL DA FIOCRUS, ACESSO ABERTO           //
//                                                                         //
/////////////////////////////////////////////////////////////////////////////

//  Display the calendar page.

require_once('../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/local/mdlautor/libs/locallib.php');
require_once($CFG->dirroot.'/local/mdlautor/config.php');
//require_once($CFG->libdir.'/formslib.php');

if (count($_POST)>0){executa_lib_post();}

//$courseid = optional_param('course', SITEID, PARAM_INT);
//$view = optional_param('view', 'upcoming', PARAM_ALPHA);

require_course_login($course);

$title = get_string('pluginname', 'local_mdlautor');
$pagetitle = get_string('titulo', 'local_mdlautor');
$tipoplugin = 'Módulo';
$url = new moodle_url('/mdlautor/view.php');

$PAGE->navbar->add(userdate($time, 'Autor'));
$PAGE->navbar->add(userdate($time, 'Edição'));

$PAGE->add_body_class('mdlautor');

$PAGE->set_url($url);
//$PAGE->set_pagelayout('standard');
$PAGE->set_title($title);
$PAGE->set_heading($COURSE->fullname);
//$PAGE->set_button("<a href=''>Editar</a>");

echo $OUTPUT->header();
//echo $OUTPUT->blocks('side-post', 'span3 desktop-first-column');

if ($USER->username != 'guest'){
		echo html_writer::start_tag('div', array('class'=>'fullcontainer'));
			echo $OUTPUT->heading(get_string('titulo', 'local_mdlautor'), $level = 1, $classes = 'main', $id = null);
			
			if (file_exists($CFG->dirroot.'/local/menu.php')) {require_once($CFG->dirroot.'/local/menu.php');} 
			require_once($CFG->dirroot.'/local/mdlautor/menu.php');

			if ($_GET['aba']=='autor' or !isset($_GET['aba'])){require_once($CFG->dirroot.'/local/mdlautor/include/include_autor.php');}

		echo html_writer::end_tag('div');
}else{
	echo "<center>Acesso não permitido para usuários visitantes. <a href = '".$CFG->wwwroot."/login'>Faça o seu login</a></center>";
}

echo $OUTPUT->footer();
