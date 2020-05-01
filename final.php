<?php
//pull JSON from provided links, and decode
try{ $url = 'https://beta.sam.gov/api/prod/view-details/v1/api/entity/962006297?sort=name';

}catch (exception $e) {

header('location: https://google.com');

}

//$sam1 = file_get_contents($url);

$jsondata = json_decode(file_get_content($url), true);

//Create Array to put the naics Values
$array = array();

//Use for each look to pull naics' and place them in array

foreach($jsondata['entityInfo'][0]['assertions']['naicsList'] as $key => $value){
    $array[] = $value;
}

//create an array for psc info
$pscarray = array();

//Get PSC # from json and place into array

foreach($jsondata['entityInfo'][0]['assertions']['pscList'] as $key => $value){
    $pscarray[] = $value;
}

//Use naics numbers placed in array above to pull directly from naics link
$result1 = file_get_contents('https://beta.sam.gov/api/prod/locationservices/v1/api/naics?sourceyear=2017&code='. $array[0]);
$result2 = file_get_contents('https://beta.sam.gov/api/prod/locationservices/v1/api/naics?sourceyear=2017&code='. $array[1]);
// use PSC number in provided link
$result3 = file_get_contents('https://beta.sam.gov/api/prod/locationservices/v1/api/psc?q='. $pscarray[0]);

//Decode output from jsons above
$naics1 = json_decode($result1, true);
$naics2 = json_decode($result2, true);
$psc = json_decode($result3, true);

//display JSON Data
// print('<pre>'.print_r($naics1,true).'</pre>');
// echo '<br>';
// print('<pre>'.print_r($naics2,true).'</pre>');
// echo '<br>';
// print('<pre>'.print_r($psc,true).'</pre>');
//print('<pre>'.print_r($jsondata,true).'</pre>');
//JSON Errors...



// echo '<br>';
// echo '<br>';
// echo json_last_error();
// echo '<br>';
// echo json_last_error_msg();
?>



<!-- Using Data in a webpage -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    .space {
        font-size: 0.850rem;
        line-height:1.2rem;
        margin-top:-15px
    }
</style>
</head>
<body>

<div>
    <div class="container">
        <div><h3>US FEDERAL CONTRACTOR REGISTRATION</h3></div>
        <div class="card-group">
            <div class="card">
                <p>Unique Entity ID(DUNS)</p>
                <p><?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['duns']?></p>
                <hr>
                <p>CAGE Code</p>
                <p><?php echo $jsondata['entityInfo'][0]['coreData']['cageCode']?></p>
                <hr>
                <p>Address</p>
                <p><?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['address1']?> <br>
                <?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressCity']. ', '. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressState']. ' '. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressZip']. '-'. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['country']?></p>
                <p></p>
                
            </div>
            <div class="card">
                <p>Activation Date</p>
                <p><?php echo $jsondata['entityInfo'][0]['coreData']['activeDate']?></p>
                <hr>
                <p>Expiration Date</p>
                <p><?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['expirationDate']?></p>
                <hr>
                <p>Purpose of Registration</p>
                <p><?php echo $jsondata['entityInfo'][0]['coreData']['purposeOfRegistration']?></p>
                <hr>
                <p>Debt Subject to Offset</p>
                <p><?php echo $jsondata['entityInfo'][0]['coreData']['activeDate']?></p>
            </div>
        </div>
        <h3>Core Data</h3>
        <h5>General Information</h5>
        <hr>

        <div class="row">
            <div class="col-sm-6">
                <p>Country of Incorporation</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['countryOfIncorporation']?></p>
            </div>
            <div class="col-sm-6">
                <p>State of Incorporation</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['stateOfIncorpor   ation']?></p>
            </div>
        </div>
       <div class="row">
            <div class="col-sm-12">
                <p>Business type</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['businessType']?></p>
            </div>
       </div>
       <div class="row">
            <div class="col-sm-6">
                <p>Entity Structure</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['entityStructure']?></p>
            </div>
            <div class="col-sm-6">
                <p>Purpose of Registration</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['purposeOfRegistration']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Profit Structure</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['profitStructure']?></p>
            </div>
            <div class="col-sm-6">
                <p>Organization Factors</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['organizationStructure']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Entity Type</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['entityType']?></p>
            </div>
            
        </div>

        <h3>Entity Information</h3>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <p>Entity Start Date</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['businessStartDate']?></p>
            </div>
            <div class="col-sm-6">
                <p>Initial Registration Date</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['registrationDate']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Fiscal Year End Close Date</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['fiscalYearEndCloseDate']?></p>
            </div>
            <div class="col-sm-6">
                <p>Submission Date</p>
                <p></p>
            </div>
        </div>
     
        
        <div class="row">
            <div class="col-sm-6">
                <p>Entity Division Name</p>
                <p></p>
            </div>
            <div class="col-sm-6">
                <p>Activation Date</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['activeDate']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Entity Division Number</p>
                <p></p>
            </div>
            <div class="col-sm-6">
                <p>Expiration Date</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['expirationDate']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Entity URL</p>
                <p class="space"><a href="<?php echo $jsondata['entityInfo'][0]['coreData']['corporateURL']?>"><?php echo $jsondata['entityInfo'][0]['coreData']['corporateURL']?></a></p>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Congressional District</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['congressionalDistrict']?></p>
            </div>    
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p>Physical Address</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['address1']?> <br>
                <?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressCity']. ', '. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressState']. ' '. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressZip']. '-'. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['country']?></p>
                
            </div>
            <div class="col-sm-6">
                <p>Mailing Address</p>
                <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['mailAddress']['address1']?> <br>
                <?php echo $jsondata['entityInfo'][0]['coreData']['mailAddress']['address2']?><br>
                <?php echo $jsondata['entityInfo'][0]['coreData']['mailAddress']['addressCity']. ', '. $jsondata['entityInfo'][0]['coreData']['generalInfo']['mailAddress']['addressState']. ' '. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressZip']. '-'. $jsondata['entityInfo'][0]['coreData']['generalInfo']['samAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['coreData']['mailAddress']['country']?></p>
                
            </div>
        </div>


        <h3>CAGE/NCAGE Code</h3>
        <hr>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <p>Cage</p>
                    <p class="space"> <?php echo $jsondata['entityInfo'][0]['coreData']['cageCode']?></p>
             
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-12">
                    <p>Ownership Details</p>
                    <p class="space">You can find data Legal Business Name and CAGE Code for the Immediate and Highest-Level Owners in Reps & Certs. Refer to FAR 52.204-17 or FAR 52.212-3 p to review ownership details reported by the entity.</p>
                </div>
               
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>Ownership Details</p>
                    <p class="space">You can find data Legal Business Name and CAGE Code for an entity's predecessors in Reps & Certs. Refer to FAR 52.204-20 or FAR 52.212-3(r) to review predecessor details reported by the entity.</p>
                </div>
               
            </div>


        </div>

        <h5>Financial Information</h5>
        <hr>
        <p>Do you accept credit cards as a method of payment</p>
        <p class="space"><?php echo $jsondata['entityInfo'][0]['coreData']['creditCardUsage']?></p>

        <h4>Executive Conpensation Questions</h4>
        <p>This information is not displayed in SAM. Registrants in the System for Award Management (SAM) respond to the Executive Compensation questions in accordance with Section 6202 of P.L. 110-252, amending the Federal Funding Accountability and Transparency Act (P.L. 109-282). This information is sent to USASpending.gov for display in association with an eligible award. Maintaining an active registration in SAM demonstrates the registrant responded to the questions.</p>
        <hr>
        

        <h4>Proceedings Questions</h4>
        <p>Entity responses are not displayed in SAM. Registrants in the System for Award Management (SAM) respond to Proceedings questions in accordance with FAR 52.209-7, FAR 52.209-8, or 2.C.R.F 200 Appendix XII. Responses are sent to FAPIIS.gov for display as applicable. Maintaining an active registration in SAM demonstrates the registrant responded to the proceedings questions.</p>
        <hr>

        <h3>Assertions</h3>
        <h5>Goods & Services</h5>
        <hr>
        <p>NAICS Codes Selected</p>
        <div class="container">
            <table class="table table-striped">
                <caption>NAICS Class Selected</caption>
                       <thead>
                           <th>Primary</th>
                           <th>NAICS Code</th>
                           <th>Description</th>
                       </thead>
                       <tr>
                           <td></td>
                           <td><?php print_r($naics1['_embedded']['nAICSList'][0]['naicsCode']); ?></td>
                           <td><?php print_r($naics1['_embedded']['nAICSList'][0]['naicsTitle']); ?></td>
                       </tr>
                       <tr>
                           <td></td>
                           <td><?php print_r($naics2['_embedded']['nAICSList'][0]['naicsCode']); ?></td>
                           <td><?php print_r($naics2['_embedded']['nAICSList'][0]['naicsTitle']); ?></td>
                       </tr>
               
            </table>

        <table class="table table-striped">
        <caption>Product Service Code Selected</caption>
            <thead>
                <tr>
                    <th>Product Services Code</th>
                    <th>Product Services Selected</th>
                </tr>
            </thead>
            <tr>
                <td><?php print_r($psc['_embedded']['productServiceCodeList'][0]['pscCode']); ?></td>
                <td><?php print_r($psc['_embedded']['productServiceCodeList'][0]['pscName']); ?></td>
             </tr>
            
            
        </table>
        <h5>Disaster Response Information</h5>
        <hr>

        <p>Included in Disaster Response Registry</p>
        <p></p>
        <p>Require bonding to bid on Contracts</p>
        <p></p>
        <p>Geographic Area Served</p>
        <table class='table table-striped'>
            <caption>Geographic Area Served</caption>
            <thead>
                <tr>
                    <th>State</th>
                    <th>County</th>
                    <th>MSA</th>
                </tr>

            </thead>
            <tr>
                <td><?php echo $jsondata['entityInfo'][0]['assertions']['geographicalAreaServed']['state'];?></td>
                <td></td>
                <td></td>
            </tr>

        </table>
        </div>

        <h3>Representation and Certifcations</h3>
        <h5>FAR Report</h5>
        <hr>
        <p>Select Download FAR Report to review the representations and certificates for US FEDERAL CONTRACTOR REGISTRATION INC</p>
        <a href="<?php echo $jsondata['entityInfo'][0]['repsAndCerts']['linkForFARReport'];?>" class="btn btn-dark">Download FAR Report</a>

        <h5>FARS & DFARS Report</h5>
        <hr>
        <p>Select Download FARS & DFARS Report to review the Represntations and Certifications for US FEDERAL CONTRACTOR REGISTRATION INC</p>
        <a href="<?php echo $jsondata['entityInfo'][0]['repsAndCerts']['linkForDFARReport'];?>" class="btn btn-dark">Download FARS & DFARS Report</a>

        <h3>Points of Contact</h3>
        <div class="row">
            <div class="col-sm-6">
                <h5>Mandatory Points of Contact</h5>
            </div>
            <div class="col-sm-6">
                <h5>Optional Points of Contact</h5>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <p class="space"><?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocType'];?></p>
                <p class="space">Name: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocFirstName'];?> <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocLastName'];?></p>
                <p class="space">U.S. Phone: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs']['0']['pocUSPhone']?> ext. <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocUSPhoneExt']?></p>
                <p class="space">Email: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocEmail']?></p>
                <p class="space">Address: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocAddress']['address1']?><br>
                <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs']['0']['pocAddress']['address2']?><br>
                <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs']['0']['pocAddress']['addressCity']?>, <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocAddress']['addressState']?> <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs']['0']['pocAddress']['addressZip']?>-<?php echo $jsondata['entityInfo'][0]['mandatoryPOCs']['0']['pocAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs']['0']['pocAddress']['country']?>
            </p>

            </div>
            <div class="col-sm-6">
                <p class="space"><?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocType'];?></p>
                <p class="space">Name: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocFirstName'];?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocLastName'];?></p>
                <p class="space">U.S. Phone: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocUSPhone']?> ext. <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocUSPhoneExt']?></p>
                <p class="space">Email: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocEmail']?></p>
                <p class="space">Address: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['address1']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocAddress']['address2']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocAddress']['addressCity']?>, <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressState']?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressZip']?>-<?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocAddress']['country']?>
                
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
            <p class="space"><?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocType'];?></p>
                <p class="space">Name: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocFirstName'];?> <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocLastName'];?></p>
                <p class="space">U.S. Phone: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocUSPhone']?> ext. <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocUSPhoneExt']?></p>
                <p class="space">Email: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs']['0']['pocEmail']?></p>
                <p class="space">Address: <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][0]['pocAddress']['address1']?><br>
                <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocAddress']['address2']?><br>
                <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocAddress']['addressCity']?>, <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocAddress']['addressState']?> <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocAddress']['addressZip']?>-<?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['mandatoryPOCs'][1]['pocAddress']['country']?>
                
            </div>
            <div class="col-sm-6">
            <p class="space"><?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocType'];?></p>
                <p class="space">Name: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocFirstName'];?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocLastName'];?></p>
                <p class="space">U.S. Phone: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocUSPhone']?> ext. <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocUSPhoneExt']?></p>
                <p class="space">Email: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocEmail']?></p>
                <p class="space">Address: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['address1']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocAddress']['address2']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocAddress']['addressCity']?>, <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressState']?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressZip']?>-<?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocAddress']['country']?>
                
                
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                
                <!-- empty -->
            </div>
            <div class="col-sm-6">
            <p class="space"><?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocType'];?></p>
                <p class="space">Name: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocFirstName'];?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocLastName'];?></p>
                <p class="space">U.S. Phone: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocUSPhone']?> ext. <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocUSPhoneExt']?></p>
                <p class="space">Email: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocEmail']?></p>
                <p class="space">Address: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['address1']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['address2']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressCity']?>, <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressState']?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressZip']?>-<?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocAddress']['country']?>
                
                
            </div>
        </div>    
        <br>
        <div class="row">
            <div class="col-sm-6">
                
                <!-- empty -->
            </div>

            <div class="col-sm-6">
            <p class="space"><?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocType'];?></p>
                <p class="space">Name: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][0]['pocFirstName'];?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][1]['pocLastName'];?></p>
                <p class="space">U.S. Phone: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocUSPhone']?> ext. <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocUSPhoneExt']?></p>
                <p class="space">Email: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocEmail']?></p>
                <p class="space">Address: <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocAddress']['address1']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocAddress']['address2']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocAddress']['addressCity']?>, <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocAddress']['addressState']?> <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocAddress']['addressZip']?>-<?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocAddress']['addressZipPlus4']?><br>
                <?php echo $jsondata['entityInfo'][0]['optionalPOCs'][2]['pocAddress']['country']?>
                
                
            </div>
        </div>    
    

        
    </div>

</div>
    
</body>
</html>