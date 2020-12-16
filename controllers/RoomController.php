<?php

namespace app\controllers;

use Yii;
use app\models\Room;
use app\models\ReserveRoom;
use app\models\RoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Просмотр всех номеров
     * @return mixed
     */
    public function actionReserv()
    {
        $rooms = Room::find()->orderBy('id desc')->all();

        return $this->render('reserv', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * Бронирование номера
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionChoose($id)
    {
        $room = Room::find()->where(['id' => $id])->one();
        $request = Yii::$app->request;
        $post = $request->post();
        switch ($post['Room']['option']) {
            case 1:
                $room->price += $room->price * 0.5;
        break;
            case 2:
                $room->price += $room->price * 0.1;
        break;
            case 3:
                $room->price += $room->price * 0.6;
        break;
        }
        $room->free = 0;
        $reserveRoom = new ReserveRoom();
        $reserveRoom->room_id = $id;
        $reserveRoom->price = $room->price;
        $reserveRoom->date_arrival = $post['date_arrival'];
        $reserveRoom->date_departure = $post['date_departure'];
        $room->save();
        $reserveRoom->save();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'reserveRoom' => $reserveRoom,
        ]);
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
