<?php
class APP {
  public $time;
  public $scope;
  public $status;
  /*
   * CONSTRUCTOR
   * @params slim instance, scope
  */
  public function __construct($scope = NULL) {

    $this->scope = $scope;
    $this->time = time();
    $this->status = 200;
  }

  public function __destruct() { }
  
  public function _cleanINT($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[0-9]+$/' : '/^[0-9]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlpha($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z]+$/' : '/^[a-zA-Z]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlphaNumeric($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z0-9]+$/' : '/^[a-zA-Z0-9]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanINTSpace($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[0-9/s]+$/' : '/^[0-9/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlphaSpace($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z/s]+$/' : '/^[a-zA-Z/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlphaNumericSpace($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z0-9/s]+$/' : '/^[a-zA-Z0-9/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanURL($data, $length = FALSE) {
    return filter_var($data, FILTER_SANITIZE_URL);
  }
  
  public function _cleanEMAIL($data, $length = FALSE) {
    return filter_var($data, FILTER_SANITIZE_EMAIL);
  }

  public function _cleanString($data, $length = FALSE) {
    return filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  }
  
  public function _rand($value) {
    $buffer = ($value & 1) ? mt_rand(0,100) : '';
    $value = floor($value / 2);   
    $bytes = openssl_random_pseudo_bytes($value, $cstrong); 
    return bin2hex($bytes) . $buffer;
  }
  public function _getIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else 
      $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
  }
  public function _getBrowser() { 
    $u_agent  = $_SERVER['HTTP_USER_AGENT'];
    $bname    = 'Unknown';
    $platform = 'Unknown';
    $version  = "";
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    $ub = "Unknown Browser";

    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub    = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub    = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub    = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub    = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub    = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub    = "Netscape";
    }
    $known   = array('Version',$ub,'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    $i = count($matches['browser']);
    if ($i != 1) {
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }
    if ($version == null || $version == "") {
        $version = "?";
    }
    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
  }
  public function _mouldData($data, $status = 200) {
    $this->status = $status;
    return array(
              "status" => $status,
              "scope" => $this->scope,
              "timestamp" => $this->time,
              "data" => $data
            );
  }
  public function _setStreamTEXT($data, $status = null) {
    $status = (is_null($status)) ? $this->status : $status;
    $this->_response->headers->set('Content-Type', 'Content-Type: text/plain');
    $this->_response->setStatus($status);
    $this->_response->write($data);
  }

  public function _setStreamHTML($data, $status = null) {
    $status = (is_null($status)) ? $this->status : $status;
    $this->_response->headers->set('Content-Type', 'Content-Type: text/html');
    $this->_response->setStatus($status);
    $this->_response->write($data);
  }
  public function _setStreamJS($data, $status = null) {
    $status = (is_null($status)) ? $this->status : $status;
    $this->_response->headers->set('Content-Type', 'application/javascript');
    $this->_response->setStatus($status);
    $this->_response->write($data);
  }

  public function utf8ize($d) {
      if (is_array($d)) {
          foreach ($d as $k => $v) {
              $d[$k] = $this->utf8ize($v);
          }
      } else if (is_string ($d)) {
          return utf8_encode($d);
      }
      return $d;
  }

  public function _setStreamJSON($data, $status = null) {
    $status = (is_null($status)) ? $this->status : $status;
    $this->_response->headers->set('Content-Type', 'application/json');
    $this->_response->setStatus($status);
    $this->_response->write(json_encode($this->utf8ize($data)));
  }
}