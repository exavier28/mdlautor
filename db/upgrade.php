<?php

function xmldb_local_mdlautor_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();
	echo "Se está com problemas com a instalação ou up-gread por favor reportar para exavier28@gmail.com";

    /// Add a new column newcol to the mdl_myqtype_options
    if ($oldversion < 2016040205) {
		
			//$table = new xmldb_table('local_videoplayer');    
			//$sql1 = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{local_videoplayer_list}' AND COLUMN_NAME = 'videoaula'";
			//$verificadb =  $DB->get_records_sql($sql1);
			
			//if (count($verificadb) == 0){
			//	$sql2 = "ALTER TABLE {local_videoplayer_list} ADD `videoaula` VARCHAR(3) NULL DEFAULT 'nao' AFTER `acervo` ";
			//	$DB->execute($sql2, array());
			//}
		}

    return true;
}

?>