<?

include 'functions.php';
$settings = parse_ini_file("settings.ini");

echo '<pre>';
print_r(tba_get('event/2015ctwat/teams'));
echo '</pre>';
?>