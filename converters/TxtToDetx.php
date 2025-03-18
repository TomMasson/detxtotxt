<?php

require_once 'AbsConverter.php';

/**
 * Txt to Detx converter
 */
class TxtToDetx extends AbsConverter{
    /** 
     * Convert given file and store the result in protected param result (Txt to Detx)
     * 
     * @param string $fileName
     */
    protected function convert($fileName) {        
        // generate and print an xml file
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 2);
        xmlwriter_set_indent_string($xw, '  ');

        // start of the document
        xmlwriter_start_document($xw, '1.0', 'UTF-8', 'no');

        xmlwriter_start_element($xw, 'detx');

        xmlwriter_start_attribute($xw, 'copyright');
        xmlwriter_text($xw, "Chinkel S.A., 2007-2025");
        xmlwriter_end_attribute($xw);

        // blank for better file reading
        xmlwriter_text($xw, "\n");

        // header
        $xmlString = file_get_contents($fileName);
        $headerStart = strpos($xmlString, "<header");
        $headerStop = strpos($xmlString, "</roles>");

        $header = substr($xmlString, $headerStart, ($headerStop+9) - $headerStart);
        xmlwriter_write_raw($xw, PHP_EOL.'  '.$header);

        xmlwriter_text($xw, "\n");

        // body
        $handle = fopen($fileName, "r");
        xmlwriter_start_element($xw, 'body');

        if ($handle) {
            $isHeader = true;
            while (($line = fgets($handle)) !== false) {
                if (!$isHeader) {
                    // default values
                    $track = "0";
                    $role = "role";
                    $start = "00:00:00:00";
                    $end = "00:00:00:00";
                    $text = "";

                    if (preg_match('/^(\d)\s(\w+)\s\(([\d:]+)-([\d:]+)\)\s:\s(.+)$/', $line, $matches)) {
                        $track = $matches[1];
                        $role = $matches[2];
                        $start = $matches[3];
                        $end = $matches[4];
                        $text = $matches[5];
                    }

                    // Line element
                    xmlwriter_start_element($xw, 'line');

                    // Line attributes
                    xmlwriter_start_attribute($xw, 'role');
                    xmlwriter_text($xw, $role);
                    xmlwriter_end_attribute($xw);

                    xmlwriter_start_attribute($xw, 'track');
                    xmlwriter_text($xw, $track);
                    xmlwriter_end_attribute($xw);

                    // lipsync open
                    xmlwriter_start_element($xw, 'lipsync');

                    xmlwriter_start_attribute($xw, 'timecode');
                    xmlwriter_text($xw, $start);
                    xmlwriter_end_attribute($xw);

                    xmlwriter_start_attribute($xw, 'type');
                    xmlwriter_text($xw, 'in_open');
                    xmlwriter_end_attribute($xw);

                    xmlwriter_end_element($xw);

                    // Text
                    xmlwriter_start_element($xw, 'text');
                    xmlwriter_text($xw, $text);
                    xmlwriter_end_element($xw);

                    // lipsync close
                    xmlwriter_start_element($xw, 'lipsync');

                    xmlwriter_start_attribute($xw, 'timecode');
                    xmlwriter_text($xw, $end);
                    xmlwriter_end_attribute($xw);

                    xmlwriter_start_attribute($xw, 'type');
                    xmlwriter_text($xw, 'out_open');
                    xmlwriter_end_attribute($xw);

                    xmlwriter_end_element($xw);

                    // closing line tag
                    xmlwriter_end_element($xw);
                }

                if ($line === "</detx>".PHP_EOL) {
                    $isHeader = false;
                }
            }
        }
        fclose($handle);

        xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);

        xmlwriter_end_document($xw);

        $this->result = xmlwriter_output_memory($xw);
    }

}