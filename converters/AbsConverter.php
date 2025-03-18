<?php

/**
 * Abstract class converter
 */
abstract class AbsConverter {
    
    /** @var string $result */
    protected $result = '';

    /** 
     * Convert given file and store the result in protected param result
     * 
     * @param string $fileName
     */
    abstract protected function convert(string $fileName);

    /**
     * Prints the result (or an error message if converting the file did not occurred)
     * 
     * @param string $fileName
     * 
     * @return string;
     */
    public function getResult(string $fileName): string
    {
        $this->convert($fileName);

        if ($this->result === '') {
            return "An error has occured while converting your file. Please try again later";
        } else {
            return $this->result;
        }
    }
}
