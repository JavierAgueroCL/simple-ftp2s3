<?php
if (!class_exists('S3')) require_once 'S3.php';

if (!defined('awsAccessKey')) define('awsAccessKey', '');
if (!defined('awsSecretKey')) define('awsSecretKey', '');

$bucketName = '';
$s3 = new S3(awsAccessKey, awsSecretKey);
$ruta = "../../wp-content/cache/minify/";
$destino = "wp-content/cache/minify/";

if ($handle = opendir($ruta)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {

					if ($s3->putObjectFile($ruta . $entry, $bucketName , $destino . baseName($entry), S3::ACL_PUBLIC_READ)) {
						echo "Se subió {$bucketName}/".baseName($entry).PHP_EOL."\n";
					}
					else {
						echo "No se logró subir\n";
					}


        }
    }
    closedir($handle);
}
?>
