<?php
use Illuminate\Support\Facades\DB;
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../.../../vendor/autoload.php');
class yahooCheck {
    public $email;
    public $verifier_email;
    public $port;
    private $mx;
    private $connect;
    private $errors;
    private $debug;
    private $debug_raw;

    private $_yahoo_signup_page_url = 'https://login.yahoo.com/account/create?specId=yidReg&lang=en-US&src=&done=https%3A%2F%2Fwww.yahoo.com&display=login';
    private $_yahoo_signup_ajax_url = 'https://login.yahoo.com/account/module/create?validateField=yid';
    private $page_content;
    private $page_headers;

    public function __construct($email = null, $verifier_email = null, $port = 25){
      $this->debug = array();
      $this->debug_raw = array();
      if(!is_null($email) && !is_null($verifier_email)) {
        $this->debug[] = 'Initialized with Email: '.$email.', Verifier Email: '.$verifier_email.', Port: '.$port;
        $this->set_email($email);
        $this->set_verifier_email($verifier_email);
      }
      else {
        $this->debug[] = 'Initialized with no email or verifier email values';
      }
      $this->set_port($port);
    }


    public function set_verifier_email($email) {
      $this->verifier_email = $email;
      $this->debug[] = 'Verifier Email was set to '.$email;
    }

    public function get_verifier_email() {
      return $this->verifier_email;
    }


    public function set_email($email) {
      $this->email = $email;
      $this->debug[] = 'Email was set to '.$email;
    }

    public function get_email() {
      return $this->email;
    }

    public function set_port($port) {
      $this->port = $port;
      $this->debug[] = 'Port was set to '.$port;
    }

    public function get_port() {
      return $this->port;
    }

    public function get_errors(){
      return array('errors' => $this->errors);
    }

    public function get_debug($raw = false) {
      if($raw) {
        return $this->debug_raw;
      }
      else {
        return $this->debug;
      }
    }

    public function verify() {
      $this->debug[] = 'Verify function was called.';

      $is_valid = false;
      $domain = $this->get_domain($this->email);
      $is_valid = $this->validate_yahoo();
      return $is_valid;
    }

    private function get_domain($email) {
      $email_arr = explode('@', $email);
      $domain = array_slice($email_arr, -1);
      return $domain[0];
    }
    private function add_error($code, $msg) {
      $this->errors[] = array('code' => $code, 'message' => $msg);
    }

    private function clear_errors() {
      $this->errors = array();
    }

    private function validate_yahoo() {
      $this->debug[] = 'Validating a yahoo email address...';
      $this->debug[] = 'Getting the sign up page content...';
      $this->fetch_page('yahoo');

      $cookies = $this->get_cookies();
      $fields = $this->get_fields();

      $this->debug[] = 'Adding the email to fields...';
      $yid = explode('@', strtolower($this->email));
      $fields['yid'] = $yid[0];
      $this->debug[] = 'Ready to submit the POST request to validate the email.';

      $response = $this->request_validation('yahoo', $cookies, $fields);
      
      $this->debug[] = 'Parsing the response...';
      $response_errors = json_decode($response, true)['errors'];

      $this->debug[] = 'Searching errors for exisiting username error...';
      foreach($response_errors as $err){
        if($err['name'] == 'yid' && $err['error'] == 'IDENTIFIER_EXISTS'){
          $this->debug[] = 'Found an error about exisiting email.';
          return true;
        }
      }
      return false;
    }

   

    private function fetch_page($service, $cookies = ''){
      if($cookies){
        $opts = array(
          'http'=>array(
            'method'=>"GET",
            'header'=>"Accept-language: en\r\n" .
                      "Cookie: ".$cookies."\r\n"
          )
        );
        $context = stream_context_create($opts);
      }
      if($service == 'yahoo'){
        if($cookies){
          $this->page_content = file_get_contents($this->_yahoo_signup_page_url, false, $context);
        }
        else{
          $this->page_content = file_get_contents($this->_yahoo_signup_page_url);
        }
      }
      else if($service == 'hotmail'){
        if($cookies){
          $this->page_content = file_get_contents($this->_hotmail_signin_page_url, false, $context);
        }
        else{
          $this->page_content = file_get_contents($this->_hotmail_signin_page_url);
        }
      }

      if($this->page_content === false){
        $this->debug[] = 'Could not read the sign up page.';
        $this->add_error('200', 'Cannot not load the sign up page.');
      }
      else{
        $this->debug[] = 'Sign up page content stored.';
        $this->debug[] = 'Getting headers...';
        $this->page_headers = $http_response_header;
        $this->debug[] = 'Sign up page headers stored.';
      }
    }

    private function get_cookies(){
      $this->debug[] = 'Attempting to get the cookies from the sign up page...';
      if($this->page_content !== false){
        $this->debug[] = 'Extracting cookies from headers...';
        $cookies = array();
        foreach ($this->page_headers as $hdr) {
          if (preg_match('/^Set-Cookie:\s*(.*?;).*?$/i', $hdr, $matches)) {
            $cookies[] = $matches[1];
          }
        }

        if(count($cookies) > 0){
          $this->debug[] = 'Cookies found: '.implode(' ', $cookies);
          return $cookies;
        }
        else{
          $this->debug[] = 'Could not find any cookies.';
        }
      }
      return false;
    }

    private function get_fields(){
      $dom = new DOMDocument();
      $fields = array();
      if(@$dom->loadHTML($this->page_content)){
        $this->debug[] = 'Parsing the page for input fields...';
        $xp = new DOMXpath($dom);
        $nodes = $xp->query('//input');
        foreach($nodes as $node){
          $fields[$node->getAttribute('name')] = $node->getAttribute('value');
        }

        $this->debug[] = 'Extracted fields.';
      }
      else{
        $this->debug[] = 'Something is worng with the page HTML.';
        $this->add_error('210', 'Could not load the dom HTML.');
      }
      return $fields;
    }

    private function request_validation($service, $cookies, $fields){

      $headers = array();
      $headers[] = 'Origin: https://login.yahoo.com';
      $headers[] = 'X-Requested-With: XMLHttpRequest';
      $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36';
      $headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
      $headers[] = 'Accept: */*';
      $headers[] = 'Referer: https://login.yahoo.com/account/create?specId=yidReg&lang=en-US&src=&done=https%3A%2F%2Fwww.yahoo.com&display=login';
      $headers[] = 'Accept-Encoding: gzip, deflate, br';
      $headers[] = 'Accept-Language: en-US,en;q=0.8,ar;q=0.6';
    
      $cookies_str = implode(' ', $cookies);
      $headers[] = 'Cookie: '.$cookies_str;


      $postdata = http_build_query($fields);

      $opts = array('http' =>
        array(
          'method'  => 'POST',
          'header'  => $headers,
          'content' => $postdata
        )
      );

      $context  = stream_context_create($opts);
      $result = file_get_contents($this->_yahoo_signup_ajax_url, false, $context);
    
      return $result;
    }

    private function prep_hotmail_fields($cookies){
      $fields = array();
      foreach($cookies as $cookie){
        list($key, $val) = explode('=', $cookie, 2);
        if($key == 'uaid'){
          $fields['uaid'] = $val;
          break;
        }
      }
      $fields['username'] = strtolower($this->email);
      $fields['username'] = 'dhendik@algostudio.net';
      return $fields;
    }

  }
//MX record PHP
function mxrecordValidate($domain){
  $arr = dns_get_record($domain, DNS_MX);
  if(isset($arr[0]['host'])){
    return $arr[0]["target"];
  }
}
// host MX Check
function hostCheck($email){
    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, 'https://admin-store.meetprogram.com/Algolib/verifyEmailGET.php?email='.$email);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    $jsonData = trim((curl_exec($curlSession)));
    return $jsonData;
}
//Live Check
function liveCheck($email){
    $user =  $email;
    $pass = 'emailcleaner.com';

    $user = strip_tags($user);
    $pass = strip_tags($pass);

    $user = trim($user);
    $pass = trim($pass);

    $pwpad = "IfYouAreReadingThisYouHaveTooMuchFreeTime";
    $passlength = strlen($pass);
    $pwpad = substr($pwpad, 0, -$passlength);

    $ppft = file_get_contents("http://login.live.com/login.srf");
    $ppft = explode('name="PPFT" id="i0327" value="',$ppft);
    $ppft = explode('"/></form>',$ppft[1]);
    $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1"; 
    $loginURL = "https://login.live.com/ppsecure/post.srf?wa=wsignin1.0&rpsnv=10&ct=1241362924&rver=5.5.4177.0&wp=MBI&wreply=https:%2F%2Flive.xbox.com%2Fxweb%2Flive%2Fpassport%2FsetCookies.ashx%3Frru%3DhttpZ3AZ2FZ2FwwwZ2ExboxZ2EcomZ2FenZ2DUSZ2FdefaultZ2Ehtm&lc=1033&cb=B001033httpZ3AZ2FZ2FwwwZ2ExboxZ2EcomZ2FenZ2DUSZ2FdefaultZ2Ehtm&id=66262&bk=1241362922";
    $post = 'PPSX=Passport&PwdPad='.$pwpad.'&type=&login='.$user.'&passwd='.$pass.'&LoginOptions=3&PPFT=';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);        
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
    curl_setopt($ch,CURLOPT_REFERER,"http://login.live.com/login.srf");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $loginURL);
    $result = curl_exec($ch);

    curl_close($ch);
    if(strpos(htmlentities($result), 'IfExistsResult&quot;:0') !== false){
      $status = 'valid';
    } else {
      $status = 'invalid';
    }
    return $status;
}
//main
function main($email){

 $res= [];
 $hotmail_domains = array('hotmail.com', 'live.com', 'outlook.com', 'msn.com', 'outlook.co.id');
 $yahoo_domains = array('yahoo.com', 'ymail.com');
 $email = strtolower(trim($email));
 $get_domain  = explode('@',$email);
 $domain = $get_domain[1];
 if($domain == 'gmail.com'){
    if ( getmxrr ($domain, $MXHost))  
    {            
    } 
    $ConnectAddress = $MXHost[0]; 
 	  $data = dns_get_record($domain, DNS_MX);
    $jsonData = hostCheck($email);
    $arr["data"]["status"] = $jsonData;
    $arr["data"]["email"] = $email;
    $arr["data"]["smtp"] = $ConnectAddress;
    $arr["data"]["host"]=$data[0]['host'] ;
    $arr["data"]["class"]=$data[0]['class'] ;
    $arr["data"]["ttl"]=$data[0]['ttl'] ;
    $arr["data"]["type"]=$data[0]['type'] ;
    $arr["data"]["pri"]=$data[0]['pri'] ;
    $arr["data"]["target"]=$data[0]['target'] ;
    $arr["data"]["target"]=gethostbyname($data[0]['target']) ;
    return json_encode($arr);
     
 } else 
 if(in_array($domain, $yahoo_domains)){
 	//get MX
    if ( getmxrr ($domain, $MXHost))  
    {            
    } 
    $ConnectAddress = $MXHost[0]; 
    $data = dns_get_record($domain, DNS_MX);
    $ve = new yahooCheck($email, 'dhendik@algostudio.net');
    if($ve->verify()){
      $arr["data"]["status"] = 'valid';
      $arr["data"]["email"] = $email;
      $arr["data"]["smtp"] = $ConnectAddress;
      $arr["data"]["host"]=$data[0]['host'] ;
      $arr["data"]["class"]=$data[0]['class'] ;
      $arr["data"]["ttl"]=$data[0]['ttl'] ;
      $arr["data"]["type"]=$data[0]['type'] ;
      $arr["data"]["pri"]=$data[0]['pri'] ;
      $arr["data"]["target"]=$data[0]['target'] ;
      $arr["data"]["target"]=gethostbyname($data[0]['target']) ;
    } else {
      $arr["data"]["status"] = 'invalid';
      $arr["data"]["email"] = $email;
      $arr["data"]["smtp"] = $ConnectAddress;
      $arr["data"]["host"]=$data[0]['host'] ;
      $arr["data"]["class"]=$data[0]['class'] ;
      $arr["data"]["ttl"]=$data[0]['ttl'] ;
      $arr["data"]["type"]=$data[0]['type'] ;
      $arr["data"]["pri"]=$data[0]['pri'] ;
      $arr["data"]["target"]=$data[0]['target'] ;
      $arr["data"]["target"]=gethostbyname($data[0]['target']) ;
    }
    return json_encode($arr);
    
 } else 
 if(in_array($domain, $hotmail_domains)){
 	//get MX
   	if ( getmxrr ($domain, $MXHost))  
      {            
      } 
    $ConnectAddress = $MXHost[0]; 
    $data = dns_get_record($domain, DNS_MX);
    $status = liveCheck($email);
    $arr["data"]["status"] = $status;
    $arr["data"]["email"] = $email;
    $arr["data"]["smtp"] = $ConnectAddress;
    $arr["data"]["host"]=$data[0]['host'] ;
    $arr["data"]["class"]=$data[0]['class'] ;
    $arr["data"]["ttl"]=$data[0]['ttl'] ;
    $arr["data"]["type"]=$data[0]['type'] ;
    $arr["data"]["pri"]=$data[0]['pri'] ;
    $arr["data"]["target"]=$data[0]['target'] ;
    $arr["data"]["target"]=gethostbyname($data[0]['target']) ;
    return json_encode($arr);;
 } else {
 	  //get MX
   	if(mxrecordValidate($domain)){
   		if ( getmxrr ($domain, $MXHost))  
          {            
          } 
          $ConnectAddress = $MXHost[0]; 
          $data = dns_get_record($domain, DNS_MX);
          // check disposable
          $dis = DB::select("select * from disposable where domain like '".$domain."'");
          if(isset($dis[0]->domain)){
            $arr["data"]["status"] = 'disposable';
          } else {
              // check mxhosted
            $jsonData = hostCheck($email);
            if($jsonData == 'valid'){
                $otheremail = 'other'.$email;
                $jsonData = hostCheck($otheremail);
                if($jsonData == 'invalid'){
                  $arr["data"]["status"] = 'valid';
                } else {
                  $status = liveCheck($email);
                  $arr["data"]["status"] = $status;
                   
                }
            } else {
              $arr["data"]["status"] = 'invalid';
            }
          }

          $arr["data"]["email"] = $email;
          $arr["data"]["smtp"] = $ConnectAddress;
          $arr["data"]["host"]=$data[0]['host'] ;
          $arr["data"]["class"]=$data[0]['class'] ;
          $arr["data"]["ttl"]=$data[0]['ttl'] ;
          $arr["data"]["type"]=$data[0]['type'] ;
          $arr["data"]["pri"]=$data[0]['pri'] ;
          $arr["data"]["target"]=$data[0]['target'] ;
          $arr["data"]["target"]=gethostbyname($data[0]['target']) ;
          return json_encode($arr);
   		
   	} else {
          $arr["data"]["status"] = 'invalid';
          $arr["data"]["email"] = $email;
          $arr["data"]["smtp"] = false;
          $arr["data"]["host"]=false;
          $arr["data"]["class"]=false;
          $arr["data"]["ttl"]=false;
          $arr["data"]["type"]=false;
          $arr["data"]["pri"]=false;
          $arr["data"]["target"]=false;
          $arr["data"]["target"]=false;
          return json_encode($arr);
   	}
 }
}
?>