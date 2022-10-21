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
    private $_yahoo_signup_ajax_url = 'https://login.yahoo.com/account/module/create?validateField=userId';
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
      $this->fetch_page('yahoo');

      $cookies = $this->get_cookies();
      $fields = $this->get_fields();

      $yid = explode('@', strtolower($this->email));
      $domain = explode('.',strtolower($yid[1]));
      $fields['UserId'] = $yid[0];
      $fields['Domain'] = $domain[0];

      $response = $this->request_validation('yahoo', $cookies, $fields);
      $response_errors = json_decode($response, true);
      $res_err = $response_errors["errors"];
      foreach($res_err as $err){
        
        if($err['name'] == 'userId' && $err['error'] == 'IDENTIFIER_EXISTS'){
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
      $headers[] = 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1';
      $headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
      $headers[] = 'Accept: */*';
      $headers[] = 'accept-encoding: gzip, deflate, br';
      $headers[] = 'Referer: https://login.yahoo.com/';
      $headers[] = 'Accept-Encoding: gzip, deflate, br';
      $headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7,ms;q=0.6';
      $headers[] = 'dnt: 1';
      $headers[] = 'sec-fetch-dest: empty';
      $headers[] = 'sec-fetch-mode: cors';
      $headers[] = 'sec-fetch-site: same-origin';
      $headers[] = 'validateField: userId';

    
      $cookies_str = implode(' ', $cookies);
      $headers[] = 'Cookie: A3=d=AQABBHMdwWICEJm3uZdijYE3KHFDvA9dNa8FEgEBAQFuwmLLYgAAAAAA_eMAAA&S=AQAAAt7_EnSZ_X9eVR2KY6dPtZ4; A1=d=AQABBHMdwWICEJm3uZdijYE3KHFDvA9dNa8FEgEBAQFuwmLLYgAAAAAA_eMAAA&S=AQAAAt7_EnSZ_X9eVR2KY6dPtZ4; A1S=d=AQABBHMdwWICEJm3uZdijYE3KHFDvA9dNa8FEgEBAQFuwmLLYgAAAAAA_eMAAA&S=AQAAAt7_EnSZ_X9eVR2KY6dPtZ4&j=WORLD; AS=v=1&s=0EahZYcs&d=A630ef2e0|YC3_bRn.2TrotD44MtrGPclMYluGntVJRV_pxlgTYZiBzFb8ZziApd2HtLL_VxerIv8g1BaYssgR5AL87ZmTnjfjcxG_g9jN8Zvl0yN2F51CIk1CooD1_Ya9aE6O0fSRfswapMQ.XFLJA4Zx0s055dtKcG8pIJiP4rAINW.L2USbLQcI8.aPdE01HEm8tK3lp0hcjVoKPJdMKi0CxVS3YOPVSd0hDqPbWDO5SPd6JNyxibzk6uPBGvPEiObaawUt3Aq8XG9dZi5uD0_lQZE6MUOrtMTeMWSkfdKs.x3VDYo0v3tIXNfMIQ7PNKy_To6iBtqg0myAlciHdOrJ8xq3bJLia8y0mVb3d4SXWWJqcShh.Dk6.D0SvI.S13cHiUkRLwUG6ZZ0v40Tl6gKMQlrAJA0AH1TtASVHNyqEduV5j93.8N3GpdnkDLcRcRhAbS4kZdusHOt_N2KgKKE7faUpAV0qSv_mcxJ64sEVU6.MP39bbGY4yO06us6jhqC4oDu5ytvJzqTNLwLGirnPBwDzHzdGCNy6zzCA7sAZRVGGyom_Zh_poSP2SWSSz.xZNIX87D_BAxZouQnQ2DRa5toxaoWae0WMQ7UfBKuvdvb7V0cW_4k8Olcvm45ODYmib9YiHZpyF.7uc.BlWxW96rqkZavTj1IjOUjGj93HrFnaodZmI8HygWssDfvuMdnQaCEJ8BwTqDcaN8vznHPP1tXcTr.e966P4lx2brmb4.w8AQa6vXmYqiO6o27TA4JCbgoKhff0Ei8ETLNE5I5X5r9sPbTn2KUkn_Pwefai1sgj_nJ4sbsLEKw2GYjhayB2t4_ah9KZpPqN6gzN6PlHEfh8BC8izvj47oIP_0vuRHoVj3.ddOv1yFcz_FqUto_NH8s5FsfhGjFTCo1GSHW1HFfkssHtG5yEPOWZK4AFCFGOxy9yltNmUUGyfegkNbNKM4.qPke9TM-~A';
      // $headers[] = 'Cookie:'.$cookies_str;


      // $postdata = http_build_query($fields);
      $postdata = 'browser-fp-data=%7B%22language%22%3A%22id-ID%22%2C%22colorDepth%22%3A30%2C%22deviceMemory%22%3A8%2C%22pixelRatio%22%3A2%2C%22hardwareConcurrency%22%3A8%2C%22timezoneOffset%22%3A-420%2C%22timezone%22%3A%22Asia%2FJakarta%22%2C%22sessionStorage%22%3A1%2C%22localStorage%22%3A1%2C%22indexedDb%22%3A1%2C%22openDatabase%22%3A1%2C%22cpuClass%22%3A%22unknown%22%2C%22platform%22%3A%22MacIntel%22%2C%22doNotTrack%22%3A%221%22%2C%22plugins%22%3A%7B%22count%22%3A0%2C%22hash%22%3A%2224700f9f1986800ab4fcc880530dd0ed%22%7D%2C%22canvas%22%3A%22canvas%20winding%3Ayes~canvas%22%2C%22webgl%22%3A1%2C%22webglVendorAndRenderer%22%3A%22Google%20Inc.%20(Apple)~ANGLE%20(Apple%2C%20Apple%20M1%2C%20OpenGL%204.1)%22%2C%22adBlock%22%3A0%2C%22hasLiedLanguages%22%3A0%2C%22hasLiedResolution%22%3A0%2C%22hasLiedOs%22%3A0%2C%22hasLiedBrowser%22%3A1%2C%22touchSupport%22%3A%7B%22points%22%3A1%2C%22event%22%3A1%2C%22start%22%3A1%7D%2C%22fonts%22%3A%7B%22count%22%3A27%2C%22hash%22%3A%22d52a1516cfb5f1c2d8a427c14bc3645f%22%7D%2C%22audio%22%3A%22124.04344968475198%22%2C%22resolution%22%3A%7B%22w%22%3A%22375%22%2C%22h%22%3A%22667%22%7D%2C%22availableResolution%22%3A%7B%22w%22%3A%22667%22%2C%22h%22%3A%22375%22%7D%2C%22ts%22%3A%7B%22serve%22%3A1661837672142%2C%22render%22%3A1661837672351%7D%7D&specId=yidregsimplified&cacheStored=&crumb=kd9nGNZz2uH&acrumb=0EahZYcs&done=https%3A%2F%2Fwww.yahoo.com&googleIdToken=&authCode=&attrSetIndex=0&specData=jRROGrR9wQTO8e6iGfV3ADVLLqKZJKvX5DoV5kTfVXQtl10g442FLitwk%2FmxiqxR13nS%2F17ftcA8r5H7lbnnqC2KLDRyTV7hz5S7z7kTZu18pHYP6yEmTe%2BlgbXyGRv%2BpnhEwZM8uICvkX%2BUa47No8kKvTmndRT4cWusT%2B9kBx8pNr3Osz7Bubh%2FhHN2tXrY3uWPL6m8ZZnSuCHUBf0QV%2BQM%2BP8LOpduN%2F0TBHg3%2BjShCooHPwsgoiCjCB0jqupFWDCTuXDakis9bMfsP%2FGMDeSBREv43MFjMGhdXF0bn65Jy3s73zCru%2BlyhSNOjJskk%2FPY5i%2B%2FTDANKwUYJ4wHcx%2FHZUwPvpdLBVwubTXW3FTlaE5DfKtKvMGDjrzJizf0Rk7R53magEoTbD8HaB2fB8G0V07XBSsTbk48iph5Ih8IZWpjMykQAd8IgX6S0Gl7CRpO7vmqsZyb0PlF2vuoQKfhSDf%2Ffy4ESD7VAxmfjiS2J7MJJHQKD6Kz%2BZPLvwOMCffMcUoge05b%2FWsY7tp0%2Fke3FLCjB7PSdjUWcXSza9Hp0OounpfQvFcJtcSLcPoRJISB6aQTI%2FfnxbDsPyoy95Y4wN3eafFkEJpth15gcMKFLZHFFkK2SEkR9Tb19aBcm0m90jjQjTNEL7kfRLtVLnqz%2BHYo%2BvJLad304tGGUupW4Y3YdzcRHMsR%2B%2FcPa2MKlJh8vqnxVgIcJmC6aivVrKNqHtd3ItB7%2FdQFfpa37on8Y%2FT84D8bDCUt2ZT7IlZwNW4NxVZZUq7PV4R50fLtk5WO8WT6ZCvMsBUJ%2BgALg%2FAJ0S8FN2vtOM0wiVxFj5ReRANQaJaLfvkFCcrHpCZ%2BY4g5lzreQmcnTvo4Mq6oaD3Y5b0%2FLOJab%2Bfhvn0F0tUXjCr%2Fk2wLZ%2B06L%2BuunxuEcwu3shhMszC3YND2odoJhh8e3fOBKGO%2Bda4QK%2BIcjECAqJ2BOne2rAPMuazKrtp7lh7M81nA7uwlTfMXmdWfySLXG%2FA0A4nSKDNsPR2YR9AZF5Dd7GG3YCg%2FTrTQhzkmoVxny5qq%2BE91anPawGQjAef8YK%2Fi9SntClsdjpGH4y6%2BatwH1YeRBJjbX8GzZ6Fj3ZLDQixiitPXs1oW7kPn8ejKMGumgTNZYlPI%2FCCunHOVznDMVu69R8Me7RZkqByPq0uRzGSwcH%2FuXMmlyxkhBikt8A098uvWch%2BGdiTawYXBW5za7Hb%2Fh63M6Q1RPshuPm1zm%2BgoIO9teTJz9oGRaO0vgm4C%2B2aBxtMwA%2BwqAPVkvTxI8jq%2F7ZgfSSntHnQKBAYXGC4SUhbK6qZXtz3zZfmvWd93tK75ex5bWhVKETNgtEvhrzAtHVvW4RPpYti516iv2YDvFEFsbt4kqZC7tz3UPmxRQ0HDz3LPOO6Jj%2BE5o8X%2B4OMGzEC1VLw7gGbd8QLXSJJWomat4NcAyc%2FKuF8Vz6nkLjLIrTibMYUKIeBffVlmqAqy%2FE7by5YuCchxyItM3vkos8wzkzwHQ0WCRXmx%2Ffsjjhap3UiFeB8cH68bWEnGK3lH4ekna9Sp2A1sWU243tL3trWFVwrGJ8aRCz2fk8dQ57azAsAXxEmMeYLL1NXdLShHx3lZLc4OUL7R7pa5GgMzUyNbKv9f2WGS9oXiUnutt81mrb3eN7huEEZuQKAez7l9R72ojo1l1bP0Jn3R8vorExrdJMWpgDkPHu7GZvIhbUc21xu6TggvHJpyN%2Foo5WJQEa0cZL40Sk2IewQ%2BacqH1dD3EiRWe5Hdmy6lTha%2FnUV47rGAt8FWvHQiEmKj4ezmg%2BNUDqhaxgQfT8GtlBjkwXQg1XOSz5m1rh4SyiWZKNa81uC%2FsMrUDY38oI9jbVZ46aJ9TRnuDxs0Z23vMv%2BJimeHNZkUBy0c5s2PGlhSeTFFbBQ6mDtw9vXCWbv4RD2nwCAtS0fXBOvvlnz%2BfRGiyykzTgNIpiDgxEzG3%2BRYIa8k%2Bn9IibqHaBbl4J8zWFgWbLfuhTGnitmwj0YiNYL%2BhiGHXlvN0Zb6p%2FmANJDB3n10xzCvWmWvMj5mdYGq1ks%2F0ajwW3lo61%2Bo4zjpgpkhHB%2BOyqUWR7i4bRE5mjjzMzja4281G4FkaIrtq4zRHp%2FiQncMH5VgVHxlQbxOlhSb4ZnnYMTqXBEbL1aLeWow%2BFCrXv8dKhgCozpwDUDyDkDz%2FrfxEExJfF5leYnBuTKvR4LpzBReefeBkNNebmKwzGW%2BGiCSdgkUmPrAeCGijceZZgyjuMCUmiDRXcYa7lpmwzEcsEA%2BMmB%2FqmLpaNbC4SkVAgO8Q9jDETJ3QTNg9fo8HXcTAkbUR2rDr8vNDtVd4fpP0H7VP8YKh%2Brnnr7y0S8HNs8GLLbyJCuirUWDnYYkn8b2VXweEjts5YALW5tHeQyKZZuEmOk5P1m3a2lwB7DVgUdB8D7pledxsWCYLV8HzkLDJh3NNT3QjrLun61OJ70j8azkHbn200utHTIL828HjisOu0hdHr8YMkOznT%2BzAYNXRqHmP5VQBFAUY37BR6QpnCOtgooMbbDJFggO222vtYXWrmQ8O%2FHcq%2BPqnsOLIGQKpk2EtxGxcHqmFV88TCjoQt2aahIrWkHlQC9qR%2FuS7AOoxl1rLOdm47suVObeOJdaLrKjxwRjmPldy33%2FCRl7uWykLAivKVeUU7cypfzIJz4JiZLmZZFdTpPw8JSbDe0LdniA4Zai2D5I0tk3IDRT9YFeZZ9Chv%2FGOtEZMvYSedwLUS%2FGW5QJbzIXwk21q5cmBg9m9WUyx3eUHfmEb6M3xkwN6stpfWUk9A4BnZ7ZMNzh6V34IQk9GusW%2BG%2F5FLVF09g0n3s3oottOcRDQHggj4SIvNgjNmL%2FIGSDDleYUdcNwxEpzq%2Bcmu2kQmA4KrZJVr0kKYdt68mreiOHORI%2BTvCIaamJpe5m%2FRnX2Me5hG%2BPPwOfpBHsmPn7GxUweV5nBWBAXzyj1T0vaEc0p7o6i5nEYjdOlJv%2BFOes1kpdh3WebrW7I%2Baf76bOawZIjslTQOBN6uuIFVsQ1figiv3jGzg%2BlXoxWTO3Moq83VkcrdusycEzaWH2pzOYOSb0Wos3kN51MXZTR1RFhUWW2ItKyOVPj2WbE68qfZIG9OB4iwsvE4ZuaF4jqnCNyPDnlxFP4a0T1SLZuYtS5QW7Yu1Ig9e%2FugzWZgRNK451m9ZNY%2FEyRVktArIKEjUqCQ8zAPjXE3eLkzO96JRBseDz8RYlTx025OvoillckXbT1%2B1PjI7YI3dwgKvEZz7f4CULPA0bXsoVTzszAWwfKRivv7KFouDlA6eqng70EtHykdy010N7IWfXrIh3SPtBFfNuXmMdtlh%2FV1YSf0XgGea5APhkeWVrzGbhF469aB6QGRuGbk2Cyzrh6ecklz4FNldoAnLEN7mzRHBwb2yUuood4x2xhkUA4fQk%2BGBL71xyCnr9nfRZjNcJNY%2B%2BQ%2BmMLLz0StmbqmWjXU7%2BgsvJ7E4zeGItrPpYtIm%2BRk4TxAu%2BvZXz0XywnPDew9EP8MPV2mTTypLfiSYRNdDEq750ozK4%2FJN8cwPaiT1rgvHJlZosO4C2ZPzlwvgDSSVgEbt4ucBZcnghKUyaoI%2FlB4ENXMNET4Hkbf%2BKyUl39WDiJwEZ2A1uXRlQitCrir6RiegJ3aChYkw%2B0v6lrcW0DHSjb1uQ0hFqUH7Wuo3debnil8Fmdl0s7mrSbd1Us5nEI%2F3HCZ1txxttKmxTGuI1dP3pwWBxtes75x9LTAC9mq4Ka%2B4LX5tSlKiV5a5tCiYVT4EUwTNppwkRLlPAlTYPEigGhVHApdjEz4%2FfuSiV%2BxV8EgFN32dGAYvD64qQU9b8LR2iVr4XffYmOzMeStMTWrRsIO4%2FnPDCbrxv3n7n7QwUHhjCYwvnOTL%2BxrfJXSx4Xc7%2BBrUj0%2BZJTVjl%2F06dJt8uj1s5%2BQiTQvSdesV8SUuV%2BRDisGENSsMUZYKiRTgAreF7IlOLxeuO8ScZ1HZBA4cY0GQuMG8QHQetFuRvzda6KtFIufF32W79zCnR9RXSw1%2FgMAMObYxIIiaUSBn5U7abP%2FJ3P8%2Bkj%2F4gTFDXzWeY6huaUw0i92WtQCncD9S93atKpG%2BUSnrSIYmcdaRU5ON7tEZAcb5pWN%2B7U3gpTvwWwnZ1%2BZ9O52Nbe2e3eGNTLfvT0R8ka46A04Kc1KBQAISs76Hbfi75RyKRvhsGx4UkYuDOdK1aNeMd%2FzIGxf%2FVRbOdyqgerMdObUfMxMsIb6S6F5gs%2FbF5zLSbFbG5OMbuc9BPSUpQZ2%2FvNQzjEqM1dWZUFdgKI9ZwOxPUPDd7MdPOVzp%2BxD8%2BVuBeg3CmOlPjJgu3yV8vHMIpiMfw5651Uj3yhzi6f8O2tN5lwk0EMjkCd7CPQufU0VPpj737kJW2iZkL5YkssGBUY5vmi2G%2F0xGYw%2FyVJZO4IPhtjthkEqkrGbsut7y9V%2FBtG0%2BywG3tcxJUPGqsT8zIah2VKh82G1Y2zWI5OV6kWzAoZRLlIEXaSyQHAmkHoeekHmK0fDtnHATtpVwjvOp9R%2F7aABEYU6wY%2BlXLTsvFbY5KULukzj2UDqlGv8XpL%2BURweX5JSD4E%2FKOxSqkCFm%2BI%2BiqwIWOZ2ueC3PiXrLgnD7Rp6JcGDdUXkKOQCwZewITDEPamTQJSh5kmf9d8iRY7%2FUoNygADp%2BzPcU0NnxKB5GtK83SqxwZfFPsiVT%2Fj57m9zTJaKL6AdMI%2F%2B69PWc141CyNdoF7DGjlWEZoEJVkyDjhLSLONO85ucN5SpClKlZAi83Lud5joIBuj21gRPcrvbOvBREHWcf%2BVXM6kz6x97UKKtqJNADWwtgkK%2FRdW0ZDTzlwaZWnmqkBXJxQwNBOclgGIYIR%2FIic1aYOWlj3gg3ARE6%2B1Y5UH678fNx3D7OHVDJVl%2FbLW23Ir6yxaxU5o81W%2FTxQnPughGGhb6tBgb3YIuaO2%2BXBq9BDCYANpPIrVZn6jyFl2OnehsqGT%2BmXI%2BnIKHZbBq2Ax2KWHShlJ%2FcKV6R%2B6Y8zPSaIBEQAy2VcSyAjAp1jC8O5UxxZVhIg8mipbCq8e97SzfIG6QLgD2igrNZEWcoyCW5iT4fxksO424Rkb%2BIZWgQnwTtt7NEeUVRZFd1vMk2wK0t%2BHZrZu0W40n2UeUVzsea7cSEEVvv4Zj%2FODaN7CxRKoEvc2BD8OL5KGjstmEaNYuVqeIwREEUb3VZtX2obGL71mdvmkDOMGgKYcgkhdTe4BfzMMsTZZE%2FzqMG3LPGfWfKwxpl03wOFDfOa4Pn%2FcWTqoeTIJ%2Fc3sE6%2FKh1H9QJ4TZc9%2BXrmThNhVX3UNzu8gp4tmEwRQ1jRQpTvJQpWSVSt6xuo4kFPmZ%2FC%2FTXR1ws1gSH1USuZkp0QCQS3a0gSoT9A2ND9Dvgz%2FvFE%2FgmUSg1jOPMyJe8FTzcZ2L92p3dfY3CNq%2B1JoBy5Jx86hJBlMtDET3eyfMaqH047gCM3%2BSq%2F0nvyJUTnxSbptC3ZzWZmajolr2m%2FvjQy%2BkrYFiwZuDj83%2BJHAPgyY7kKDJ8fdZVrdY%2Fy6DFn6F00PjpvMTw2s2ygx6XvRLwpKMq%7C9NSwRh3e7oGC05hW4ZL%2BzA%3D%3D%7C%2FRHocbR4BI0KnUvdBwUsmw%3D%3D&multiDomain=&tos0=oath_freereg%7Cid%7Cid-ID&firstName=acc'.rand().'&lastName=mail'.rand().'&userid-domain='.$fields["Domain"].'&userId='.$fields["UserId"].'&password=&birthYear=!&signup=';

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
 $hotmail_domains = array('hotmail', 'live', 'outlook', 'msn', 'outlook','bing');
 $yahoo_domains = array('yahoo', 'ymail','rocketmail');
 $email = strtolower(trim($email));
 $get_domain  = explode('@',$email);
 $domain = $get_domain[1];
 $pre_domain = explode('.',$domain);
 $check_domain = $pre_domain[0];
 if(!isset($pre_domain[1]) || !isset($get_domain[1])){
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
 } else
 if($check_domain == 'gmail'){
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
 if(in_array($check_domain, $yahoo_domains)){
 	//get MX
    if ( getmxrr ($domain, $MXHost))  
    {            
    } 
    if(!isset($MXHost[0])){
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
    } else {
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
    }
    
    return json_encode($arr);
    
 } else 
 if(in_array($check_domain, $hotmail_domains)){
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