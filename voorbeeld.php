<?php

$data = [
    'client_id' => 'CLIENT_ID',
    'client_secret' => 'CLIENT_SECRET',
    'grant_type' => 'client_credentials',
    'scope' => 'api_informat_sas_leerlingen.voorinschrijvingen.INSTELLINGSNR'
];

$identityreq = curl_init('https://www.identityserver.be/connect/token');
curl_setopt($identityreq, CURLOPT_RETURNTRANSFER, true);
curl_setopt($identityreq, CURLOPT_POSTFIELDS, $data);

$token = json_decode(curl_exec($identityreq));
curl_close($identityreq);

$reg_data = [
    "lastName" => "Eastwood",
    "firstName" => "Scott",
    "additionalNames" => null,
    "dateOfBirth" => "2010-04-01",
    "countryOfBirthCode" => "00150",
    "placeOfBirthCode" => "8600",
    "placeOfBirth" => null,
    "nationalityCode" => "00150",
    "sex" => 1,
    "insz" => "10040115670",
    "eIdNo" => "1234",
    "eIdPhoto" => "",
    "mobilePhone" => "",
    "email" => "Scott.Eastwood@telenet.be",
    "nameOfDoctor" => "Ever young",
    "phoneOfDoctor" => null,
    "firstLanguage" => "Vlaams",
    "isHomeless" => false,
    "migrating" => false,
    "isIndicatorPupil" => true,
    "religion" => null,
    "priorityGroup" => null,
    "reasonForRefusal" => null,
    "Relationships" => [
        [
            "type" => 13,
            "lastName" => "Eastwood",
            "firstName" => "Clint",
            "phone" => null,
            "mobilePhone" => null,
            "email" => "TisTeZot@telenet.be",
            "Address" => [
                "streetName" => "Nijverheidslaan",
                "houseNo" => "120A",
                "houseBusNo" => null,
                "postalCode" => "8600",
                "city" => "Diksmuide",
                "countryCode" => "00150",
                "isDomicileAddress" => true,
                "isWritingAddress" => false,
                "isResidenceAddress" => true
            ]
        ]
    ],
    "preRegistrationId" => "EA840317-856F-4280-BE8F-DE0A46E2935F",
    "schoolyear" => "2020-21",
    "institute" => "INSTELLINGSNR",
    "structure" => "211",
    "locationId" => "001",
    "admgrpId" => "040102",
    "admgrpDetail" => "Test jaar",
    "preRegistrationDate" => "2020-06-05T10:15",
    "startDate" => "2020-09-01",
    "registrationStatus" => 1,
    "Remark" => "Mijn eerste test registratie"
];

$token_data = [
    'Accept: application/json',
    'Content-Lengt: ' . strlen(json_encode($reg_data)),
    'Content-Type: application/json',
    'InstituteNo: INSTELLINGSNR',
    'Timestamp: ' . date("c"),
    'Authorization: ' . $token->token_type . ' ' . $token->access_token
];

$registerreq = curl_init('https://leerlingenapi.informatsoftware.be/1/preregistrations/save');
curl_setopt($registerreq, CURLOPT_POST, true);
curl_setopt($registerreq, CURLOPT_RETURNTRANSFER, true);
curl_setopt($registerreq, CURLOPT_POSTFIELDS, json_encode($reg_data));
curl_setopt($registerreq, CURLOPT_HTTPHEADER, $token_data);

$register = curl_exec($registerreq);
curl_close($registerreq);

var_dump($register);
