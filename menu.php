<?php


echo "<ul class='nav nav-tabs'>";



if ($_GET['aba']=='autor')
         {echo "<li class='active'><a title='".get_string('inicio', 'local_mdlautor')."' href='../mdlautor/view.php?aba=autor&content='>".get_string('inicio', 'local_mdlautor')."</a></li>";} 
	else {echo "<li class=''      ><a title='".get_string('inicio', 'local_mdlautor')."' href='../mdlautor/view.php?aba=autor&content='>".get_string('inicio', 'local_mdlautor')."</a></li>";}
	
if (isset($_GET['oaid'])){
	
		if ($_GET['aba']=='equipe')
				 {echo "<li class='active'><a title='Equipe' href='../mdlautor/view.php?aba=equipe&content='>Equipe</a></li>";} 
			else {echo "<li class=''      ><a title='Equipe' href='../mdlautor/view.php?aba=equipe&content='>Equipe</a></li>";}	
			
		if ($_GET['aba']=='visualizar')
				 {echo "<li class='active'><a title='Visualizar' href='../mdlautor/view.php?aba=visualizar&content='>Visualizar</a></li>";} 
			else {echo "<li class=''      ><a title='Visualizar' href='../mdlautor/view.php?aba=visualizar&content='>Visualizar</a></li>";}		

		if ($_GET['aba']=='export'){
				  echo "<li class='active'><a title='Exportar' href='../mdlautor/view.php?aba=export&content='>Exportar</a></li>";} 
			else {echo "<li class=''      ><a title='Exportar' href='../mdlautor/view.php?aba=export&content='>Exportar</a></li>";}

		if ($_GET['aba']=='config')
				 {echo "<li class='active'><a title='Configuração' href='../mdlautor/view.php?aba=config&content='>Configuração</a></li>";} 
			else {echo "<li class=''      ><a title='Configuração' href='../mdlautor/view.php?aba=config&content='>Configuração</a></li>";}	
}
			
echo "</ul>";
