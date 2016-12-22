<?php
header('Content-Type: application/json');

// $_SERVER["DOCUMENT_ROOT"]
$file_server_path = realpath(__FILE__);
$server_path = str_replace(basename(__FILE__), "", $file_server_path);
$upload_dir = $server_path . "files";
//echo $upload_dir;

if (!$dh = @opendir($upload_dir)) {
    return false;
}

echo "[";
$seq = 0;
while (($file = readdir($dh)) !== false) {
    if ($file == "." || $file == "..") continue; // . 과 .. 디렉토리는 무시
    if ($seq > 0) echo(",");

    echo '{
        "name": "' . ($file) . '",
        "saveName": "' . ($file) . '",
        "type": "' . filetype($upload_dir . "/" . $file) . '",
        "fileSize": "' . filesize($upload_dir . "/" . $file) . '",
        "uploadedPath": "//",
        "thumbUrl": "//"
    }';

    $seq++;
}
echo "]";

closedir($dh);

?>