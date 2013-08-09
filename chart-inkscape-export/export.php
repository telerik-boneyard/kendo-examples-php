<?php
    $svgParam = "svg";
    $formatParam = "format";
    $exportRoot = __DIR__;
    $exportCmd = '/usr/bin/inkscape --file "%s" --export-%s "%s" --export-width 800 --export-height 600';
    $mimeTypes = array("png" => "image/png", "pdf" => "application/pdf");

    $svg = urldecode($_POST[$svgParam]);

    if (isset($svg))
    {
        $tempName = tempnam($exportRoot, 'svg');
        file_put_contents($tempName, $svg);

        $format = $_POST[$formatParam] ?: "png";
        $outFile = $tempName . '.' . $format;
        $cmd = sprintf($exportCmd, $tempName, $format, $outFile);

        exec($cmd);

        $outPathInfo = pathinfo($outFile);

        header('Content-type: ' . $mimeTypes[$format]);
        header('Content-Disposition: attachment; filename="' . $outPathInfo['filename'] . '"');
        readfile($outFile);
    }
?>
