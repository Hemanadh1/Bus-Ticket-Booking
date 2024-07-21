<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Create an instance of Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Enable remote content if needed
$dompdf = new Dompdf($options);

// HTML content to be converted to PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>PDF Document</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: green; }
    </style>
</head>
<body>
    <h1>Hello, World!</h1>
    <p>This is a PDF document generated using Dompdf.</p>
</body>
</html>
';

// Load HTML content
$dompdf->loadHtml($html);

// (Optional) Set up the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('document.pdf', array('Attachment' => 0)); // 0 to open in browser, 1 to download

// If you want to save the file instead of displaying it, use:
// file_put_contents('path/to/save/document.pdf', $dompdf->output());
?>
