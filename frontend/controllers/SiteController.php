<?php
namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\component\Utils;
use common\models\WinningNumbers;
use common\models\WinningNumbersSearch;
use common\models\Message;

/**
 * Site controller
 */
class SiteController extends Controller {

    // 首页
    public function actionIndex() {
        // 开奖号码数据
        $models = WinningNumbers::find()->all();
        $arr = array(
            'datenumber' => '',
            'red1' => '',
            'red2' => '',
            'red3' => '',
            'red4' => '',
            'red5' => '',
            'red6' => '',
            'blue' => '',
        );
        foreach ($models as $model) {
            $arr['datenumber'] .= $model->datenumber . "|";
            $arr['red1'] .= $model->red1 . "|";
            $arr['red2'] .= $model->red2 . "|";
            $arr['red3'] .= $model->red3 . "|";
            $arr['red4'] .= $model->red4 . "|";
            $arr['red5'] .= $model->red5 . "|";
            $arr['red6'] .= $model->red6 . "|";
            $arr['blue'] .= $model->blue . "|";
        }
        // 留言板数据
        $messages = Message::find()->orderBy('id desc')->all();
        return $this->render(
            'index', 
            [
                'model' => $models[count($models)-1],
                'dateNumber' => substr($arr['datenumber'], 0, -1),
                'red1' => substr($arr['red1'], 0, -1),
                'red2' => substr($arr['red2'], 0, -1),
                'red3' => substr($arr['red3'], 0, -1),
                'red4' => substr($arr['red4'], 0, -1),
                'red5' => substr($arr['red5'], 0, -1),
                'red6' => substr($arr['red6'], 0, -1),
                'blue' => substr($arr['blue'], 0, -1),
                'messages' => $messages,
            ]
        );
    }

    // 历史开奖数据
    public function actionData() {
        $searchModel = new WinningNumbersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render(
            'data', 
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    // 数据科学分析
    public function actionLine() {
        return $this->render(
            'line'
        );
    }

    // 留言板
    public function actionMessage() {
        $message = new Message();
        $address = Utils::getAddress();
        if (isset($address->city)) {
            $message->username = $address->city;
        } else if (isset($address->region)) {
            $message->username = $address->region;
        } else if (isset($address->country)) {
            $message->username = $address->country;
        } else {
            $message->username = "火星";
        }
        $message->username.="彩民";
        $message->message = Yii::$app->request->post('message');
        $message->time = date('Y-m-d H:i:s');
        $message->up = 0;
        $message->down = 0;
        $message->save();
        return json_encode([
            'flag' => 'success',
            'username' => $message->username,
            'message' => $message->message,
            'time' => $message->time,
        ]);
    }

    public function actionTest() {
        WinningNumbers::checkRed(1, 2);
        WinningNumbers::checkBlue(1);
    }

}
