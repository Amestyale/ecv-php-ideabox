<?php

function view($name, $title, $data = [])
{
    extract($data);
    include "./views/$name.view.php";
    include './ressources/template.php';
}

function has_errors()
{
    return (isset($_SESSION["errors"]) && count($_SESSION["errors"]) > 0);
}

function get_errors($key)
{
    if(!isset($_SESSION["errors"]) || !isset($_SESSION["errors"][$key]) ) return [];
    else return $_SESSION["errors"][$key];
}

function add_error($key, $value)
{
    if(!isset($_SESSION["errors"])) $_SESSION["errors"] = [];
    if(!isset($_SESSION["errors"][$key])) $_SESSION["errors"][$key] = [];
    $_SESSION["errors"][$key][] = $value;
}

function reset_errors()
{
    $_SESSION["errors"] = [];
}

function generate_errors($key)
{
    foreach (get_errors($key) as $value) {
        echo "<p>".ERRORS[$key][$value]."</p>";
    }
}

function to_slug($string)
{
    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
    $string = preg_replace('/[^A-Za-z0-9-]+/', '-', strtr( $string, $unwanted_array));
    return strtolower($string);
}

function upload_file($folder, $name, $file)
{
    
    if(!file_exists("./public/uploads/$folder/")) mkdir("./public/uploads/$folder/", 0777, true);
    $info = pathinfo($file["name"]);
    $tmp_name = $file["tmp_name"];
    $name = $name.'.'.$info['extension'];
    move_uploaded_file($tmp_name, "./public/uploads/$folder/$name");
    return $name;
}

function error_404(){
    echo '404, not found';
    die;
}