# scripts-pour-pluxml
quelques script pour le CMS PluXml

* **catartList.php**  script affichant liens et résumés des articles de chaque catégorie dans le menu  Destiner à être inserer dans un fichier template du thème . ex: sidebar.php
* **header-canonical.php** script à inclure dans le fichier header.php de votre thème. **OBSOLETE** , ne pas utiliser avec des version supérieur à la 5.8.9 de Pluxml
* **static-comments.php** ajoute les commentaires dans une page statique. C'est devenu un plugin que vous trouverez à : https://ressources.pluxopolis.net/banque-plugins/index.php?plugin=StaticComments
* **static-remote-install.php** script à copier/coller dans une page statique depuis l'**admistration de PluXml** (\\ antislash déjà échapper). Il permet de mettre à jour d'un click: PluXml, un thème ou plugin depuis une liste réduite. <br> le script existe en version standalone, permettant d'installer PluXml sur un site ou dans un répertoire vierge. https://pluxopolis.net/data/documents/remote_install.V.2.zip Pensez à effacer le script aprés usage.
* **is_private.php** Privatise Entierement PluXml.  ex:  Fichier à déposer dans le repertoire ***themes/defaut/*** . Pour activer, ajouter une ligne au  fichier ***header.php*** contenant : `<?php   include __DIR__.'/is_private.php'; ?>`.
* **is_homeStatic_public.php** à utiliser si vous avez une page statique *accrochée* en accueil. Privatise tout PluXml sauf la page statique d'accueil.  . Pour activer, ajouter une ligne au  fichier ***header.php*** contenant : `<?php   include __DIR__.'/is_private.php'; ?>`.
