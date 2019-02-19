<?php

/**
 *    User Helper
 */

function curlUsingPost($url, $data)
{

    $response = new stdClass();
    if (empty($url) || empty($data)) {
        $response->code = 198;
        $response->message = 'Parameter not Passed';
        return $response;
    }
    $fields_string = '';
    foreach ($data as $key => $value) {
        $fields_string .= $key . '=' . $value . '&';
    }


    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POST, count($data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); # timeout after 10 seconds, you can increase it

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  # Set curl to return the data instead of printing it to the browser.
    // curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); # Some server may refuse your request if you dont pass user agent
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //execute post
    $result = curl_exec($ch);
//        return $result;
//        echo "<pre>"; print_r($result); die;

    $result = json_decode($result, true);
    curl_close($ch);

    if ($result) {
        @$response->message = $result['message'];
        @$response->code = $result['code'];
        @$response->data = $result['data'];
        return @$response;
    } else {
        $response->code = 196;
        $response->message = 'Some error occurred, Request not completed';
        return $response;
    }
}