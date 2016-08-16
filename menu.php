<?php


echo "<ul class='nav nav-tabs'>";



if ($_GET['aba2']=='autor' or !isset($_GET['aba2']))
         {echo "<li class='active'><a title='Autoria' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=autor&content='>Autoria</a></li>";} 
	else {echo "<li class=''      ><a title='Autoria' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=autor&content='>Autoria</a></li>";}
	
if ($_GET['aba2']=='equipe')
         {echo "<li class='active'><a title='Equipe' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=equipe&content='>Equipe</a></li>";} 
	else {echo "<li class=''      ><a title='Equipe' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=equipe&content='>Equipe</a></li>";}	
	
if ($_GET['aba2']=='visualizar')
         {echo "<li class='active'><a title='Visualizar' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=visualizar&content='>Visualizar</a></li>";} 
	else {echo "<li class=''      ><a title='Visualizar' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=visualizar&content='>Visualizar</a></li>";}		

if ($_GET['aba2']=='export'){
	      echo "<li class='active'><a title='Exportar' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=export&content='>Exportar</a></li>";} 
	else {echo "<li class=''      ><a title='Exportar' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=export&content='>Exportar</a></li>";}

if ($_GET['aba2']=='config')
         {echo "<li class='active'><a title='Configuração' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=config&content='>Configuração</a></li>";} 
	else {echo "<li class=''      ><a title='Configuração' href='../mdlautor/view.php?aba=".$_GET['aba']."&aba2=config&content='>Configuração</a></li>";}	
	
echo "</ul>";
