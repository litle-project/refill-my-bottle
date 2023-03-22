<?php

class Excel_Exporter
{

    var $excel_object;

    function __construct ()
    {
        require_once realpath(APPPATH) . '/libraries/PHPExcel/PHPExcel.php';
        
        $this->excel_object = new PHPExcel();
    }

    function get_excel_object ()
    {
        return $this->excel_object;
    }

    function export_excel ($excel_object, $output_file)
    {
        require_once realpath(APPPATH) . '/libraries/PHPExcel/PHPExcel/Writer/Excel2007.php';
        
        $excel_writer = new PHPExcel_Writer_Excel2007($excel_object);
        
        return $excel_writer->save($output_file);
    }
}

/**
 * End of file
 * 
 */