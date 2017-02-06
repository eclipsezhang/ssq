<?php
namespace console\controllers;

use Yii;
use common\models\WinningNumbers;
use yii\console\Controller;

class ToolsController extends Controller {

	// 更新最新开奖号码
	public function actionUpdateWinningnumbers() {
		$sql = "select datenumber from winningnumbers order by id desc limit 1";
        $datenumber = WinningNumbers::findBySql($sql)->asArray()->one()['datenumber'] + 1;
        $url = "http://datachart.500.com/ssq/history/newinc/history.php?start=" . $datenumber;
        $request = file_get_contents($url);
        preg_match_all('#<tr class=\"t_tr1\">(.*?)</tr>#', $request, $request);
        for ($i = count($request[1])-1; $i > -1; $i--) { 
            preg_match_all('#<td.*?>(.*?)</td>#', $request[1][$i], $winningnumbers);
            $model = new WinningNumbers();
            $model->datenumber = $winningnumbers[1][1];
            $model->red1 = $winningnumbers[1][2];
            $model->red2 = $winningnumbers[1][3];
            $model->red3 = $winningnumbers[1][4];
            $model->red4 = $winningnumbers[1][5];
            $model->red5 = $winningnumbers[1][6];
            $model->red6 = $winningnumbers[1][7];
            $model->blue = $winningnumbers[1][8];
            $model->bonus = $winningnumbers[1][10];
            $model->goldnum = $winningnumbers[1][11];
            $model->goldamount = $winningnumbers[1][12];
            $model->goldnum2 = $winningnumbers[1][13];
            $model->goldamount2 = $winningnumbers[1][14];
            $model->sumamount = $winningnumbers[1][15];
            $model->date = $winningnumbers[1][16];
            $model->save();
        }
	}

}
