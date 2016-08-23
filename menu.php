<?php
echo "<ul class='nav nav-tabs'>";

if ($_GET['aba']=='autor')
         {echo "<li class='active'><a title='".get_string('inicio', 'local_mdlautor')."' href='../mdlautor/view.php?aba=autor&content='>".get_string('inicio', 'local_mdlautor')."</a></li>";} 
	else {echo "<li class=''      ><a title='".get_string('inicio', 'local_mdlautor')."' href='../mdlautor/view.php?aba=autor&content='>".get_string('inicio', 'local_mdlautor')."</a></li>";}
	
if (isset($_GET['idoa'])){
	
		if ($_GET['aba']=='planejamento' or !isset($_GET['aba']))
				 {echo "<li class='active'><a title='Planejamento' href='../mdlautor/view.php?aba=planejamento&content=&idoa=".$_GET['idoa']."'>Planejamento</a></li>";} 
			else {echo "<li class=''      ><a title='Planejamento' href='../mdlautor/view.php?aba=planejamento&content=&idoa=".$_GET['idoa']."'>Planejamento</a></li>";}		
	
			
		if ($_GET['aba']=='equipe')
				 {echo "<li class='active'><a title='Equipe' href='../mdlautor/view.php?aba=equipe&content=&idoa=".$_GET['idoa']."'>Equipe</a></li>";} 
			else {echo "<li class=''      ><a title='Equipe' href='../mdlautor/view.php?aba=equipe&content=&idoa=".$_GET['idoa']."'>Equipe</a></li>";}	

		if ($_GET['aba']=='export'){
				  echo "<li class='active'><a title='Exportar' href='../mdlautor/view.php?aba=export&content=&idoa=".$_GET['idoa']."'>Exportar</a></li>";} 
			else {echo "<li class=''      ><a title='Exportar' href='../mdlautor/view.php?aba=export&content=&idoa=".$_GET['idoa']."'>Exportar</a></li>";}

		if ($_GET['aba']=='config')
				 {echo "<li class='active'><a title='Configuração' href='../mdlautor/view.php?aba=config&content=&idoa=".$_GET['idoa']."'>Configuração</a></li>";} 
			else {echo "<li class=''      ><a title='Configuração' href='../mdlautor/view.php?aba=config&content=&idoa=".$_GET['idoa']."'>Configuração</a></li>";}	
}
			
echo "</ul>";
