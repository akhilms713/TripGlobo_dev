<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------|
| Author: Provab Technosoft Pvt Ltd.									   |
|--------------------------------------------------------------------------|
| Developer: RAHUL PANDEY									               |
| Started Date: 2019-12-02T15:15:00										   |
| Ended Date: 2019-12-10T15:15:00					   					   |
|--------------------------------------------------------------------------|
*/
function Fare_MasterPricerTravelBoardSearchReq($search_request,$xml_response){
	$security_token_stateless 	= Amedus_get_security_token_stateless();
	
//	echo "<pre/>";print_r($security_token_stateless);exit("Amedus_get_security_token_stateless");
	$mode 						= $search_request->type;
	$origin 					= $search_request->origin;
	$destination				= $search_request->destination;		
	$class						= $search_request->class;	

	$depart_date 				= date("dmy", strtotime($search_request->depart_date));
	if(isset($search_request->return_date) && $search_request->return_date!='')
		$return_date 			= date("dmy", strtotime($search_request->return_date));
	else
		$return_date 			= '';
	$paxReference_ADT=''; $paxReference_CH='';	$paxReference_INF='';$passenger_info = '';
	if(isset($search_request->ADT) && $search_request->ADT > 0){
		for($a = 1;$a <= $search_request->ADT;$a++){
			$paxReference_ADT.="<traveller> <ref>".($a)."</ref> </traveller>";
		}
		$passenger_info .= '<paxReference><ptc>ADT</ptc>'.$paxReference_ADT.'</paxReference>';
	}

	if(isset($search_request->CHD) && $search_request->CHD > 0){
		for($c=1;$c<=$search_request->CHD;$c++){
			$paxReference_CH.="<traveller> <ref>".($a++)."</ref> </traveller> ";
		}	
		$passenger_info .= '<paxReference><ptc>CH</ptc>'.$paxReference_CH.'</paxReference>';
	}

	if(isset($search_request->INF) && $search_request->INF > 0){
		for($i=1;$i<= $search_request->INF;$i++){
			$paxReference_INF.="<traveller> <ref>".$i."</ref><infantIndicator>".$i."</infantIndicator></traveller>";
		}
		$passenger_info .= '<paxReference><ptc>INF</ptc>'.$paxReference_INF.'</paxReference>';
	}

	$economy = $search_request->class;
	if ($economy == 'ALL') {
		$cabin = 'Y'; 
	}
	if ($economy == 'Economy') {
		$cabin = 'Y';
	}
	if ($economy == 'PremiumEconomy') {
		$cabin = 'S';
	}
	if ($economy == 'Business') {
		$cabin = 'C';
	}
	if ($economy == 'PremiumBusiness') {
		$cabin = 'J';
	}
	if ($economy == 'First') {
		$cabin = 'F';
	}
	if ($economy == 'PremiumFirst') {
		$cabin = 'P';
	}
	if (isset($search_request->class) && ($search_request->class == "" || $search_request->class == "All" )){
		$cabin_text_value = '';
	}else {
		$cabin_text_value = '<cabinId><cabinQualifier>RC</cabinQualifier><cabin>' . $cabin . '</cabin></cabinId>';
	}

	$soapAction = "FMPTBQ_18_1_1A";
	$xml_query='
	<?xml version="1.0" encoding="UTF-8"?>           
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
	<soapenv:Header>
	<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
	<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/'.$soapAction.'</add:Action>
	<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
	<link:TransactionFlowLink xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"/>
	<oas:Security xmlns:oas="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
	<oas:UsernameToken oas1:Id="UsernameToken-1" xmlns:oas1="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
	<oas:Username>'.$security_token_stateless['Username'].'</oas:Username>
	<oas:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$security_token_stateless['nonce'].'</oas:Nonce>
	<oas:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">'.$security_token_stateless['hashPwd'].'</oas:Password>
	<oas1:Created>'.$security_token_stateless['created'].'</oas1:Created>
</oas:UsernameToken>
</oas:Security>
<AMA_SecurityHostedUser xmlns="http://xml.amadeus.com/2010/06/Security_v1">
<UserID AgentDutyCode="'.$security_token_stateless['agent_duty_code'].'" RequestorType="'.$security_token_stateless['requester_type'].'" PseudoCityCode="'.$security_token_stateless['PseudoCityCode'].'" POS_Type="'.$security_token_stateless['POS_Type'].'"/>
</AMA_SecurityHostedUser>
</soapenv:Header>
<soapenv:Body>
<Fare_MasterPricerTravelBoardSearch xmlns="http://xml.amadeus.com/'.$soapAction.'">
<numberOfUnit>
	<unitNumberDetail>
		<numberOfUnits>'.($search_request->ADT + $search_request->CHD).'</numberOfUnits>
		<typeOfUnit>PX</typeOfUnit>
	</unitNumberDetail>
	<unitNumberDetail>
		
			<numberOfUnits>100</numberOfUnits>
		<typeOfUnit>RC</typeOfUnit>
	</unitNumberDetail>
</numberOfUnit>'.$passenger_info;
$xml_query.='
<fareOptions>	
	<pricingTickInfo>
		<pricingTicketing>
			<priceType>CUC</priceType>
			<priceType>RP</priceType>
			<priceType>RU</priceType>
			<priceType>TAC</priceType>
			<priceType>ET</priceType>
		</pricingTicketing>
	</pricingTickInfo>
	<feeIdDescription>
	    <feeId>
	        <feeType>FBA</feeType>
	        <feeIdNumber>1</feeIdNumber>
	    </feeId>
	</feeIdDescription>
	<conversionRate>
		<conversionRateDetail>
			<currency>USD</currency>
		</conversionRateDetail>
	</conversionRate>
</fareOptions>';
$xml_query.='
<travelFlightInfo>
	'.$cabin_text_value.'
</travelFlightInfo>';
// echo $search_request->type; exit("136");
if ($search_request->type != "M"){ 
$xml_query 	.=  '<itinerary>
<requestedSegmentRef>
	<segRef>1</segRef>
</requestedSegmentRef>
<departureLocalization>
	<departurePoint>
		<locationId>' . $search_request->origin . '</locationId>
	</departurePoint>
</departureLocalization>
<arrivalLocalization>
	<arrivalPointDetails>
		<locationId>' . $search_request->destination  . '</locationId>
	</arrivalPointDetails>
</arrivalLocalization>


<timeDetails>
	<firstDateTimeDetail>
		<date>'.$depart_date.'</date>
	</firstDateTimeDetail>
</timeDetails>
</itinerary>';
if ($search_request->type == "round") {
	$xml_query .=  '<itinerary>
	<requestedSegmentRef>
		<segRef>2</segRef>
	</requestedSegmentRef>
	<departureLocalization>
		<departurePoint>
			<locationId>' . $search_request->destination . '</locationId>
		</departurePoint>
	</departureLocalization>
	<arrivalLocalization>
		<arrivalPointDetails>
			<locationId>' . $search_request->origin  . '</locationId>
		</arrivalPointDetails>
	</arrivalLocalization>
	<timeDetails>
		<firstDateTimeDetail>
			<date>'.$return_date.'</date>
		</firstDateTimeDetail>
	</timeDetails>
</itinerary>';
}
}else if ($search_request->type == "M") {
	$ss=1;
	// debug($search_request);die;
    $departure_date = explode("-", $search_request->depart_date);

                $mdeparture_multi = $departure_date[2];
                $mdeparture_multi = substr($mdeparture_multi, -2);
		
		$mdeparture_code = $departure_date[0] . $departure_date[1] . $mdeparture_multi;
  
   for ($i = 0; $i < (count($search_request->origin_m)); $i++) {
   	//$ss++;
    
    $mdeparture_date = explode("-", $search_request->depart_date_m[$i]);

                $mdeparture_multi = $mdeparture_date[2];
                $mdeparture_multi = substr($mdeparture_multi, -2);

                $mdeparture_code = date("dmy", strtotime($search_request->depart_date_m[$i]));

  $xml_query.= '<itinerary>
   <requestedSegmentRef>
    <segRef>'.$ss.'</segRef>
   </requestedSegmentRef>
   <departureLocalization>
    <departurePoint>
    <distance>150</distance>
<distanceUnit>K</distanceUnit>
     <locationId>' . $search_request->origin_m[$i] . '</locationId>
    </departurePoint>
   </departureLocalization>
   <arrivalLocalization>
    <arrivalPointDetails>
    <distance>150</distance>
<distanceUnit>K</distanceUnit>
     <locationId>' . $search_request->destination_m[$i] . '</locationId>
    </arrivalPointDetails>
   </arrivalLocalization>
   <timeDetails>
    <firstDateTimeDetail>
     <date>' . $mdeparture_code . '</date>
    </firstDateTimeDetail>
   </timeDetails>
  </itinerary>';
  $ss++;
    }
   }
$xml_query.='</Fare_MasterPricerTravelBoardSearch> 
</soapenv:Body>
</soapenv:Envelope>';	
// echo $xml_query;die;

$result = Amedus_processRequest($xml_query,$soapAction); 
//debug($result);exit();
$final_de = date('Ymd_His')."_".rand(1,10000);
$XmlReqFileName = 'Fare_MasterPricerTravelBoardSearch_Req'.$final_de; $XmlResFileName = 'Fare_MasterPricerTravelBoardSearch_Res'.$final_de;
$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
fwrite($fp, $xml_query);
fclose($fp);
$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
fwrite($fp, $result);
fclose($fp);
$Fare_MasterPricerTravelBoardSearch = array(
	'Fare_MasterPricerTravelBoardSearchReq' => $xml_query,
	'Fare_MasterPricerTravelBoardSearchRes' => $result
	);

//echo "Fare_MasterPricerTravelBoardSearch:<pre/>";print_r($Fare_MasterPricerTravelBoardSearch);exit("246");

$CI =& get_instance();
$CI->load->model('Flight_Model');
$credentials = $CI->Flight_Model->update_response($XmlReqFileName,$XmlResFileName,$xml_response);
return $Fare_MasterPricerTravelBoardSearch;
}
function Air_SellFromRecommendation($flight_request,$PricingDetails,$passenger, $specific_rec_details='') {

	/*echo "<pre>";
	print_r ($specific_rec_details);
	echo "</pre>";exit();*/
	$flight_request = json_decode($flight_request,1);
	$PricingDetails = json_decode($PricingDetails,1);
/*	echo "<pre>";
	print_r ($PricingDetails);
	echo "</pre>";exit();*/
	//$specific_rec_details='LA';
	$specific_rec_details='';
	if ($specific_rec_details != ''){
		$specific_rec_details = $specific_rec_details;
	}

    $security_token_stateless = array();
	$security_token_stateless = Amedus_get_security_token_stateless(); 
	$itineraryDetails = '';
	$segments = count(array_filter($flight_request));
	$adult=$ADT = $PricingDetails[0]['PriceInfo']['PassengerFare']['ADT']['count'];
	if(isset($PricingDetails[0]['PriceInfo']['PassengerFare']['CH']['count'])){
		$child=$CHD=$PricingDetails[0]['PriceInfo']['PassengerFare']['CH']['count'];
	}else{
		$child=$CHD = 0;
	}
	$quantity= $ADT +  $CHD;
	for($i=0;$i<$segments;$i++){
		$segmentInformation =''; 
		$inner_segment=count($flight_request[$i]['locationIdDeparture']);
		for($j=0;$j<$inner_segment;$j++){
			if($i==0){
				echo $i;
			if (!empty($specific_rec_details) && $specific_rec_details!="null"){	
				$flightTypeDetails = '<flightTypeDetails><flightIndicator>'.$specific_rec_details.'</flightIndicator></flightTypeDetails>';
			}else{$flightTypeDetails='';}
				}if($i==1){
					$flightTypeDetails='';

				}
			$segmentInformation .= '<segmentInformation>
			<travelProductInformation>
				<flightDate>
					<departureDate>' . $flight_request[$i]['dateOfDeparture'][$j] . '</departureDate>
				</flightDate>
				<boardPointDetails>
					<trueLocationId>' . $flight_request[$i]['locationIdDeparture'][$j] . '</trueLocationId>
				</boardPointDetails>
				<offpointDetails>
					<trueLocationId>' . $flight_request[$i]['locationIdArival'][$j] . '</trueLocationId>
				</offpointDetails>
				<companyDetails>
					<marketingCompany>' . $flight_request[$i]['marketingCarrier'][$j] . '</marketingCompany>
				</companyDetails>
				<flightIdentification>
					<flightNumber>' . $flight_request[$i]['flightOrtrainNumber'][$j] . '</flightNumber>
					<bookingClass>' . $PricingDetails[0]['PriceInfo']['fareDetails'][$i]['rbd'][$j] . '</bookingClass>
				</flightIdentification>
				'.$flightTypeDetails.'				
			</travelProductInformation>
			<relatedproductInformation>
				<quantity>'.$quantity.'</quantity>
				<statusCode>NN</statusCode>
			</relatedproductInformation>
		</segmentInformation>';
	}
	$itineraryDetails .= '<itineraryDetails>
	<originDestinationDetails>
		<origin>' . $flight_request[$i]['locationIdDeparture'][0] . '</origin>
		<destination>' . $flight_request[$i]['locationIdArival'][($inner_segment - 1)]. '</destination>
	</originDestinationDetails>
	<message>
		<messageFunctionDetails>
			<messageFunction>183</messageFunction>
		</messageFunctionDetails>
	</message>
	' . $segmentInformation . '
</itineraryDetails>';
}

$SellRequest = '<?xml version="1.0" encoding="UTF-8"?>           
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
<soapenv:Header>
<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/ITAREQ_05_2_IA</add:Action>
<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
<link:TransactionFlowLink xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"/>
<oas:Security xmlns:oas="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
<oas:UsernameToken oas1:Id="UsernameToken-1" xmlns:oas1="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
<oas:Username>'.$security_token_stateless['Username'].'</oas:Username>
<oas:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$security_token_stateless['nonce'].'</oas:Nonce>
<oas:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">'.$security_token_stateless['hashPwd'].'</oas:Password>
<oas1:Created>'.$security_token_stateless['created'].'</oas1:Created>
</oas:UsernameToken>
</oas:Security>
<AMA_SecurityHostedUser xmlns="http://xml.amadeus.com/2010/06/Security_v1">
<UserID AgentDutyCode="SU" RequestorType="U" PseudoCityCode="'.$security_token_stateless['PseudoCityCode'].'" POS_Type="1"/>
</AMA_SecurityHostedUser>
<awsse:Session TransactionStatusCode="Start" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3"/>
</soapenv:Header>
<soapenv:Body>
<itar:Air_SellFromRecommendation xmlns:itar="http://xml.amadeus.com/ITAREQ_05_2_IA">
<itar:messageActionDetails>
<itar:messageFunctionDetails>
<itar:messageFunction>183</itar:messageFunction>
<itar:additionalMessageFunction>M1</itar:additionalMessageFunction>
</itar:messageFunctionDetails>
</itar:messageActionDetails>
'.$itineraryDetails.'
</Air_SellFromRecommendation>
</soapenv:Body>
</soapenv:Envelope>';
$soapAction = "ITAREQ_05_2_IA"; 

$sresult =  Amedus_processRequest($SellRequest,$soapAction); 
$final_de = date('Ymd_His')."_".rand(1,10000);
$XmlReqFileName = 'Air_SellFromRecommendation_Req'.$final_de; $XmlResFileName = 'Air_SellFromRecommendation_Res'.$final_de;
$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
fwrite($fp, $SellRequest);
fclose($fp);
$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
fwrite($fp, $sresult);
fclose($fp);
$Air_SellFromRecommendations = array(
	'Air_SellFromRecommendationReq' => $SellRequest,
	'Air_SellFromRecommendationRes' => $sresult
	);
return $Air_SellFromRecommendations;	   
}


function PNR_AddMultiElements($request_scenario, $flight, $request, $SecuritySession, $seq, $SecurityToken, $passenger, $billingaddress,$counter,$parent_pnr=""){
	$security_token_stateless = Amedus_get_security_token_stateless();
	$flight_request = json_decode($flight, 1);
	$PricingDetails = json_decode($request, 1);
	$request_scenario = json_decode($request_scenario, true);
	$a = 0;
	$ad = 0;
	$pass_date = '';
	$temp_ind = '';
	$SSR_DOC = '';
	$FrequentFlyerDOC = '';
	$adult = $ADT = $PricingDetails[0]['PriceInfo']['PassengerFare']['ADT']['count'];
	if (isset($PricingDetails[0]['PriceInfo']['PassengerFare']['CNN']['count'])) {
		$child = $CHD = $PricingDetails[0]['PriceInfo']['PassengerFare']['CNN']['count'];
	}elseif (isset($PricingDetails[0]['PriceInfo']['PassengerFare']['CNN']['count'])) {
		$child = $CHD = $PricingDetails[0]['PriceInfo']['PassengerFare']['CNN']['count'];
	}
	else {
		$child = $CHD = 0;
	}	
	#debug($passenger);die;
		if (isset($passenger['ADULT']) && !empty($passenger['ADULT'])) {
			$passenger['ADULT'] = json_decode(json_encode($passenger['ADULT']));
		}

		if (isset($passenger['CHILD']) && !empty($passenger['CHILD'])) {
			$passenger['CHILD']= json_decode(json_encode($passenger['CHILD']));
		}

		if (isset($passenger['INFANT']) && !empty($passenger['INFANT'])) {
			$passenger['INFANT'] = json_decode(json_encode($passenger['INFANT']));
		}

	if (isset($passenger['INFANT'][0])) {
		$infant = $INF = count($passenger['INFANT']);
	}
	$travellerInf_ADT = "";
	$travellerInf_CH = "";
	$travellerInf_INF = "";
	$testing_sample = '';
	$travellerInformation_ADT = '';
	$ad = '';
	$i = 1;
	$cc =0;

	$addcount='';
	if (!isset($passenger['INFANT'][0])) {			
		for ($ad = 0; $ad < $ADT; $ad++) {
			if($counter==0){
				$cc= $ad+1;


		$travellerInformation_ADT.= '
			<travellerInfo>
				<elementManagementPassenger>
					<reference>';
						$travellerInformation_ADT.= '<qualifier>PR</qualifier>
						<number>' . ($cc) . '</number>';

				    $travellerInformation_ADT.= '</reference>
					<segmentName>NM</segmentName>
				</elementManagementPassenger>';	

			$travellerInformation_ADT.= '<passengerData>
			<travellerInformation>
				<traveller>
					<surname>' . ($passenger['ADULT'][$ad]->last_name) . '</surname>
					<quantity>1</quantity>
				</traveller>
				<passenger>
					<firstName>' . ($passenger['ADULT'][$ad]->first_name) . '</firstName>
					<type>ADT</type>
				</passenger>
			</travellerInformation>
			</passengerData>
		</travellerInfo>
		';

			}

			if ($request_scenario['is_domestic'] != 1 ) {
					if ($counter == 1) {

						if($ad<1){
							$addcount = 2;
						}
             	$ssr_adt = $passenger['ADULT'][$ad];
				if ($ssr_adt->gender == "MALE") {
					$title = "Mr";
					$gender = "M";
				}
				else {
					$title = "Ms";
					$gender = "F";
				}
				$fullname_adult = $ssr_adt->last_name . "/" . $ssr_adt->first_name;
				$country_code = $ssr_adt->issue_country;
				$passport_no = $ssr_adt->passport_no;
				$dob = $ssr_adt->dob;
				$dob = date('dMy', (strtotime("+0 day", (strtotime($dob)))));
				$pass_expiry = date('dMy', (strtotime("+0 day", (strtotime($ssr_adt->pass_expiry)))));

				$freetext = "P/" . strtoupper($country_code) ."/". strtoupper($passport_no) ."/". strtoupper($country_code) ."/".strtoupper($dob) . "/" . strtoupper($gender) . "/" . strtoupper($pass_expiry) . "/" . strtoupper($fullname_adult);
				$SSR_DOC.= '<dataElementsIndiv>
						<elementManagementData>
							<segmentName>SSR</segmentName>
						</elementManagementData>
						<serviceRequest>
							<ssr>
								<type>DOCS</type>
								<status>HK</status>
								<quantity>1</quantity>
								<companyId>YY</companyId>
								<freetext>' . $freetext . '</freetext>
							</ssr>
						</serviceRequest>
						<referenceForDataElement>
							<reference>
								<qualifier>PT</qualifier>
								<number>' .$addcount. '</number>
							</reference>
						</referenceForDataElement>
					</dataElementsIndiv>';
					$addcount= $addcount +1;
				}
			}
		}
	}else{
		if ($adult > $infant && $infant >= 1 || $adult == $infant) {
			for ($ad = 0; $ad < $adult; $ad++) {
				$result_dob_inf = str_replace("-", "", $passenger['INFANT'][$ad]->dob);
     			if($counter==0){

     				$cc= $ad+1;
     				$travellerInformation_ADT .= '
						<travellerInfo>
							<elementManagementPassenger>
							<reference>';
					
						$travellerInformation_ADT .= '<qualifier>PR</qualifier>
							<number>' .($cc). '</number>';
						$travellerInformation_ADT .= '</reference>
					<segmentName>NM</segmentName>
				</elementManagementPassenger>';

				$travellerInformation_ADT .= '<passengerData>
			     <travellerInformation>
				<traveller>
					<surname>' . ($passenger['ADULT'][$ad]->last_name) . '</surname>';
				if (isset($passenger['INFANT'][$ad]) && !empty($passenger['INFANT'][$ad])) {
					$travellerInformation_ADT .= '<quantity>2</quantity>';
				}
				else {
					$travellerInformation_ADT .= '<quantity>1</quantity>';
				}

				$travellerInformation_ADT .= '</traveller>
				<passenger>
					<firstName>' . ($passenger['ADULT'][$ad]->first_name) . '</firstName>
					<type>ADT</type>';
				if (isset($passenger['INFANT'][$ad]) && !empty($passenger['INFANT'][$ad])) {
					$travellerInformation_ADT .= '<infantIndicator>3</infantIndicator>';
				}
				$travellerInformation_ADT .= '</passenger>
				</travellerInformation>
			</passengerData>
		';
				if (isset($passenger['INFANT'][$ad]) && !empty($passenger['INFANT'][$ad])) {
					
				$travellerInformation_ADT .= '<passengerData>
				<travellerInformation>
					<traveller>
						<surname>' . ($passenger['INFANT'][$ad]->last_name) . '</surname>
					</traveller>
					<passenger>
						<firstName>' . ($passenger['INFANT'][$ad]->first_name) . '</firstName>
						<type>INF</type>
					</passenger>
				</travellerInformation>
				<dateOfBirth>
					<dateAndTimeDetails>
						<date>' . date('dMy', strtotime($result_dob_inf)) . '</date>
					</dateAndTimeDetails>
				</dateOfBirth>
			</passengerData>
			</travellerInfo>';
			 }
			 if($ad>($infant-1)){
			 	$travellerInformation_ADT .='</travellerInfo>';
			 }


			}
        	if ($request_scenario['is_domestic'] != 1) {
					if ($counter == 1) {
						
						if($ad < $infant){
				if (isset($passenger['INFANT'][$ad]) && !empty($passenger['INFANT'][$ad])) {
						$ssr_adt = $passenger['ADULT'][$ad];
						if ($ssr_adt->gender == "MALE") {
							$title = "Mr";
							$gender = "M";
						}
						else {
							$title = "Ms";
							$gender = "F";
						}

						if($ad<1){
							$addcount= 2;
						}
						$fullname_adult = $ssr_adt->last_name . "/" . $ssr_adt->first_name;
						$country_code = $ssr_adt->issue_country;
						$passport_no = $ssr_adt->passport_no;
						$dob = $ssr_adt->dob;
						$dob = date('dMy', (strtotime("+0 day", (strtotime($dob)))));
						$pass_expiry = date('dMy', (strtotime("+0 day", (strtotime($ssr_adt->pass_expiry)))));
							
						$freetext = "P/" . strtoupper($country_code) ."/". strtoupper($passport_no) ."/". strtoupper($country_code) ."/".strtoupper($dob) . "/" . strtoupper($gender) . "/" . strtoupper($pass_expiry) . "/" . strtoupper($fullname_adult);
						$qualifier1='PT';
						$SSR_DOC.= '<dataElementsIndiv>
							<elementManagementData>
								<segmentName>SSR</segmentName>
							</elementManagementData>
							<serviceRequest>
								<ssr>
									<type>DOCS</type>
									<status>HK</status>
									<quantity>1</quantity>
									<companyId>YY</companyId>
									<freetext>' . $freetext . '</freetext>
								</ssr>
							</serviceRequest>
							<referenceForDataElement>
								<reference>
									<qualifier>'.$qualifier1.'</qualifier>
									<number>'.$addcount.'</number>
								</reference>
							  </referenceForDataElement>
						</dataElementsIndiv>';
     				$ssr_inf = $passenger['INFANT'][$ad];
						if ($ssr_inf->gender == "MALE") {
							$title = "Mr";
							$gender = "MI";
						}
						else {
							$title = "Ms";
							$gender = "FI";
						}

						$fullname_infant = $ssr_inf->last_name . "/" . $ssr_inf->first_name;
						$country_code = $ssr_inf->issue_country;
						$passport_no = $ssr_inf->passport_no;
						$dob = $ssr_inf->dob;
						$dob = date('dMy', (strtotime("+0 day", (strtotime($dob)))));
						$pass_expiry = date('dMy', (strtotime("+0 day", (strtotime($ssr_inf->pass_expiry)))));

						$freetext = "P/" .strtoupper($country_code) ."/". strtoupper($passport_no) . "/" .strtoupper($country_code) ."/". strtoupper($dob) . "/" . strtoupper($gender) . "/" . strtoupper($pass_expiry) . "/" . strtoupper($fullname_infant);
						$qualifier='PT';
						//$AD_IN1=3;
						$SSR_DOC.= '<dataElementsIndiv>
							<elementManagementData>
								<segmentName>SSR</segmentName>
							</elementManagementData>
							<serviceRequest>
								<ssr>
									<type>DOCS</type>
									<status>HK</status>
									<quantity>1</quantity>
									<companyId>YY</companyId>
									<freetext>' . $freetext . '</freetext>
								</ssr>
							</serviceRequest>
							<referenceForDataElement>
								<reference>
									<qualifier>'.$qualifier.'</qualifier>
									<number>'.$addcount.'</number>
								</reference>
							  </referenceForDataElement>
						</dataElementsIndiv>';
						$addcount= $addcount+1;
				   		}
					}
					else if($ad>=$infant){
					$addcount= $addcount+1;
						if (isset($passenger['ADULT'][$ad]) && count($passenger['ADULT']) > 1) {
						$ssr_adt = end($passenger['ADULT']);
						if ($ssr_adt->gender == "MALE") {
							$title = "Mr";
							$gender = "M";
						}
						else {
							$title = "Ms";
							$gender = "F";
						}
						$fullname_adult = $ssr_adt->last_name . "/" . $ssr_adt->first_name;
						$country_code = $ssr_adt->issue_country;
						$passport_no = $ssr_adt->passport_no;
						$dob = $ssr_adt->dob;
						$dob = date('dMy', (strtotime("+0 day", (strtotime($dob)))));
						$pass_expiry = date('dMy', (strtotime("+0 day", (strtotime($ssr_adt->pass_expiry)))));
						$freetext = "P/" . strtoupper($country_code) ."/". strtoupper($passport_no) . "/" . strtoupper($country_code) ."/". strtoupper($dob) . "/" . strtoupper($gender) . "/" . strtoupper($pass_expiry) . "/" . strtoupper($fullname_adult);
						$qualifier11='PT';
						//$AD_IN111=4;						
						$SSR_DOC .= '<dataElementsIndiv>
							<elementManagementData>
								<segmentName>SSR</segmentName>
							</elementManagementData>
							<serviceRequest>
								<ssr>
									<type>DOCS</type>
									<status>HK</status>
									<quantity>1</quantity>
									<companyId>YY</companyId>
									<freetext>' . $freetext . '</freetext>
								</ssr>
							</serviceRequest>
							<referenceForDataElement>
								<reference>
									<qualifier>'.$qualifier11.'</qualifier>
									<number>'.$addcount.'</number>
								</reference>
							  </referenceForDataElement>
						</dataElementsIndiv>';

						$addcount= $addcount+1;
						}
					}
				}//counter1
			}			
		  }
		 }
        
	}


		$ad = $adult;
		$travellerInformation_CHD = '';
		$result_dob = '';
		//$jjj=1;
		if (!empty($child)) {
			for ($ch = 0; $ch < $child; $ch++) {
				$ssr_chd = $passenger['CHILD'][$ch];
					if($counter==0){	
					$cc=$cc+1;			
				$result_dob1 = str_split(str_replace("-", "", $passenger['CHILD'][$ch]->dob) , 2);
				$result_dob = $result_dob1['3'] . '-' . $result_dob1['2'] . '-' . $result_dob1['0'] . '' . $result_dob1['1'];
			
				$travellerInformation_CHD.= '
			<travellerInfo>
				<elementManagementPassenger>
					<reference>';
						$travellerInformation_CHD.= '<qualifier>PR</qualifier>
						<number>' . ($cc) . '</number>';

				    $travellerInformation_CHD.= '</reference>
					<segmentName>NM</segmentName>
				</elementManagementPassenger>';	

				$travellerInformation_CHD.= '<passengerData>
			<travellerInformation>
				<traveller>
					<surname>' . ($passenger['CHILD'][$ch]->last_name) . '</surname>
				</traveller>
				<passenger>
					<firstName>' . ($passenger['CHILD'][$ch]->first_name) . '</firstName>
					<type>CNN</type>
				</passenger>
			</travellerInformation>
			<dateOfBirth>
				<dateAndTimeDetails>
					<date>' . date('dMy', strtotime($result_dob)) . '</date>
				</dateAndTimeDetails>
			</dateOfBirth>
		   </passengerData>
		   </travellerInfo>
		   ';
			}
    		if ($request_scenario['is_domestic'] != 1 ) {
					if ($counter == 1) {
					if ($ssr_chd->gender == "MALE") {
						$title = "Mr";
						$gender = "M";
					}
					else {
						$title = "Ms";
						$gender = "F";
					}
					$fullname_child = strtoupper($ssr_chd->last_name) . "/" . strtoupper($ssr_chd->first_name);
					$country_code = $ssr_chd->issue_country;
					$passport_no = $ssr_chd->passport_no;
					$dob = $ssr_chd->dob;
					$dob = date('dMy', (strtotime("+0 day", (strtotime($dob)))));
					$pass_expiry = date('dMy', (strtotime("+0 day", (strtotime($ssr_chd->pass_expiry)))));
					$freetext="P/".strtoupper($country_code)."/".strtoupper($passport_no)."/".strtoupper($country_code)."/".strtoupper($dob)."/".strtoupper($gender)."/".strtoupper($pass_expiry)."/".strtoupper($fullname_child);
					//$freetext = "P" . strtoupper($passport_no) . "--" . strtoupper($dob) . "-" . strtoupper($gender) . "-" . strtoupper($pass_expiry) . "-" . strtoupper($fullname_child)."-H";
					$SSR_DOC.= '<dataElementsIndiv>
						<elementManagementData>
							<segmentName>SSR</segmentName>
						</elementManagementData>
						<serviceRequest>
							<ssr>
								<type>DOCS</type>
								<status>HK</status>
								<quantity>1</quantity>
								<companyId>YY</companyId>
								<freetext>' . $freetext . '</freetext>
							</ssr>
						</serviceRequest>
						<referenceForDataElement>
							<reference>
							<qualifier>PT</qualifier>
							<number>' . $addcount . '</number>
							</reference>
						  </referenceForDataElement>
					</dataElementsIndiv>';
					$addcount= $addcount+1;
					}
				}
			}
		}
		$SequenceNumber = $seq + 1;
		$passengerData = $travellerInformation_ADT . $travellerInformation_CHD;
		$PNR_AddMultiElements = '';
		$PNR_AddMultiElements.= '<?xml version="1.0" encoding="utf-8"?>
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
				<soapenv:Header>
					<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
						<awsse:SessionId>' . $SecuritySession . '</awsse:SessionId>
						<awsse:SequenceNumber>' . $SequenceNumber . '</awsse:SequenceNumber>
						<awsse:SecurityToken>' . $SecurityToken . '</awsse:SecurityToken>
					</awsse:Session>
					<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">' . getuuid() . '</add:MessageID>
					<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/PNRADD_17_1_1A</add:Action>
					<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/' . $security_token_stateless['WSAP'] . '</add:To>
				</soapenv:Header>
				<soapenv:Body>
					<PNR_AddMultiElements xmlns="http://xml.amadeus.com/PNRADD_17_1_1A" >
					';
		if ($counter == 1) {
		$PNR_AddMultiElements.= '<pnrActions>
									<optionCode>10</optionCode>
									
								</pnrActions>
								<dataElementsMaster>
									<marker1/>
									'.$SSR_DOC.'
								</dataElementsMaster>																
								';
		}
		else {
		$PNR_AddMultiElements.= '
					<pnrActions>
						<optionCode>0</optionCode>
					</pnrActions>
					
							' . $passengerData . '
					';
		$PNR_AddMultiElements.= '<dataElementsMaster>
					<marker1/>
					<dataElementsIndiv>
						<elementManagementData>
							<reference>
					            <qualifier>OT</qualifier>
					            <number>2</number>
				            </reference>
		       				<segmentName>RF</segmentName>
		           		</elementManagementData>
			            <freetextData>
				            <freetextDetail>
					            <subjectQualifier>3</subjectQualifier>
					            <type>P23</type>
				            </freetextDetail>
				            <longFreetext>Example</longFreetext>
			            </freetextData>
		          	</dataElementsIndiv>
		            <dataElementsIndiv>
		          		 <elementManagementData>
				            <segmentName>TK</segmentName>
				         </elementManagementData>
				         <ticketElement>
				            <ticket>
				               <indicator>TL</indicator>
				               <date>'.$ticket_date1.'</date>
				            </ticket>
				         </ticketElement>
					</dataElementsIndiv>
					<dataElementsIndiv>
						<elementManagementData>
							<segmentName>AP</segmentName>
						</elementManagementData>
						<freetextData>
							<freetextDetail>
								<subjectQualifier>3</subjectQualifier>
								<type>P02</type>
							</freetextDetail>
							<longFreetext>' . $billingaddress->billing_email . '</longFreetext>
						</freetextData>
					</dataElementsIndiv>
					<dataElementsIndiv>
						<elementManagementData>
							<reference>
								<qualifier>OT</qualifier>
								<number>2</number>
							</reference>
							<segmentName>AP</segmentName>
						</elementManagementData>
						<freetextData>
							<freetextDetail>
								<subjectQualifier>3</subjectQualifier>
								<type>7</type>
							</freetextDetail>
							<longFreetext>+91' . $billingaddress->billing_contact_number . '</longFreetext>
						</freetextData>
					</dataElementsIndiv>					
				
				</dataElementsMaster>';
	}
	$PNR_AddMultiElements.= '</PNR_AddMultiElements>
			</soapenv:Body>
		</soapenv:Envelope>';
	$soapAction = "PNRADD_17_1_1A";
	
	$sresult = Amedus_processRequest($PNR_AddMultiElements, $soapAction);
	$final_de = date('Ymd_His') . "_" . rand(1, 10000);
	$XmlReqFileName = 'PNR_AddMultiElements_Req' . $final_de;
	$XmlResFileName = 'PNR_AddMultiElements_Res' . $final_de;
	$fp = fopen("logs/Flight/" . $XmlReqFileName . '.xml', 'a+');
	fwrite($fp, $PNR_AddMultiElements);
	fclose($fp);
	$fp = fopen("logs/Flight/" . $XmlResFileName . '.xml', 'a+');
	fwrite($fp, $sresult);
	fclose($fp);
	$PNR_AddMultiElements = array(
		'PNR_AddMultiElementsReq' => $PNR_AddMultiElements,
		'PNR_AddMultiElementsRes' => $sresult
	);
	return $PNR_AddMultiElements;
}




function fop($card_type, $card_holder_name, $card_number, $exp_month, $exp_year, $cvv_num, $request_scenario, $flight, $request,$SecuritySession,$seq,$SecurityToken,$fareBasis = ''){
$security_token_stateless = Amedus_get_security_token_stateless();
	$request_scenario = json_decode($request_scenario, true);
	$flight_data = json_decode($flight, true)[0]['marketingCarrier'][0];
// echo 'flight_data'; print_r($flight_data); exit();
	$SequenceNumber=$seq +1;
	$xml_PNRAdd = '<?xml version="1.0" encoding="utf-8"?>
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
	<soapenv:Header>
	<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
	<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
	<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
	<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
</awsse:Session>
<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/TFOPCQ_19_2_1A</add:Action>
<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
</soapenv:Header>
<soapenv:Body><FOP_CreateFormOfPayment xmlns="http://xml.amadeus.com/TFOPCQ_19_2_1A">
   <fopGroup>
       <fopReference/>
             <mopDescription>
                 <fopSequenceNumber>
                       <sequenceDetails>
                             <number>1</number>
                       </sequenceDetails>
                 </fopSequenceNumber>
                 <paymentModule>
                      <groupUsage>
                         <attributeDetails>
                              <attributeType>DEFP</attributeType>  
                         </attributeDetails>
                      </groupUsage>
                 <paymentData>
                      <merchantInformation>
                              <companyCode>'.$flight_data.'</companyCode> 
                      </merchantInformation>
                 </paymentData>
                 <mopInformation>
                         <fopInformation>
                             <formOfPayment>
                                  <type>CC</type>
                             </formOfPayment>
                         </fopInformation>
                    <dummy/>
                          <creditCardData>
                                <creditCardDetails>
                                        <ccInfo>
                                          <vendorCode>'.$card_type.'</vendorCode>
                                              <cardNumber>'.$card_number.'</cardNumber>
                                              <securityId>'.$cvv_num.'</securityId>
                                              <expiryDate>'.$exp_month.$exp_year.'</expiryDate>
                                              <ccHolderName>'.$card_holder_name.'</ccHolderName>
                                        </ccInfo>
                                </creditCardDetails>
                          </creditCardData>
                  </mopInformation>
                  <dummy/>
                    </paymentModule>
                </mopDescription>
            </fopGroup>
    </FOP_CreateFormOfPayment>
</soapenv:Body>
</soapenv:Envelope>';

$soapAction = "TFOPCQ_19_2_1A";

$sresult =  Amedus_processRequest($xml_PNRAdd,$soapAction);

$final_de = date('Ymd_His')."_".rand(1,10000);
$XmlReqFileName = 'formofpaymet_Req'.$final_de; $XmlResFileName = 'formofpaymet_Res'.$final_de;
$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
fwrite($fp, $xml_PNRAdd);
fclose($fp);
$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
fwrite($fp, $sresult);
fclose($fp);

$Fare_PricePNRWithBookingClass = array(
	'formofpaymentReq' => $xml_PNRAdd,
	'formofpaymentRes' => $sresult
	);
// echo "Fare_PricePNRWithBookingClass:<pre>"; print_r($Fare_PricePNRWithBookingClass); echo "</pre>";
	return $Fare_PricePNRWithBookingClass;

}



function PNR_AddMultiElements_BookingClass($request_scenario, $flight, $request,$SecuritySession,$seq,$SecurityToken,$fareBasis = ''){
	$security_token_stateless = Amedus_get_security_token_stateless();
	$request_scenario = json_decode($request_scenario, true);
	$flight_data = json_decode($flight, true)[0]['marketingCarrier'][0];
// echo 'flight_data'; print_r($flight_data); exit();
	$SequenceNumber=$seq +1;
	$xml_PNRAdd = '<?xml version="1.0" encoding="utf-8"?>
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
	<soapenv:Header>
	<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
	<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
	<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
	<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
</awsse:Session>
<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/TPCBRQ_18_1_1A</add:Action>
<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
</soapenv:Header>
<soapenv:Body>
<tpc:Fare_PricePNRWithBookingClass xmlns:tpc="http://xml.amadeus.com/TPCBRQ_18_1_1A" >
	<tpc:pricingOptionGroup>
		<tpc:pricingOptionKey>
			<tpc:pricingOptionKey>RP</tpc:pricingOptionKey>
		</tpc:pricingOptionKey>
	</tpc:pricingOptionGroup>
	<tpc:pricingOptionGroup>
		<tpc:pricingOptionKey>
			<tpc:pricingOptionKey>RU</tpc:pricingOptionKey>
		</tpc:pricingOptionKey>
	</tpc:pricingOptionGroup>


<tpc:pricingOptionGroup>
<tpc:pricingOptionKey>
<tpc:pricingOptionKey>VC</tpc:pricingOptionKey>
</tpc:pricingOptionKey>
<tpc:carrierInformation>
<tpc:companyIdentification>
<tpc:otherCompany>'.$flight_data.'</tpc:otherCompany>
</tpc:companyIdentification>
</tpc:carrierInformation>
</tpc:pricingOptionGroup>



 <tpc:pricingOptionGroup>
<tpc:pricingOptionKey>
<tpc:pricingOptionKey>FCO</tpc:pricingOptionKey>
</tpc:pricingOptionKey>
<tpc:currency>
<tpc:firstCurrencyDetails>
<tpc:currencyQualifier>FCO</tpc:currencyQualifier>
<tpc:currencyIsoCode>USD</tpc:currencyIsoCode>
</tpc:firstCurrencyDetails>
</tpc:currency>
</tpc:pricingOptionGroup>
</tpc:Fare_PricePNRWithBookingClass>
</soapenv:Body>
</soapenv:Envelope>';

$soapAction = "TPCBRQ_18_1_1A";

$sresult =  Amedus_processRequest($xml_PNRAdd,$soapAction);

$final_de = date('Ymd_His')."_".rand(1,10000);
$XmlReqFileName = 'Fare_PricePNRWithBookingClass_Req'.$final_de; $XmlResFileName = 'Fare_PricePNRWithBookingClass_Res'.$final_de;
$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
fwrite($fp, $xml_PNRAdd);
fclose($fp);
$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
fwrite($fp, $sresult);
fclose($fp);

$Fare_PricePNRWithBookingClass = array(
	'Fare_PricePNRWithBookingClassReq' => $xml_PNRAdd,
	'Fare_PricePNRWithBookingClassRes' => $sresult
	);
// echo "Fare_PricePNRWithBookingClass:<pre>"; print_r($Fare_PricePNRWithBookingClass); echo "</pre>";
	return $Fare_PricePNRWithBookingClass;

}

function Ticket_CreateTSTFromPricing($flight, $request,$SecuritySession,$seq,$SecurityToken,$passenger){
	$security_token_stateless = Amedus_get_security_token_stateless(); 
	$SequenceNumber=$seq +1;
	$psaList='';

	/*echo "<pre>";
	print_r ($passenger);
	echo "</pre>";exit();*/
	if(isset($passenger['ADULT']))
	{
		if(!empty($passenger['ADULT']))
		{
			$psaList.='<psaList>
			<itemReference>
				<referenceType>TST</referenceType>
				<uniqueReference>1</uniqueReference>
			</itemReference>
		</psaList>';
	}
}
if(isset($passenger['CHILD'])){
	if(!empty($passenger['CHILD'])){

		$psaList.='<psaList>
		<itemReference>
			<referenceType>TST</referenceType>
			<uniqueReference>2</uniqueReference>
		</itemReference>
	</psaList>';
}
}
if(isset($passenger['INFANT'])){			
	if(!empty($passenger['INFANT'])){
		if(isset($passenger['CHILD']) && !empty($passenger['CHILD']) ){
			$psaList.='<psaList>
			<itemReference>
				<referenceType>TST</referenceType>
				<uniqueReference>3</uniqueReference>
			</itemReference>
		</psaList>';
	}else{
		$psaList.='<psaList>
		<itemReference>
			<referenceType>TST</referenceType>
			<uniqueReference>2</uniqueReference>
		</itemReference>
	</psaList>';
}				
}
}


$soapAction='TAUTCQ_04_1_1A';
$xml_PNRAdd = '<?xml version="1.0" encoding="utf-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">

<soapenv:Header>
<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
</awsse:Session>

<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/'.$soapAction.'</add:Action>
<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
</soapenv:Header>
<soapenv:Body>
<taut:Ticket_CreateTSTFromPricing xmlns:taus="http://xml.amadeus.com/'.$soapAction.'">
'.$psaList.'
</taut:Ticket_CreateTSTFromPricing>
</soapenv:Body>
</soapenv:Envelope>';


$sresult =  Amedus_processRequest($xml_PNRAdd,$soapAction);

$final_de = date('Ymd_His')."_".rand(1,10000);
$XmlReqFileName = 'Ticket_CreateTSTFromPricing_Req'.$final_de; $XmlResFileName = 'Ticket_CreateTSTFromPricing_Res'.$final_de;
$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
fwrite($fp, $xml_PNRAdd);
fclose($fp);
$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
fwrite($fp, $sresult);
fclose($fp);

$Ticket_CreateTSTFromPricing = array(
	'Ticket_CreateTSTFromPricingReq' => $xml_PNRAdd,
	'Ticket_CreateTSTFromPricingRes' => $sresult
	);
	 	//echo "<pre>"; print_r($Ticket_CreateTSTFromPricing); echo "</pre>"; exit();
// echo "Ticket_CreateTSTFromPricing:<pre>"; print_r($Ticket_CreateTSTFromPricing); echo "</pre>";
	// print_r($Ticket_CreateTSTFromPricing); 
return $Ticket_CreateTSTFromPricing;

}

function PNR_AddMultiElements_option11($flight, $request,$SecuritySession,$seq,$SecurityToken){
	$security_token_stateless = Amedus_get_security_token_stateless(); 
	$SequenceNumber=$seq +1;
	
	$xml_PNRAdd10 = '
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
	<soapenv:Header>
	<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
	<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
	<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
	<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
</awsse:Session>

<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/PNRADD_17_1_1A</add:Action>
<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
</soapenv:Header>
<soapenv:Body>
<pnr:PNR_AddMultiElements xmlns:pnr="http://xml.amadeus.com/PNRADD_17_1_1A">
<pnr:pnrActions>
<pnr:optionCode>10</pnr:optionCode>
</pnr:pnrActions>
<pnr:dataElementsMaster>
<pnr:marker1/>
<pnr:dataElementsIndiv>
<pnr:elementManagementData>
<pnr:segmentName>RF</pnr:segmentName>
</pnr:elementManagementData>
<pnr:freetextData>
<pnr:freetextDetail>
<pnr:subjectQualifier>3</pnr:subjectQualifier>
<pnr:type>P22</pnr:type>
</pnr:freetextDetail>
<pnr:longFreetext>FREE TEXT</pnr:longFreetext>
</pnr:freetextData>
</pnr:dataElementsIndiv>
</pnr:dataElementsMaster>
</pnr:PNR_AddMultiElements>
</soapenv:Body></soapenv:Envelope>';



$soapAction = "PNRADD_17_1_1A";

$sresult =  Amedus_processRequest($xml_PNRAdd10,$soapAction);

$final_de = date('Ymd_His')."_".rand(1,10000);
$XmlReqFileName = 'PNR_AddMultiElements_Req'.$final_de; $XmlResFileName = 'PNR_AddMultiElements_Res'.$final_de;
$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
fwrite($fp, $xml_PNRAdd10);
fclose($fp);
$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
fwrite($fp, $sresult);
fclose($fp);

$PNR_AddMultiElements_option11 = array(
	'PNR_AddMultiElements_option11Req' => $xml_PNRAdd10,
	'PNR_AddMultiElements_option11Res' => $sresult
	);
// echo "PNR_AddMultiElements_option11:<pre>"; print_r($PNR_AddMultiElements_option11); echo "</pre>"; exit;
	// print_r($PNR_AddMultiElements_option10); die();
return $PNR_AddMultiElements_option11;

}


function queue_place($SecuritySession,$seq,$SecurityToken,$pnr){
	$security_token_stateless = Amedus_get_security_token_stateless();
	$SequenceNumber=$seq +1;
	$xml='<?xml version="1.0" encoding="UTF-8"?>           
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus
	.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
	<soapenv:Header>
	<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
	<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
	<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
	<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
	</awsse:Session>
	<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
	<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/QUQPCQ_03_1_1A</add:Action>
	<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
	</soapenv:Header>
	<soapenv:Body>
	<Queue_PlacePNR>
	<placementOption>
	<selectionDetails>
	<option>QEQ</option>
	</selectionDetails>
	</placementOption>
	<targetDetails>
	<targetOffice>
	<sourceType>
	<sourceQualifier1>3</sourceQualifier1>
	</sourceType>
	<originatorDetails>
	<inHouseIdentification1>LGA1S210D</inHouseIdentification1>
	</originatorDetails>
	</targetOffice>
	<queueNumber>
	<queueDetails>
	<number>1</number>
	</queueDetails>
	</queueNumber>
	<categoryDetails>
	<subQueueInfoDetails>
	<identificationType>C</identificationType>
	<itemNumber>0</itemNumber>
	</subQueueInfoDetails>
	</categoryDetails>
	</targetDetails>
	<recordLocator>
	<reservation>
	<controlNumber>'.$pnr.'</controlNumber>
	</reservation>
	</recordLocator>
	</Queue_PlacePNR>
	</soapenv:Body>
	</soapenv:Envelope>';
	$soapAction = "QUQPCQ_03_1_1A";
	$sresult=Amedus_processRequest($xml,$soapAction);

	$final_de = date('Ymd_His')."_".rand(1,10000);
	$XmlReqFileName = 'placequeue_Req'.$final_de; $XmlResFileName = 'placequeue_Res'.$final_de;
	$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
	fwrite($fp, $xml);
	fclose($fp);
	$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
	fwrite($fp, $sresult);
	fclose($fp);

	$queue_place_response = array(
	'queue_placeReq' => $xml,
	'queue_placeRes' => $sresult
	);
	// print_r($queue_place_response); die();
return $queue_place_response;
 }

function Security_SignOut($SecuritySession,$seq,$SecurityToken){

	$security_token_stateless = Amedus_get_security_token_stateless();
	$SequenceNumber=$seq +1;
	$xml='<?xml version="1.0" encoding="UTF-8"?>           
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus
	.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
	<soapenv:Header>
	<awsse:Session TransactionStatusCode="End" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">		
	<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
	<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
	<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
	</awsse:Session>
	<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
	<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/VLSSOQ_04_1_1A</add:Action>
	<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
	</soapenv:Header>
	<soapenv:Body>
	<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A"></Security_SignOut>
	</soapenv:Body>
	</soapenv:Envelope>';

	$soapAction = "VLSSOQ_04_1_1A";

	$sresult=Amedus_processRequest($xml,$soapAction);

	$final_de = date('Ymd_His')."_".rand(1,10000);
	$XmlReqFileName = 'Security_SignOut_Req'.$final_de; $XmlResFileName = 'Security_SignOut_Res'.$final_de;
	$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
	fwrite($fp, $xml);
	fclose($fp);
	$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
	fwrite($fp, $sresult);
    fclose($fp);
}

function Amedus_get_security_token_stateless(){
	$CI =& get_instance();
	$CI->load->model('flight_model');
	$credentials = $CI->Flight_Model->get_api_credentials('amadeus'); 
	if(isset($credentials->api_username)){
		$data['api_id']       		= $credentials->api_details_id;
		$data['Username']       	= $credentials->api_username;
		$data['pwd']            	= trim($credentials->api_password);
		$data['PseudoCityCode'] 	= $credentials->pseudo_city_code;
		$data['WSAP']				= $credentials->api_WSAP;
		$data['no_of_records']		= $credentials->no_of_records;
		$data['agent_duty_code']	= $credentials->agent_duty_code;
		$data['requester_type']		= $credentials->requester_type;
		$data['POS_Type']			= $credentials->POS_Type;
		$data['created']      		= getCreateDate();
		$data['nonce']        	 	= getNoncevalue();
		$data['hashPwd']       		= DigestAlgo($data['pwd'],$data['created'],$data['nonce']);
	//		echo "<pre/>";print_r($data);exit();
		return $data;
	}else{
		return '';
	}		
}

function DateAmadeusCon($val){
	$newdate=array();
	$date=explode('T',$val);
	$datestr=$date[0].' '.$date[1];
	$newdate[0]=date('dmy',strtotime($datestr));
	$newdate[1]=date('Hi',strtotime($datestr));	
	return $newdate; 
}
function convertdate($dob,$x,$adults,$childs,$infants){

	$dobary=explode('/',$dob);
	$newdob=$dobary[2]."-".$dobary[1]."-".$dobary[0];
	if($newdob == "--") {
		if($x < $adults) {
			$newdob = date('Y-m-d', strtotime('-40 years') );
		}else if($x < $adults+$childs) {
			$newdob = date('Y-m-d', strtotime('-10 years') );
		}else if($x < $adults+$childs+$infants) {
			$newdob = date('Y-m-d', strtotime('-1 years') );
		}
	}
	return $newdob;
} 
function objectToArray($d) {
	if (is_object($d)) {
	// Gets the properties of the given object
	// with get_object_vars function
		$d = get_object_vars($d);
	}
	
	if (is_array($d)) {
	/*
	* Return array converted to object
	* Using __FUNCTION__ (Magic constant)
	* for recursive call
	*/
	return array_map(__FUNCTION__, $d);
}
else {
	// Return array
	return $d;
}
}
function Amedus_processRequest($requestData,$soap_action)
{
	$CI =& get_instance();
	$CI->load->model('Flight_Model');
	$CI->load->model('Xml_Model');
	$credentials = $CI->Flight_Model->get_api_credentials('amadeus');  
	if(isset($credentials->api_username)){			
		$username       = $credentials->api_username;
		$password            = $credentials->api_password;
		$PseudoCityCode = $credentials->api_username1;
		$url = $credentials->api_url;
		$soap = $credentials->api_url1;
		$soapAction = $soap.'/'.$soap_action;
		$headers = array( 
			'Content-Type: text/xml; charset="utf-8"', 
			'Content-Length: '.strlen($requestData), 
			//'Accept-Encoding: gzip,deflate',
			'Accept: text/xml', 
			'Cache-Control: no-cache', 
			'Pragma: no-cache',
			'SOAPAction: "'.$soapAction.'"'
			);
		global $curtime;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData); 
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		 $response = curl_exec($ch); //echo 'response:<pre>'; print_r($response); exit();
		 $error = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		 curl_close($ch);
		//if(Security_SignOut)
		 $xml_log = array(
		 	'api_name' => 'AMEDUS',
		 	'XML_Type' => 'AMEDUS XML'.$soap_action,
		 	'XML_Request' => $requestData,
		 	'XML_Response' => $response,
		 	'Ip_address' => $_SERVER['REMOTE_ADDR'],
		 	'xml_timestamp' => date('Y-m-d H:i:s')
			  ); //echo 'header<pre>'; print_r($xml_log); exit();
			  //$CI->Xml_Model->insert_xml_log($xml_log);
		 return $response;
		}
		else
		{
			$xml_log = array(
				'api_name' => 'AMEDUS',
				'XML_Type' => 'AMEDUS FLIGHT - API DEACTIVATED',
				'XML_Request' => $requestData,
				'XML_Response' => '',
				'Ip_address' => $_SERVER['REMOTE_ADDR'],
				'xml_timestamp' => date('Y-m-d H:i:s')
				);
			$CI->Xml_Model->insert_xml_log($xml_log);
			return '';	
		} //print_r($xml_log); exit();
	}


	function DocIssuance_IssueTicket($SecuritySession, $seq, $SecurityToken){
	$SequenceNumber=$seq +1;
	$security_token_stateless = Amedus_get_security_token_stateless(); 
	$DocIssuance_IssueTicket = '<?xml version="1.0" encoding="UTF-8"?>           
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus
	.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
	<soapenv:Header>
	<awsse:Session TransactionStatusCode="End" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">		
	<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
	<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
	<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
	</awsse:Session>
	<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
	<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/TTKTIQ_15_1_1A</add:Action>
	<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
	</soapenv:Header>
	<soapenv:Body>
	<DocIssuance_IssueTicket>
	    <optionGroup>
	        <switches>
	            <statusDetails>
	                <indicator>ET</indicator>
	            </statusDetails>
	        </switches>
	    </optionGroup>
	</DocIssuance_IssueTicket>
	</soapenv:Body>
	</soapenv:Envelope>';
	
	$soapAction = "TTKTIQ_15_1_1A";
	$sresult =  Amedus_processRequest($DocIssuance_IssueTicket,$soapAction);
	$final_de = date('Ymd_His')."_".rand(1,10000);
	$XmlReqFileName = 'DocIssuance_IssueTicket_Req'.$final_de; $XmlResFileName = 'DocIssuance_IssueTicket_Res'.$final_de;
	$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
	fwrite($fp, $DocIssuance_IssueTicket);
	fclose($fp);
	$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
	fwrite($fp, $sresult);
	fclose($fp);
	$DocIssuance_IssueTicket = array(
			'DocIssuance_IssueTicketReq' => $DocIssuance_IssueTicket,
			'DocIssuance_IssueTicketRes' => $sresult
		);
		
	return $DocIssuance_IssueTicket;

}
	function getNoncevalue() {
		$Nonce = base64_encode(time());
		return $Nonce;
	}

	function getCreateDate() {
	    $gmdate = gmdate('Y-m-d\TH:i:s\Z');
	  	return $gmdate;

	}

	function hextobin($hexstr)
	{
		$n = strlen($hexstr);
		$sbin=""; 
		$i=0;
		while($i<$n)
		{     
			$a =substr($hexstr,$i,2);         
			$c = pack("H*",$a);
			if ($i==0){$sbin=$c;}
			else {$sbin.=$c;}
			$i+=2;
		} 
		return $sbin;
	}


	function DigestAlgo($pwd,$created,$nonce)
	{
//echo $pwd.'-'.$created.'-'.$nonce;exit;

		$passha = hextobin(strtoupper(sha1($pwd)));
		$Nonces = base64_decode($nonce);
		$DigHex = hextobin(strtoupper(sha1($Nonces.$created.$passha)));
		return $passwordDigest = base64_encode($DigHex);
	}   


	function uuid($serverID=1)
	{ 
		$t=explode(" ",microtime());
		return sprintf( '%04x-%08s-%08s-%04s-%04x%04x',$serverID,clientIPToHex(),substr("00000000".dechex($t[1]),-8),   
       substr("0000".dechex(round($t[0]*65536)),-4), // get 4HEX of microtime
       mt_rand(0,0xffff), mt_rand(0,0xffff));
	}

	function clientIPToHex($ip="") 
	{ 
		$hex="";
		if($ip=="") $ip=getEnv("REMOTE_ADDR");
		$part=explode('.', $ip);
		for ($i=0; $i<=count($part)-1; $i++) {
			$hex.=substr("0".dechex($part[$i]),-2);
		}
		return $hex;
	}


	function getuuid()
	{
		return 'urn:uuid:'.uuid();
	}


	function xml2array($xmlStr, $get_attributes = 1, $priority = 'tag') 
	{
    	//print_r($xmlStr);die();
        // I renamed $url to $xmlStr, $url was the first parameter in the method if you
        // want to load from a URL then rename $xmlStr to $url everywhere in this method
		$contents = "";
		if (!function_exists('xml_parser_create')) {
			return array();
		}
		$parser = xml_parser_create('');

		xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, trim($xmlStr), $xml_values);
		xml_parser_free($parser);
		if (!$xml_values)
            return; //Hmm...
        //echo "<pre>"; print_r($xml_values); echo "</pre>";  die();
        $xml_array = array();
        $parents = array();
        $opened_tags = array();
        $arr = array();
        $current = & $xml_array;
        $repeated_tag_index = array();
        foreach ($xml_values as $data) {
        	unset($attributes, $value);
            //echo "<pre>"; print_r($get_attributes); echo "</pre>";  die();
        	extract($data);
        	$result = array();
        	$attributes_data = array();
        	if (isset($value)) {
        		if ($priority == 'tag')
        			$result = $value;
        		else
        			$result['value'] = $value;
        	}
        	if (isset($attributes) and $get_attributes) {
        		foreach ($attributes as $attr => $val) { 
        			if ($priority == 'tag')
        				$attributes_data[$attr] = $val;
        			else
                    	$result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
                }
            }
            if ($type == "open") {
            	$parent[$level - 1] = & $current; 
            	if (!is_array($current) or (!in_array($tag, array_keys($current)))) {
            		$current[$tag] = $result;
            		if ($attributes_data)
            			$current[$tag . '_attr'] = $attributes_data;
            		$repeated_tag_index[$tag . '_' . $level] = 1;
            		$current = & $current[$tag];
            	}
            	else {
            		if (isset($current[$tag][0])) {
            			$current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
            			$repeated_tag_index[$tag . '_' . $level]++;
            		} else {
            			$current[$tag] = array(
            				$current[$tag],
            				$result
            				);
            			$repeated_tag_index[$tag . '_' . $level] = 2;
            			if (isset($current[$tag . '_attr'])) {
            				$current[$tag]['0_attr'] = $current[$tag . '_attr'];
            				unset($current[$tag . '_attr']);
            			}
            		}
            		$last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
            		$current = & $current[$tag][$last_item_index];
            	}
            } elseif ($type == "complete") {
            	if (!isset($current[$tag])) {
            		$current[$tag] = $result;
            		$repeated_tag_index[$tag . '_' . $level] = 1;
            		if ($priority == 'tag' and $attributes_data)
            			$current[$tag . '_attr'] = $attributes_data;
            	}
            	else {
            		if (isset($current[$tag][0]) and is_array($current[$tag])) {
            			$current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
            			if ($priority == 'tag' and $get_attributes and $attributes_data) {
            				$current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
            			}
            			$repeated_tag_index[$tag . '_' . $level]++;
            		} else {
            			$current[$tag] = array(
            				$current[$tag],
            				$result
            				);
            			$repeated_tag_index[$tag . '_' . $level] = 1;
            			if ($priority == 'tag' and $get_attributes) {
            				if (isset($current[$tag . '_attr'])) {
            					$current[$tag]['0_attr'] = $current[$tag . '_attr'];
            					unset($current[$tag . '_attr']);
            				}
            				if ($attributes_data) {
            					$current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
            				}
            			}
                        $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                    }
                }
            } elseif ($type == 'close') {
            	$current = & $parent[$level - 1];
            }
        }
        //echo "<pre>"; print_r($xml_array); echo "</pre>";  die();
        return ($xml_array);
    }

    function PNR_Retrieve($pnr){

	$security_token_stateless 	= Amedus_get_security_token_stateless();

	$soapAction = "PNRRET_17_1_1A";

	$xml_PNRRetrieve = '<?xml version="1.0" encoding="UTF-8"?>
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
				<soapenv:Header>
				<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
				<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/'.$soapAction.'</add:Action>
				<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
				<link:TransactionFlowLink xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"/>
				<oas:Security xmlns:oas="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
				<oas:UsernameToken oas1:Id="UsernameToken-1" xmlns:oas1="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
				<oas:Username>'.$security_token_stateless['Username'].'</oas:Username>
				<oas:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$security_token_stateless['nonce'].'</oas:Nonce>
				<oas:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">'.$security_token_stateless['hashPwd'].'</oas:Password>
				<oas1:Created>'.$security_token_stateless['created'].'</oas1:Created>
				</oas:UsernameToken>
				</oas:Security>
				<AMA_SecurityHostedUser xmlns="http://xml.amadeus.com/2010/06/Security_v1">
				<UserID AgentDutyCode="SU" RequestorType="U" PseudoCityCode="'.$security_token_stateless['PseudoCityCode'].'" POS_Type="1"/>
				</AMA_SecurityHostedUser>
				<awsse:Session TransactionStatusCode="Start" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3"/>
				</soapenv:Header>
				<soapenv:Body>
				<PNR_Retrieve xmlns="http://xml.amadeus.com/'.$soapAction.'">
				<retrievalFacts>
				<retrieve>
				<type>2</type>
				</retrieve>
				<reservationOrProfileIdentifier>
				<reservation>
				<controlNumber>'.$pnr.'</controlNumber>
				</reservation>
				</reservationOrProfileIdentifier>
				</retrievalFacts>
				</PNR_Retrieve>
				</soapenv:Body>
				</soapenv:Envelope>';
	
	$sresult =  Amedus_processRequest($xml_PNRRetrieve,$soapAction); 

	$final_de = date('Ymd_His')."_".rand(1,10000);
	$XmlReqFileName = 'PNR_Retrieve_Req'.$final_de; $XmlResFileName = 'PNR_Retrieve_Res'.$final_de;
	$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
	fwrite($fp, $xml_PNRRetrieve);
	fclose($fp);
	$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
	fwrite($fp, $sresult);
	fclose($fp);

	$PNR_Retrieve = array(
			'PNR_RetrieveReq' => $xml_PNRRetrieve,
			'PNR_RetrieveRes' => $sresult
		); 
		return $PNR_Retrieve;
}

function pnrRetrieveStateless($pnr, $SecuritySession, $seq, $SecurityToken){
	$SequenceNumber = $seq +1;
	$security_token_stateless 	= Amedus_get_security_token_stateless();
	$soapAction = "PNRRET_17_1_1A";
	$xml_PNRRetrieve = '<?xml version="1.0" encoding="UTF-8"?>
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
					<soapenv:Header>
						<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
							<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
							<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
							<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
						</awsse:Session>
						<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
						<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/'.$soapAction.'</add:Action>
						<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
					</soapenv:Header>
				<soapenv:Body>
				<PNR_Retrieve xmlns="http://xml.amadeus.com/'.$soapAction.'">
					<retrievalFacts>
						<retrieve>
							<type>2</type>
						</retrieve>
						<reservationOrProfileIdentifier>
							<reservation>
								<controlNumber>'.$pnr.'</controlNumber>
							</reservation>
						</reservationOrProfileIdentifier>
					</retrievalFacts>
				</PNR_Retrieve>
				</soapenv:Body>
				</soapenv:Envelope>';
	$sresult =  Amedus_processRequest($xml_PNRRetrieve,$soapAction);
	
	$final_de = date('Ymd_His')."_".rand(1,10000);
	$XmlReqFileName = 'PNR_Retrieve_Req'.$final_de;
	$XmlResFileName = 'PNR_Retrieve_Res'.$final_de;
	$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
	fwrite($fp, $xml_PNRRetrieve);
	fclose($fp);
	$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
	fwrite($fp, $sresult);
	fclose($fp);
	
	
	$PNR_Retrieve = array(
			'PNR_RetrieveReq' => $xml_PNRRetrieve,
			'PNR_RetrieveRes' => $sresult
	);
	return $PNR_Retrieve;
}

function PNR_Cancel($SecuritySession,$SequenceNumber,$SecurityToken){
	$seq = $SequenceNumber+1;
	$security_token_stateless 	= Amedus_get_security_token_stateless();
	$soapAction = "PNRXCL_14_1_1A";
	$xml_pnrCancle = '<?xml version="1.0" encoding="UTF-8"?>
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
				<soapenv:Header>
				<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
				<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
				<awsse:SequenceNumber>'.$seq.'</awsse:SequenceNumber>
				<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
				</awsse:Session>
				<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
				<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/'.$soapAction.'</add:Action>
				<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
				</soapenv:Header>
				<soapenv:Body>
				<PNR_Cancel xmlns="http://xml.amadeus.com/'.$soapAction.'">				
				<pnrActions>
				<optionCode>0</optionCode>
				</pnrActions>
				<cancelElements>
				<entryType>I</entryType>
				</cancelElements>
				</PNR_Cancel>
				</soapenv:Body>
				</soapenv:Envelope>';
	
	$sresult =  Amedus_processRequest($xml_pnrCancle,$soapAction); 
	$final_de = date('Ymd_His')."_".rand(1,10000);
	$XmlReqFileName = 'PNR_Cancel_Req'.$final_de; $XmlResFileName = 'PNR_Cancel_Res'.$final_de;
	$fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
	fwrite($fp, $xml_pnrCancle);
	fclose($fp);
	$fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
	fwrite($fp, $sresult);
	fclose($fp);

	$PNR_Cancel = array(
			'PNR_CancelReq' => $xml_pnrCancle,
			'PNR_CancelRes' => $sresult
		); 
		return $PNR_Cancel;
}


// XML LOGS
	function prettyPrint($result, $file) {
		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML(simplexml_load_string($result)->asXML());
		outputWriter($file, $dom->saveXML());
		return $dom->saveXML();
	}
	function outputWriter($file, $content) {
		file_put_contents($file, $content);
	}


	function Get_Fare_Rule($search_request){

    $security_token_stateless 	= Amedus_get_security_token_stateless();
    $soapAction = "FARRNQ_10_1_1A";
    $xml_query='
        <?xml version="1.0" encoding="UTF-8"?>           
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" xmlns:typ="http://xml.amadeus.com/2010/06/Type">
        <soapenv:Header>
        <add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
        <add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/'.$soapAction.'</add:Action>
        <add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
        <link:TransactionFlowLink xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"/>
        <oas:Security xmlns:oas="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
        <oas:UsernameToken oas1:Id="UsernameToken-1" xmlns:oas1="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
        <oas:Username>'.$security_token_stateless['Username'].'</oas:Username>
        <oas:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$security_token_stateless['nonce'].'</oas:Nonce>
        <oas:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">'.$security_token_stateless['hashPwd'].'</oas:Password>
        <oas1:Created>'.$security_token_stateless['created'].'</oas1:Created>
    </oas:UsernameToken>
    </oas:Security>
    <AMA_SecurityHostedUser xmlns="http://xml.amadeus.com/2010/06/Security_v1">
    <UserID AgentDutyCode="'.$security_token_stateless['agent_duty_code'].'" RequestorType="'.$security_token_stateless['requester_type'].'" PseudoCityCode="'.$security_token_stateless['PseudoCityCode'].'" POS_Type="'.$security_token_stateless['POS_Type'].'"/>
    </AMA_SecurityHostedUser>
    </soapenv:Header>
    <soapenv:Body>';

    $xml_query .= '<Fare_GetFareRules xmlns="http://xml.amadeus.com/"'.$soapAction.' >
                        <msgType>
                            <messageFunctionDetails>
                            <messageFunction>FRN</messageFunction>
                            </messageFunctionDetails>
                        </msgType>
                        <pricingTickInfo>
                            <productDateTimeDetails>
                            <ticketingDate>'.$search_request['date'].'</ticketingDate>
                            </productDateTimeDetails>
                        </pricingTickInfo>
                        <flightQualification>
                            <additionalFareDetails>
                                <rateClass>'.$search_request['farebasis'].'</rateClass>
                            </additionalFareDetails>
                        </flightQualification>
                        <transportInformation>
                            <transportService>
                                <companyIdentification>
                                    <marketingCompany>'.$search_request['carrier'].'</marketingCompany>
                                </companyIdentification>
                            </transportService>
                        </transportInformation>
                        <tripDescription>
                            <origDest>
                                <origin>'.$search_request['origin'].'</origin>
                                <destination>'.$search_request['destination'].'</destination>
                            </origDest>
                        </tripDescription>
                    </Fare_GetFareRules>';

    $xml_query .= '
        </soapenv:Body>
        </soapenv:Envelope>';
        $result = Amedus_processRequest($xml_query,$soapAction);
        $final_de = date('Ymd_His')."_".rand(1,10000);
        $XmlReqFileName = 'FareRule_Search_Req'.$final_de; $XmlResFileName = 'FareRule_Search_Res'.$final_de;
        $fp = fopen("logs/Flight/".$XmlReqFileName.'.xml', 'a+');
        fwrite($fp, $xml_query);
        fclose($fp);
        $fp = fopen("logs/Flight/".$XmlResFileName.'.xml', 'a+');
        fwrite($fp, $result);
        fclose($fp);

        $Fare_MasterPricerTravelBoardSearch = array(
            'FareRule_SearchReq' => $xml_query,
            'FareRule_SearchRes' => $result
        );

        return $Fare_MasterPricerTravelBoardSearch;

    }

  function minirules($SecuritySession,$seq,$SecurityToken){
  	$security_token_stateless = Amedus_get_security_token_stateless();


		$soapAction='TMRCRQ_11_1_1A';
		$xml_mini = '<?xml version="1.0" encoding="utf-8"?>
	
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">

		<soapenv:Header>
			<awsse:Session TransactionStatusCode="InSeries" xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3">
			<awsse:SessionId>'.$SecuritySession.'</awsse:SessionId>
			<awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
			<awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
			</awsse:Session>
			<add:MessageID xmlns:add="http://www.w3.org/2005/08/addressing">'.getuuid().'</add:MessageID>
			<add:Action xmlns:add="http://www.w3.org/2005/08/addressing">http://webservices.amadeus.com/'.$soapAction.'</add:Action>
			<add:To xmlns:add="http://www.w3.org/2005/08/addressing">https://nodeD1.test.webservices.amadeus.com/'.$security_token_stateless['WSAP'].'</add:To>
		</soapenv:Header>
		<soapenv:Body>
			<MiniRule_GetFromPricing>
			<fareRecommendationId>
					<referenceType>FRN</referenceType>
					<uniqueReference>ALL</uniqueReference>
			</fareRecommendationId>
		</MiniRule_GetFromPricing>			
		</soapenv:Body>
	</soapenv:Envelope>';
	
	$sresult =  Amedus_processRequest($xml_mini,$soapAction);
	echo "<pre>";
	print_r ($sresult);
	echo "</pre>";exit();
	
}