<?php


class StringFinder
{
    private $lines;
    private $max_size;
    private $mime_type;

    public function __construct($path = __DIR__ . "/defaultFile.txt")
    {
        $config = yaml_parse(file_get_contents(__DIR__ . "/config.yaml"));
        $this->max_size = $config['max-size'];
        $this->mime_type = $config['mime-type'];

        $this->setFile($path);
    }

    private function checkFile($path){
        if(filesize($path) > $this->max_size) return "Слишком большой файл";
        if(mime_content_type($path) <> $this->mime_type) return "Неверный mime-type";

        else return true;
    }

    private function setFile($path){
        if($this->checkFile($path) === true){
            $string = file_get_contents($path);
            $this->lines = explode("\r\n", $string);
        }else{
            echo $this->checkFile($path);
        };
    }

    public function find($search_string){
        if(isset($this->lines)) {
            foreach ($this->lines as $key => $line) {
                $position = strpos($line, $search_string);
                if (($position !== false)) {
                    return ["line" => $key+1, "pos" => $position+1];
                }
            }
            return false;
        }
    }
}
