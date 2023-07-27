		# URL canonique
    # script à inclure dans le fichier header.php de votre thème. Une version en plugin existe à https://github.com/gcyrillus/myCannonical
		# Author Gcyrillus @ re7net.com
		# genere l'url canonique de votre page , d'acceuil, categorie, statique ou article  sous la forme <link rel="canonical" href="URL" />
		# conformémént à votre configuration urlrewriting, compatible avec le plugin MyBetterUrl
		# indique le numero de page : page1
		# identifie les plugins generant une page
		$pagination='';
		$reqUri=   $plxShow->plxMotor->get;
		preg_match('/(\/?page[0-9]+)$/', $reqUri, $matches);
		if( $matches) $pagination =$reqUri;
		if($plxShow->catId(true) AND intval($plxShow->catId()) =='0') echo '	<link rel="canonical" href="'.$plxShow->plxMotor->urlRewrite().$pagination.'" />'.PHP_EOL  ;
		if($plxShow->catId(true) AND intval($plxShow->catId()) !='0') echo '	<link rel="canonical" href="'.$plxShow->plxMotor->urlRewrite('?categorie'. intval($plxShow->catId()).'/'.$plxShow->plxMotor->aCats[$plxShow->catId()]['url']).$pagination.'" />'.PHP_EOL  ;
		if($plxShow->plxMotor->mode=='article'  AND $plxShow->plxMotor->plxRecord_arts->f('numero')) echo '	<link rel="canonical" href="'.$plxShow->plxMotor->urlRewrite('?article' . intval($plxShow->plxMotor->plxRecord_arts->f('numero')) . '/' . $plxShow->plxMotor->plxRecord_arts->f('url')).'" />'.PHP_EOL  ;
		if( $plxShow->plxMotor->mode=='static'  ) { 
			echo '	<link rel="canonical" href="'.$plxShow->plxMotor->urlRewrite('?static'. intval($plxShow->staticId()).'/'.$plxShow->plxMotor->aStats[str_pad($plxShow->staticId(),3,0,STR_PAD_LEFT)]['url']).'" />'.PHP_EOL ;
		}
		else{
	# enfin on regarde si il s'agit de la page d'un plugin	
	foreach($plxShow->plxMotor->plxPlugins->aPlugins as $plug){				
		if($plug->getParam('url') == $plxShow->plxMotor->mode)  echo '	<link rel="canonical"  href="'.$plxShow->plxMotor->urlRewrite('?'.$_SERVER['QUERY_STRING']).'"/>'.PHP_EOL;
			}
		}
