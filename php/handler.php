<?php   

    $additionalHeaders =  'Authorization: Basic ' . base64_encode("Ctmri:ZxCv");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $arr = [
        [
            "Date" => "2020-12-01T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-12-02T00:00:00",
            "Total" => 18,
            "Recorded" => 16,
            "Came" => 2,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-12-03T00:00:00",
            "Total" => 18,
            "Recorded" => 16,
            "Came" => 2,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-12-04T00:00:00",
            "Total" => 18,
            "Recorded" => 16,
            "Came" => 2,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-05T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-06T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-07T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-08T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-09T00:00:00",
            "Total" => 18,
            "Recorded" => 15,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-10T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-11T00:00:00",
            "Total" => 18,
            "Recorded" => 5,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-12T00:00:00",
            "Total" => 18,
            "Recorded" => 12,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-13T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-14T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-15T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-16T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-17T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-18T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-19T00:00:00",
            "Total" => 18,
            "Recorded" => 7,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-20T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-21T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-22T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-23T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-24T00:00:00",
            "Total" => 18,
            "Recorded" => 13,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-25T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-26T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-27T00:00:00",
            "Total" => 18,
            "Recorded" => 18,
            "Came" => 17,
            "didNotCome" => "1"
        ],
        [
            "Date" => "2020-11-28T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-29T00:00:00",
            "Total" => 0,
            "Recorded" => 0,
            "Came" => 0,
            "didNotCome" => ""
        ],
        [
            "Date" => "2020-11-30T00:00:00",
            "Total" => 18,
            "Recorded" => 3,
            "Came" => 0,
            "didNotCome" => ""
        ],
    ];
      
    curl_close($ch);
    echo json_encode($arr);

?>