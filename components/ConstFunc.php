<?php

namespace app\components;

use kartik\mpdf\Pdf;
use Yii;
use yii2tech\csvgrid\CsvGrid;


class ConstFunc
{

    public static function getLabels($label, $values)
    {
        return !empty($label[$values]) ? $label[$values] : null;
    }

    public static function calculateTax($amount, $percentage)
    {
        return ($amount * $percentage) / 100;
    }

    public static function printPdf($content, $filename)
    {
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
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => 'body{font-size:10px;} .kv-heading-1{font-size:18px} .page-break{ page-break-after:always; } li { list-style:none; }',
            // any css to be embedded if required
            // set mPDF properties on the fly
            'options' => ['title' => $filename],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [$filename],
            ]
        ]);
        return $pdf->render();
    }

    public static function getFY($date)
    {
        return date("m", strtotime($date)) > 3 ? date("Y") . "-" . (date("Y") + 1) : (date("Y") - 1) . "-" . date("Y");
    }

    public static function printCsv($dataProvider, $gridColumns, $filename)
    {
        $exporter = new CsvGrid([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ]);
        return $exporter->export()->send($filename.".csv");
    }

    public static function is_export(){
        $is_pdf = Yii::$app->request->get('is_pdf');
        $is_csv = Yii::$app->request->get('is_csv');
        return $is_csv || $is_pdf;
    }
}
