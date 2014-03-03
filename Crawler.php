<?php 

/*
This crawler is special made by Michael Ringhus Gertz.

*/
function AP_Crawler($url=false,$grab_from=false,$grab_to=false) {
	if( $url==false OR $grab_from==false OR $grab_to==false) {
		return "FEJL";
		exit();
	}

	// Åben en forbindelse til url
	$handle = fopen($url,'r');
	// Hent indholdet fra url
	$html = stream_get_contents($handle);
	// Luk forbindelsen
	fclose($handle);

	// Fjern alt fra start op og til det ønskede start grab punkt.
	$start=strpos($html,$grab_from);
	$end=strlen($html);
	$html=substr($html,$start,$end);

	// Fjern alt fra grab_to punktet
	$start=0;
	$end=strpos($html,$grab_to);
	$html = substr($html,$start,$end);

	// Fjern alt html nu
	$html = strip_tags($html);

	// lav html space om til bindestreg
	$html = str_replace("&nbsp;","-",$html);

	// Lav mellemrum om til bindestreger
	$html = str_replace(" ","-",$html);

	// Omdag \n for nemmere at kunne splitte indtil et array
	$html = str_replace("\n", "-", $html);


	// Fjern alt på nær, tal, komma, punktum og linieskift
	$html = preg_replace("/[^0-9-,-.,\n]/", "", $html);


	// Omdan til array, knæk ved linie skift
	$html = explode('-',$html);

	// Fjern tomme linier i arrayet
	foreach( $html as $key => $val ) {
		if( $val != "" ) {
			$h[] = $val;
		}
	}

	// returner den laveste værdi fra arrayet
	return min($h);
}
?>