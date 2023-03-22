<?php

class Pdf_Exporter
{

    private $dompdf;

    function output_pdf ($html, $output_file = '', $orientation = 'portrait')
    {
        $dompdf = require_once realpath(APPPATH) . '/libraries/dompdf/dompdf_config.inc.php';
        
        if ($dompdf) {
            $dompdf->load_html($html);
            $dompdf->set_paper('letter', $orientation);
            $dompdf->render();
            $dompdf->stream($output_file);
        }        
    }
}

/**
 * End of file
 * 
 */