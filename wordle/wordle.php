<?php
class wordle{
    private $CodeWord;
    private $lives;
    private $bitmap;
    private $len;
    private $map;


    function __construct(int $letters=5){
        $this->CodeWord = self::getWord($letters);
        $this->lives = $letters+1;
        $this->len = $letters;
        $this->map = array();
        $this->bitmap = array_fill(0,$letters,0);
        foreach(str_split($this->CodeWord) as $ch){
            if (!isset($this->map[$ch])) {
                $this->map[$ch] = 0;
            }
            $this->map[$ch] += 1;
        }
        
    }

    function checkWord(string $word) {
        $map = $this->map;
        
        for ($i = 0; $i < $this->len; $i++) {
            if ($word[$i] == $this->CodeWord[$i]) {
                $this->bitmap[$i] = 2;
                $map[$word[$i]] -= 1;
            }
        }

        for ($i = 0; $i < $this->len; $i++) {
            if ($this->bitmap[$i] == 2) continue;

            if (isset($map[$word[$i]]) && $map[$word[$i]] > 0) {
                $this->bitmap[$i] = 1;
                $map[$word[$i]] -= 1;
            } else {
                $this->bitmap[$i] = 0;
            }
        }
        return implode("",$this->bitmap);
    }

    static function getWord($size){
        // switch($size){
        //     case 3:
        //         $filename="ThreeLetterWords.txt";
        //         break;
        //     case 4:
        //         $filename="FourLetterWords.txt";
        //         break;
        //     case 6:
        //         $filename="SixLetterWords.txt";
        //         break;
        //     default:
        //         $filename="FiveLetterWords.txt";
        //         break;
        // }
        // $myfile = fopen($fileName, "r");
        // echo fread($myfile,filesize($filename));
        // fclose($myfile);
        $words = array("cat","that","splat","carpet");
        return $words[$size-3];
    }

}
?>