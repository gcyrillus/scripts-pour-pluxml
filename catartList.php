<!-- script affichant liens et résumés des articles de chaque catégorie dans le menu -->
<h3>
	<?php $plxShow->lang('CATEGORIES'); ?>
</h3> 
<ul class="cat-list unstyled-list">
<?php 
	#configuration filtres
	$catFilter = array(); 				// lister ici les catégories à afficher par leur identifiant . exemple  array('003', '002', '004');
	$nbArts ='1';        				// indiquez ici le nombre d'article max à afficher
	$length ='100';					// indiquez ici le nombre de lettre à afficher
	$more=$plxShow->getLang('L_ARTCHAPO');		// recupere la traduction du théme
			
	#initialisation script 
	if(count($catFilter)>0) {
		foreach($catFilter as $cat => $v){
			$mycats[]=$cat;
		}		
	}
	else { // ou parcourez toutes les catégories
		$mycats = $plxShow->plxMotor->aCats;
	}
			
	foreach($mycats as $id_cat => $ar) {
		# raz variables 
		$all='';
		$listArts ='';
			
		# à t-on plus d'article dans la catégorie que $nbArts ? is Oui on réaffiche un lien vers la categories
		if($ar['articles'] > $nbArts) $all ='<p><a href="#cat_url" title="Voir tous les articles de la catégorie #cat_name">Voir tous les articles</a></p>';
		
		#as t-on des articles a affiché dans cette catégoire?
		if($ar["articles"] !='0') {
			# on stocke l'affichage et on lance la fonction lastArtList()
			ob_start(); 
			$listArts = $plxShow->lastArtList (PHP_EOL.'		<li>#art_chapo('.$length.')<p class="more"><a href="#art_url">'.$more.'</a></p></li>'.PHP_EOL, intval($nbArts) , intval($id_cat));
			
			# on recupere l'affichage stocké dans une variable	
			$listArts = ob_get_clean();// ce que tu veut inserer
		}
		if($listArts!='') $listArts = '
		<ul class="lastart-list">
		'.$listArts.'
		</ul>';
		# reste à insérer la variable ou l'on veut qu'elle réapparaisse dans l'arborescence des catégories.
		$plxShow->catList('','<li id="menu_#cat_id"><a href="#cat_url">#cat_name</a>'. $listArts. $all.'</li>'.PHP_EOL,intval($id_cat));
	}
?>            
</ul>
