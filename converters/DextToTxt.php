<?php

require_once 'AbsConverter.php';

/**
 * Dext to Txt converter
 */
class DextToTxt extends AbsConverter {
    /** 
     * Convert given file and store the result in protected param result (Dext to Txt)
     * 
     * @param string $fileName
     */
    protected function convert(string $fileName) {
        $xmlString = file_get_contents($fileName);

        // printing header
        $bodyStart = strpos($xmlString, '<body>');
        $header = substr($xmlString, 0, $bodyStart-5);
    
        $this->result.= $header."</detx>".PHP_EOL;
    
        // Charging XML and storing the XML file
        $xml = new SimpleXMLElement($xmlString);
        $body = $xml->body;
    
        // Initialisating result array
        // $formattedLines = [];
    
        foreach ($body->line as $line) {
            // reformating attributes lines
            $data = $line['track']." ".$line['role'];
        
            $lipSyncs = $line->lipsync;
        
            // storing lipsync info and text
            $start = $lipSyncs[0]['timecode'];
            $end = $lipSyncs[1]['timecode'];
            $text = $line->text;
        
            $data .= " ($start-$end) : $text";
        
            $this->result.= $data.PHP_EOL;
        }
    }
}