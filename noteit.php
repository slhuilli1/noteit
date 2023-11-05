<?php
	defined('_JEXEC') or die('Access deny');

	class plgContentNoteIt extends JPlugin 
	{
		function onContentPrepare($content, $article, $params, $limit){	
			/*URILISATION : 
			{note "Libelle de la note"}
			ceci est le luibellé de ma note
			{/note}
			*/
			
			$document = JFactory::getDocument();
			$document->addStyleSheet('plugins/content/noteit/style.css');
			
			$re = '/{note.*"(.*)" (.*)}(.*){\/note}/Us';
			preg_match_all($re, $article->text, $matches, PREG_SET_ORDER, 0);
/*
echo '<pre>';
print_r($matches);
echo '</pre>';*/
			$a='';
			//je vire les shorcodes et les remplace par les portitb - A FINIR EN PARCOURANT LE TABLEAU
			$subst = '<div class="les-post-it">TOY';
			foreach($matches as $ligne){
				if ($ligne[2] == "vert")
				{
					$couleur="notes-article-vert";
				} 
				else 
				{
					$couleur="notes-article";
				};
			$a = '<div class="notes-articles">
			        <div class="'.$couleur.'">
						<div class="titre-sticky">'.$ligne[1].'</div>
						<div class="contenu-sticky">'.$ligne[3].' - '.$ligne[2].'</div>
					  </div>	
					</div>';
					   
			$article->text  =str_replace($ligne[0],$a, $article->text);
					   
			}
			//$article->text = str_replace('TOY',$a,$article->text);
			//echo $a;
			

			
		//	$article->text = preg_replace($re, "MARCEL" , $article->text); //Je vire les shortcode de l'article AVEC  LES LI ! (on va tout refaire)

		}	
	}