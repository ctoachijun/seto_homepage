<?
ini_set("allow_url_fopen",1);
include "../lib/simple_html_dom.php";

$html = file_get_html("https://www.wadiz.kr/web/campaign/detail/214636");

$a = $html->plaintext;
var_dump($a);


?>
