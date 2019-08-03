
<?php
class pdf
{

    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';


            $param = "'','', 0, '', 0, 0, 0, 0, 0, 0";

        return new mPDF($param);
    }
}
?>

