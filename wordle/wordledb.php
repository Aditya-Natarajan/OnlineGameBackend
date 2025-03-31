<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordleDB</title>
</head>
<body>
<?php
    class wordle{
        public $CodeWord;
        public $len;
        public $map;


        function __construct(int $letters=5){
            $this->CodeWord = self::getWord($letters);
            $this->lives = $letters+1;
            $this->len = $letters;
            $this->map = array();
            foreach(str_split($this->CodeWord) as $ch){
                if (!isset($this->map[$ch])) {
                    $this->map[$ch] = 0;
                }
                $this->map[$ch] += 1;
            }
            
        }

        function checkWord(string $word) {
            $map = $this->map;
            $bitmap = array_fill(0,$this->len,0); 
            for ($i = 0; $i < $this->len; $i++) {
                if ($word[$i] == $this->CodeWord[$i]) {
                    $bitmap[$i] = 2;
                    $map[$word[$i]] -= 1;
                }
            }

            for ($i = 0; $i < $this->len; $i++) {
                if ($bitmap[$i] == 2) continue;

                if (isset($map[$word[$i]]) && $map[$word[$i]] > 0) {
                    $bitmap[$i] = 1;
                    $map[$word[$i]] -= 1;
                } else {
                    $bitmap[$i] = 0;
                }
            }
            return implode("",$bitmap);
        }

        static function getWord($size){
            $fileName = "./data/";
            switch($size){
                case 3:
                    $fileName.="ThreeLetterWords.csv";
                    break;
                case 4:
                    $fileName.="FourLetterWords.csv";
                    break;
                case 6:
                    $fileName.="SixLetterWords.csv";
                    break;
                default:
                    $fileName.="FiveLetterWords.csv";
                    break;
            }
            $data = [];
            if (($handle = fopen($fileName, "r")) !== FALSE) {
                while (($row = fgetcsv($handle)) !== FALSE) {
                    $data[] = $row;
                }
                fclose($handle);
            }
            $index = rand() % sizeof($data);
            return  $data[$index][0];
        }
    }

    $myobj3 = new wordle(3);
    $myobj4 = new wordle(4);
    $myobj5 = new wordle(5);
    $myobj6 = new wordle(6);
    echo $myobj3->CodeWord.'<br>';
    echo $myobj4->CodeWord.'<br>';
    echo $myobj5->CodeWord.'<br>';
    echo $myobj6->CodeWord;
?>

</body>
</html>