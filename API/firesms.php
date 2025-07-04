
<?php
$firevalue=0;
if($firevalue==0)
{

              $curl = curl_init();
              curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,    
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "cache-control: no-cache"
                ),
              ));

              $response = curl_exec($curl);
              $err = curl_error($curl);
              $fields = array(
                  "sender_id" => "TXTIND",
                  "message" => "This is Fire alert",
                  "route" => "v3",
                  "numbers" => 9879563160,
              );

              curl_setopt_array($curl, array(
            
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_HTTPHEADER => array(
                  "authorization:gVcb6KME8lCsz9x5P58JJ4dqcWUJgsbdwpKyLXfyLzgDAjzPrXL0pIaQpDqS",
                  "accept: */*",
                  "cache-control: no-cache",
                  "content-type: application/json"
                ))
                );
              $response = curl_exec($curl);
              $err = curl_error($curl);

              curl_close($curl);

              if ($err) {
                echo "cURL Error #:" . $err;
              } 
              else {
                echo $response;
              }

}
else
{
        echo "Status value doesnt match";
}

?>