<?php

class QRGenerator{

 public function generate($document, $code, $path, $size){
    
     include('phpqrcode/qrlib.php');
     
     
     // we need to generate filename somehow,
     // with md5 or with database ID used to obtains $codeContents...
     $fileName = "qr_".$document.'.png';
     
     $pngAbsoluteFilePath = $path.$fileName;
     
     // generating
     if (file_exists($pngAbsoluteFilePath)) {
         unlink($pngAbsoluteFilePath);
     }
         QRcode::png($code, $pngAbsoluteFilePath, 0, $size, 1);
    
     
     return $fileName;
 
 } 

}

?>