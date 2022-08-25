<?php

namespace app\models;

use Yii;
use yii\base\Model;

class HappyTicketForm extends Model
{

    /**
     *
     */
    const DIGITAL_COUNT = 6;
    const MIN_VALUE = 1;
    const MAX_VALUE = 999999;

    public $from;
    public $to;

    /**
     * @var array
     */
    public $happyTicketNumbers = [];

    /**
     * @return array
     */
    public function rules()
    {
        return [

            [['from', 'to'], 'required'],
            [['from', 'to'], 'integer', 'min' => self::MIN_VALUE, 'max' => self::MAX_VALUE],
            [['to'], 'compare', 'compareAttribute' => 'from', 'operator' => '>']
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'from' => 'N - From',
            'to' => 'N - To'
        ];
    }


    /**
     * @param int $number
     * @return string
     */
    public function addZeros(int $number): string
    {
        $symbolsCount = strlen($number);
        $result = $number;

        if ($symbolsCount < self::DIGITAL_COUNT) {
            $zerosCount = self::DIGITAL_COUNT - $symbolsCount;
            $result = '';
            for ($i = 1; $i <= $zerosCount; $i++) {
                $result .= 0;
            }
            $result .= $number;
        }

        return $result;
    }

    /**
     * @param sting $number
     * @return int
     */
    function digitsSum(string $number): int
    {
        $sum = 0;
        $result = 0;

        $digitsCount = strlen($number);
        for ($i = 0; $i < $digitsCount; $i++) {
            $sum += $number[$i];
        }

        //Если сумма цифр является 2 разрядной,снова их складываем
        $sumDigitsCount = strlen($sum);
        if ($sumDigitsCount > 1) {
            $sum = strval($sum);
            for ($j = 0; $j < $sumDigitsCount; $j++) {
                $result += $sum[$j];
            }
        } else {
            $result = $sum;
        }

        return $result;
    }


    /**
     * @return int
     */
    function happyTicketCount(): int
    {
        $count = 0;

        if (strlen($this->from) <= self::DIGITAL_COUNT and strlen($this->to) <= self::DIGITAL_COUNT) {
            for ($number = $this->from; $number <= $this->to; $number++) {
                //добавляем нули впереди, если число не шестизначное
                $number = $this->addZeros($number);
                //вынимаем обе тройки
                $firstThree = substr($number, 0, 3);
                $secondThree = substr($number, 3, 3);
                //если сумма цифр первой тройки и сумма цифр второй стройки равна
                if ($this->digitsSum($firstThree) == $this->digitsSum($secondThree)) {
                    $count++;
                    $this->happyTicketNumbers[] = $number;
                }
            }
        }

        return $count;
    }
}