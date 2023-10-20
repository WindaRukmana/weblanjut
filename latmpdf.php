<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$dpdf = new Dompdf();
$html = '<ol><li>satu</li></ol>';
$dpdf->loadHtml($html);
$dpdf->render();
$dpdf->stream("test.pdf",array("Attachment"=>FALSE));
?>