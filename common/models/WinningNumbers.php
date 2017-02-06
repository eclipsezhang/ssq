<?php

namespace common\models;

use Yii;
use common\component\Utils;

/**
 * This is the model class for table "winningnumbers".
 *
 * @property integer $id
 * @property string $datenumber
 * @property string $red1
 * @property string $red2
 * @property string $red3
 * @property string $red4
 * @property string $red5
 * @property string $red6
 * @property string $blue
 * @property string $bonus
 * @property string $goldnum
 * @property string $goldamount
 * @property string $goldnum2
 * @property string $goldamount2
 * @property string $sumamount
 * @property string $date
 */
class WinningNumbers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'winningnumbers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datenumber', 'red1', 'red2', 'red3', 'red4', 'red5', 'red6', 'blue', 'bonus', 'goldnum', 'goldamount', 'goldnum2', 'goldamount2', 'sumamount', 'date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datenumber' => '期号',
            'red1' => '红球1',
            'red2' => '红球2',
            'red3' => '红球3',
            'red4' => '红球4',
            'red5' => '红球5',
            'red6' => '红球6',
            'blue' => '篮球',
            'bonus' => '奖池',
            'goldnum' => '一等奖数量',
            'goldamount' => '一等奖金额',
            'goldnum2' => '二等奖数量',
            'goldamount2' => '二等奖金额',
            'sumamount' => '总投注金额',
            'date' => '日期',
        ];
    }

    // x号球为y出现次数
    public static function checkRed($x, $y) {
        $time = 0;
        $winnigNumbers = self::find()->asArray()->all();
        foreach ($winnigNumbers as $wns) {
            if ($wns["red" . $x] == $y) {
                $time++;
            }
        }
        echo $time;
    }

    // x球出现次数
    public static function checkBlue($x) {
        $time = 0;
        $winnigNumbers = self::find()->asArray()->all();
        foreach ($winnigNumbers as $wns) {
            if ($wns["blue"] == $x) {
                $time++;
            }
        }
        echo $time;
    }

    // $yc中奖率分析
    public static function checkHit($yc) {
        $yc = ['1', '2' ,'3' , '4', '5', '6', '1'];
        $winnigNumbers = WinningNumbers::find()->all();

        $red_nums = 0; // 红球中奖个数
        $ishit = 0; // 篮球是否正确

        foreach ($winnigNumbers as $wns) {
            for ($i = 0; $i < 6; $i++) { 
                if ($yc[$i] == $wns['red1']) {
                    $red_nums++;
                } else if ($yc[$i] == $wns['red2']) {
                    $red_nums++;
                } else if ($yc[$i] == $wns['red3']) {
                    $red_nums++;
                } else if ($yc[$i] == $wns['red4']) {
                    $red_nums++;
                } else if ($yc[$i] == $wns['red5']) {
                    $red_nums++;
                } else if ($yc[$i] == $wns['red6']) {
                    $red_nums++;
                }
            }
            if ($yc[6] == $wns['blue']) {
                $ishit = 1;
            }
            if (($red_nums == 0 && $ishit == 1) || ($red_nums == 1 && $ishit == 1) || ($red_nums == 2 && $ishit == 1)) {
                echo "六等奖，五元<br>";
            } else if (($red_nums == 3 && $ishit == 1) || ($red_nums == 4 && $ishit == 0)) {
                echo "五等奖，十元<br>";
            } else if (($red_nums == 4 && $ishit == 1) || ($red_nums == 5 && $ishit == 0)) {
                echo "四等奖，二百元<br>";
            } else if ($red_nums == 5 && $ishit == 1) {
                echo "三等奖，三千元<br>";
            } else if ($red_nums == 6 && $ishit == 0) {
                echo "二等奖<br>";
            } else if ($red_nums == 6 && $ishit == 1) {
                echo "一等奖<br>";
            }
            $i = 0;
            $red_nums = 0;
            $ishit = 0;
        }
    }
}
