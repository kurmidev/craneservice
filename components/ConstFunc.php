<?php

namespace app\components;
use kartik\mpdf\Pdf;


class ConstFunc
{

    public static function getLabels($label, $values)
    {
        return !empty($label[$values]) ? $label[$values] : null;
    }

    public static function calculateTax($amount,$percentage){
        return ($amount*$percentage)/100;
    }

    public static function printPdf($content,$filename){
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@webroot/css/print.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>[$filename], 
            ]
        ]);
        return $pdf->render();
    }

    public static function getFY($date){
        return date("m",strtotime($date))>3?date("Y")."-".(date("Y")+1):(date("Y")-1)."-".date("Y");
    }

}
