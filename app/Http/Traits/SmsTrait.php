<?php

namespace App\Http\Traits;;

use Illuminate\Http\Request; 
use App\Models\Settings; 
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Learner;

trait SmsTrait {

     /**
     * Send SMS.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function SendSMS($option,$recipient = [],$message,$is_schedule = false,$date_time)
    {

       if (strcmp($option['sms_company'],'MNOTIFY') == 0){

        $url = $option['sms_url'] . '?key=' . $option['sms_key'];

        $data = [
           'recipient' => $recipient,
           'sender' => $option['sms_sender'],
           'message' => $message,
           'is_schedule' => $is_schedule,
           'schedule_date' => $date_time
        ];

        $ch = curl_init();
        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);
if (strcmp($result['status'],'success')==0){
    return $result['code'];
}else{
    return 401; //error
}

       }else{

        $username = $option['sms_username'];
        $password = $option['sms_password'];
        //dd($username.$password );
        $url = "";
        
        $url .= "http://rslr.connectbind.com/bulksms/bulksms?";
        $url .= "username=".$username;
        $url .= "&password=".urlencode($password);
        $url .= "&type=5&";
        $url .= "dlr=0";
        $url .= "&destination=".implode(",",$recipient);
        $url .= "&source=".trim($option['sms_sender']);
        $url .= "&message=".urlencode($message);
         
        try{
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
         curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        )); 
        // Send the request & save response to $result
        $result = curl_exec($curl);
        $parse_url = explode("|",$result);
        // Close request to clear up some resources
        curl_close($curl);
        //$parse_url=file($url);
       
        if ($parse_url[0] == "1701"){
                return 2000; //Request was successful (all recipients)
        }elseif ($parse_url[0] == "1703"){
            return '2'; //Invalid value in username or password field
        }elseif ($parse_url[0] == "1025"){
            return '3'; //:Insufficient 
        }else{
            return '4'; //Error in processing the request
        }
        }catch(Exception $e){
            return "5";
        }


       }

//return result code
  //2000 Message submitted successfully
  //400 	Bad Request
  //401 	Unauthorized
  //403 	Forbidden
  //404 	Not Found
  //405 	Method Not Allowed
  //429 	Too Many Requests.
  //500 	Internal Server Error.
    }

    private function unique_code($limit)
    {
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function SendVoice()
    {

        //
        $endPoint = 'https://api.mnotify.com/api/voice/quick';
        $apiKey = 'YOUR_API_KEY';
        $url = $endPoint . '?key=' . $apiKey;
        $curlFile = curl_file_create('path/to/your/voice/file');
        $data = [
           'campaign' => 'First Voice Campaign',
           'recipient' => ['0249706365', '0203698970'],
           'file' => $curlFile,
           'voice_id' => '',
           'is_schedule' => 'false',
           'schedule_date' => ''
        ];

        $ch = curl_init();
        $headers = array();
        $headers[] = "Content-Type: multipart/form-data";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);
    }

    public function getBgColors()
    {
        return array(
            'bg-primary',
            'bg-danger',
            'bg-success',
            'bg-warning',
            'bg-info',
            'bg-red',
            'bg-pink',
            'bg-purple',
            'bg-indigo',
            'bg-blue',
            'bg-cyan',
            'bg-teal',
            'bg-green',
            'bg-lime',
            'bg-yellow',
            'bg-amber',
            'bg-orange',
            'bg-grey'
        );
    }

    public function getColors()
    {
        return array(
            'primary',
            'info',
            'indigo',
            'success',
            'blue',
            'green',
            'cyan',
            'teal',
            'orange',
            'grey',
            'warning',
            'danger',
            'red',
            'pink',
            'purple',
           'lime',
            'yellow',
            'amber',
        );
    }

    public function GetPosition($Mvalue){
		$A = '';
        $Number = '';
        $i = '';
        $ii = '';
        $surfix = '';
        $B = '';
        $Number = trim($Mvalue);
        $i = strlen($Number);
        $ii = strlen($Number);
        $A = substr($Number,$i - 1,1);
        $B = $A;
        If ($Number == 11 || $Number == 12 || $Number == 13 || $Number == 111 || $Number == 112 || $Number == 113){
            $surfix = "th";
        }else{
            If($B == 1){
                $surfix = "st";
            }elseIf ($B == 2){
                $surfix = "nd";
            }elseIf ($B == 3){
                $surfix = "rd";
            }else{
                $surfix = "th";
            }
        }
        $Mvalue = $Number . $surfix;
        return $Mvalue;
    }

    /**
     *Generate School Reference code.
     *
     * @param
     * @return number
     */
    public function generateVcode()
    {
        $randomid = mt_rand(100000,999999);
        return $randomid;
    }

    public function FormatMessage($message,$N,$B,$D,$Cr,$Dr){
        //$edited_string = $message;
          if ($N){
              $message = str_replace('[N]',$N,$message);
          }else{
              $message = str_replace('[N]','',$message);
          }
  
          if ($N){
              $message = str_replace('[B]',$B,$message);
          }else{
              $message = str_replace('[B]','',$message);
          }
  
          if ($D){
              $message = str_replace('[D]',$D,$message);
          }
          else{
              $message = str_replace('[D]','',$message);
          }
  
          if ($Cr){
              $message = str_replace('[Cr]',$Cr,$message);
          }
          else{
              $message = str_replace('[Cr]','',$message);
          }
  
          if ($Dr){
              $message = str_replace('[Dr]',$Dr,$message);
          }
          else{
              $message = str_replace('[Dr]','',$message);
          }
          return $message;
      }
	  
    /**
     * Get application options.
     *
     * @param
     * @return array
     */
  public function getOptions(){
	   $options = [];
       $settings = Settings::where('id',1)->first();
    
       if ($settings != null){
       $options = json_decode($settings->settings, true);
        array_push($options,$settings->badge);
        array_push($options,$settings->signature);
       }
 
	   return $options;
  }

  public function getRecieptNumber(){
    $IDs = [];
    $count = Payment::whereYear('created_at', '=', date('Y'))->count() + 1;
    // dd($count);
    $count1 =  str_pad($count, 4, "0", STR_PAD_LEFT);
    $count2=  str_pad($count, 6, "0", STR_PAD_LEFT);
    $rand = rand(1,9);
    $rand2 = rand(11,99);
    $IDs[0] = 'RN'.$rand.$count1.date('y');
    $IDs[1] = 'OL'.$rand2.$count2.date('y');
    return $IDs;
 }

 public function generateIndexNumber(){
    //WGBS000122
  $count = Learner::whereYear('created_at',date('Y'))->count() + 1;
  $newid = str_pad($count,'4','0',STR_PAD_LEFT);
  return 'WGBC'.$newid.date('y');
}

}
