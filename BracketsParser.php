<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 30.12.2017
 * Time: 13:58
 */
namespace BracketsParser;
/**
 * Class BracketsParser
 */
use BracketsParser\Exceptions\InvalidArgumentException;

Class BracketsParser
{

    /**
     * @param string $data
     * @return bool
     */
    public static function run(string $data)
    {
        try {
            if (strlen($data) == 0) throw new InvalidArgumentException('Пустая строка на входе!');
            $i = 0;
            for ($x = 0; $x < strlen($data); $x++) {
                if (!in_array($data[$x], ['(', ')', ' ', "\r", "\n", "\t"])) throw new InvalidArgumentException('Некорректный символ в строке!');
                if ($data[$x] == '(') $i++;
                if ($data[$x] == ')') $i--;
                // В процессе чтения строки закрывающих скобок обнаружено больше чем открывающих
                if ($i == -1) return false;
            }
            // Закрывающих скобок меньше чем открывающих
            if ($i > 0) return false;

        } catch (InvalidArgumentException $e) {
            echo $e->getMessage() . '<br />';
            return false;
        }
        return true;
    }
}
