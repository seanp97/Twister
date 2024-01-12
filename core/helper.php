<?php

function base_url(){
    return sprintf(
      "%s://%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME'],
      $_SERVER['REQUEST_URI']
    );
}

function inc_header() {
    include_once "./base/header.php";
}

function inc_footer() {
    include_once "./base/footer.php";
}

function inc_ctrlr($controller) {
    if(empty($controller) || !$controller) die('No controller name passed in');

    try {
        
        if(!str_contains($controller, '.php')) {
            if(!str_contains($controller, 'Controller')) {
                include_once "../../{$controller}Controller.php";
            }
            else {
                include_once "../../{$controller}.php";
            }
        }
        else {
            if(!str_contains($controller, 'Controller')) {
                include_once "../../{$controller}Controller";
            }
            else {
                include_once "../../$controller";
            }
        }
    }
    catch(Exception $e) {
        echo "Unable to load controller";
    }

}

function LoadPartial($name) {
    if(!$name || empty($name)) die('No valid partial supplied');

    try {
        if(str_contains($name, '.php')) {
            include_once "./partials/$name";
        }
        else {
            include_once "./partials/$name.php";
        }
        
    }
    catch(Exception $e) {
        die('Error loading partial');
    }
}

function JSONShow($query) {

    try {
        header('Content-Type: application/json');

        $arr = array();

        if($query) {
            foreach ($query as $a) {
                array_push($arr, $a);
            } 

            echo json_encode($arr, JSON_PRETTY_PRINT);
        }
    }

    catch(Exception $e) {
        throw new Exception($e);
    }

}

function Status200() {
    header("HTTP/1.0 200 OK");
}

function Status204() {
    header("HTTP/1.0 204 No Content");
}

function Status301() {
    header("HTTP/1.0 301 Permanent Redirect");
}

function Status302() {
    header("HTTP/1.0 302 Temporary Redirect");
}

function Status400() {
    header("HTTP/1.0 400 Bad Request");
}

function Status401() {
    header("HTTP/1.0 401 Unauthorized Error");
}

function Status403() {
    header("HTTP/1.0 403 Forbidden");
}

function Status404() {
    header("HTTP/1.0 404 Not Found");
}

function Status405() {
    header("HTTP/1.0 405 Method Not Allowed");
}

function Status408() {
    header("HTTP/1.0 408 Request Timeout");
}

function Status429() {
    header("HTTP/1.0 429 Too Many Requests");
}

function Status500() {
    header("HTTP/1.0 500 Internal Server Error");
}

function Status($code, $message) {
    header("HTTP/1.0 $code $message");
}

function dd()
{
    foreach (func_get_args() as $x) {
        var_dump($x);
    }
    die;
}

function GetSession($variable) {
    return $_SESSION[$variable];
}

function SetSession($variable, $value) {
    $_SESSION[$variable] = $value;
}

function GetCookie($cookie) {

    try {
        if(isset($_COOKIE[$cookie])) {
            return $_COOKIE[$cookie];
        } 
        else {
            return "No Cookie set.";
        }
    }
    catch(Exception $e) {
        throw new Exception($e); 
    }

} 

function QueryString($param) {

    try {
        if(isset($_GET[$param])) {
            return $_GET[$param];
        }
    }
    catch(Exception $e) {
        throw new Exception("No parameters set. " . $e);
    }
}

function Title($title) {
    echo "<script type='text/javascript'>document.title = '{$title}'</script>";
}

function GetJSON($url) {
    try {
        $jsonUrl = $url;
        $json = file_get_contents($jsonUrl);
        $data = json_decode($json, TRUE);
        return $data;
    }
    catch(Exception $e) {
        throw new Exception($e);
    }
}

function ValidEmail($email) {
    try {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
    catch(Exception $e) {
        echo $e;
    }
}

function Redirect($url) {
    try {
        header("Location: " . $url);
        die();
    }
    catch(Exception $e) {
        echo $e;
    }
}

function PostValue($val) {
    try {
        if(isset($_POST[$val])) {
            return $_POST[$val];
        }
        else {
            return "value not set";
        }
    }
    catch(Exception $e) {
        echo $e;
    }
}