<?php
function format_filename($filename)
{
    $filename=preg_replace('/[0-9:\\\*?"<>\/|\- ]+/','_',$filename);
    $patterns = ["ÁÀÂÄ" => "A", "áàäâª" => "a", "ÉÈÊË" => "E", "éèëê" => "e", "ÍÌÏÎ" => "I", "íìïî" => "i", "ÓÒÖÔ" => "O", "óòöô" => "o",  "ÚÙÛÜ" => "U",  "úùüû" => "u", "Ñ" => "N", "ñ" => "n", "Ç" => "C", "ç" => "c"];
    foreach ($patterns as $pattern => $replace) {
        foreach(preg_split('//u',$pattern, -1, PREG_SPLIT_NO_EMPTY) as $char){
            $filename = str_replace($char, $replace, $filename);
        }
    }
    return $filename;
}
