<?php
    include 'prepend.php';
    include 'top.php';
?>

<header class="action-bar"><h1>Mise à jours de structure XML des articles.</h1></header>
<p>Il y a <?= count(glob(PLX_ROOT . $plxAdmin->aConf['racine_articles'] .'*.xml')) ?> fichiers XML dans le dossier.</p>
<p>Ce script ajoute aux fichiers les balises suivantes si manquantes:</p>
<ol>
    <li>&lt;title_htmltag&gt;</li>
    <li>&lt;thumbnail&gt;</li>
    <li>&lt;thumbnail_alt&gt;</li>
    <li>&lt;thumbnail_title&gt;</li>
    <li>&lt;date_creation&gt;(reprend la date dans le nom de fichier.)</li>
    <li>&lt;date_update&gt; (reprend la date dans le nom de fichier.)</li>
</ol>
<?php
    $rewrite=false;
    $i=0;
    foreach(glob(PLX_ROOT . $plxAdmin->aConf['racine_articles'] .'*.xml', GLOB_NOSORT) as $file)   
    { 
        if(preg_match('#^(_?\d{4})\.((?:\d{3},|draft,)*(?:home|\d{3})(?:,\d{3})*)\.(\d{3})\.(\d{12})\.(.*)\.xml$#', basename($file), $capture)) {
            $date = $capture[4];
        }
        if(is_readable($file)) {
            $data = file_get_contents($file);
            if( strpos( $data, 'title_htmltag' ) == false) {
                $data = preg_replace("/<\/document>$/", "\t<title_htmltag><![CDATA[]]></title_htmltag>\n</document>", $data);
                $rewrite=true;
            }
            if(strpos( $data, 'thumbnail' ) == false) {
                $data = preg_replace("/<\/document>$/", "\t<thumbnail><![CDATA[]]></thumbnail>\n</document>", $data);
                $rewrite=true;
            }
            if(strpos( $data, 'thumbnail_alt' ) == false) {
                $data = preg_replace("/<\/document>$/", "\t<thumbnail_alt><![CDATA[]]></thumbnail_alt>\n</document>", $data);
            $rewrite=true;
            }
            if(strpos( $data, 'thumbnail_title' ) == false) {
                $data = preg_replace("/<\/document>$/", "\t<thumbnail_title><![CDATA[]]></thumbnail_title>\n</document>", $data);
                $rewrite=true;
            }
            if(strpos( $data, 'date_creation' ) == false) {
                $data = preg_replace("/<\/document>$/", "\t<date_creation><![CDATA[$date]]></date_creation>\n</document>", $data);
                $rewrite=true;
            }
            if(strpos( $data, 'date_update' ) == false) {
                $data = preg_replace("/<\/document>$/", "\t<date_update><![CDATA[$date]]></date_update>\n</document>", $data);
                $rewrite=true;
            }

            if($rewrite==true){
                ++$i;
                $file_handle = fopen($file, 'w'); 
                fwrite($file_handle, $data);
                fclose($file_handle);

            }
        }
    }  
    echo 'Mise à jour des structures XML de <b style="color:tomato">'.$i.'</b> fichier(s) effectuée(s).';

    include  'foot.php';
?>
