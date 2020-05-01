<?php
//try an catch and initial URL creation
try{ $url = 'https://beta.sam.gov/api/prod/view-details/v1/api/entity/115035342?sort=name';

}catch (exception $e) {

header('location: https://google.com');

}

//create URL's for the other 2 sites

$url2 = 'https://beta.sam.gov/api/prod/locationservices/v1/api/naics?sourceyear=2017&code=';
$url3 = 'https://beta.sam.gov/api/prod/locationservices/v1/api/psc?q=';

//decode url1 json

$jsondata = json_decode(file_get_contents($url), true);


//create Arrays needed for foreach loops...

$naicsArray = array();
$naicsNums = array();
$pscArray = array();


//Create variable to use with NAICS foreach loop
$i = 0;
$i2 = 0;


//for each loop to pull naics codes,   the api only allows 400ish at a time and create 3 array branches

foreach ($jsondata['entityInfo'][0]['assertions']['naicsList'] as $key => $value) {
		if ($i == 400) { //427 is the max the api allows
		$i2++;
		$i = 0; //reset $i
		}
		$naicsArray[$i2][] = $value;
		$i++;
}

//implode to insert comma's between all the naics codes'

foreach ($naicsArray as $key => $value) {
	$naicsNums[] = implode(', ', $value);
}

//json decode of $url2, and concatonate the naics codes from above (with commas) to it and vardump the contents

foreach ($naicsNums as $key => $value) {
	$pleaseWork = json_decode(file_get_contents($url2.$value));

	//Var Dump the results, all 900+ Niacs Codes
	//var_dump($pleaseWork);
}

//foreach loop to get the PSC codes

foreach ($jsondata['entityInfo'][0]['assertions']['pscList'] as $key => $value) {
	    $pscArray[] = $value;
}

//Implode to put comma's between psc values.

$pscArray = implode(', ', $pscArray);




// decode Json for url3, and concat array w/ commas into the url.
$alsoPleaseWork = json_decode(file_get_contents($url3.$pscArray));

//Var Dump the results.

//var_dump($alsoPleaseWork);


//used this to see the Json formatted pretty

////print('<pre>'.print_r($jsondata,true).'</pre>');





?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="row">
	<div class="col-sm-6">
		
			<h2 class="text-center">NAICS Codes</h2>
				<p>
				<?php
				foreach ($naicsNums as $key => $value) {
					echo $value;
				}
				
				?>
				</p>
			
	</div>

	
	<div class="col-sm-6">
			<h2 class="text-center">PSC Codes</h2>
			<?php
			
					echo $pscArray;	
				
			?>
	</div>
		
	
</div>
	



</body>
</html>