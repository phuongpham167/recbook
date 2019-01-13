<?php
if (isset($_POST["dir"]) && isset($_POST["fileName"]) && isset($_POST["destination"])) {
    $projectDir  = "../" . $_POST["dir"];
    $filename = $_POST["fileName"];
    $destination = $_POST["destination"];

    $filePath = $projectDir . "novi/media/" . $filename;
    if (!file_exists($filePath)){
      echo -1;
      exit();
    }

    if (!file_exists($projectDir . $destination)) {
        mkdir($projectDir . $destination, 0777, true);
    }

    $filePath = $projectDir . "novi/media/" . $filename;
    $destFile = $projectDir . $destination . $filename;
    if (!file_exists($destFile) || filesize($filePath) !== filesize($destFile)) {
        copy($filePath, $destFile);
    }
    echo $destination . $filename;
}