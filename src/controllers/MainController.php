<?php

namespace App\controllers;

use App\App;
use App\models\Cd;
use App\models\CdMapper;

class MainController
{
    protected $app;
    
    public function __construct(App $app)
    {
        $this->app = $app;
    }
    
    public function actionIndex()
    {
        $mapper = new CdMapper($this->app->db);
        
        // @todo validation
        $filterField = $_REQUEST['filter_field'] ?? null;
        $filterValue = $_REQUEST['filter_value'] ?? null;
        $sort = $_REQUEST['sort'] ?? '';
        $direction = $_REQUEST['direction'] ?? 'ASC';
        
        if (!empty($filterField) && !Cd::getFormFields()[$filterField]) {
            throw new \Exception('Wrong filter field');
        }
        
        if (!empty($sort) && !Cd::getFormFields()[$sort]) {
            throw new \Exception('Wrong sorting field');
        }
        
        if (!empty($direction) && !in_array($direction, ['ASC', 'DESC'])) {
            throw new \Exception('Wrong sorting direction');
        }
        
        $cards = $mapper->getAll($filterField, $filterValue, $sort, $direction);
        include __DIR__ .'/../tpl/main.php';
    }

    public function actionCreate()
    {
        // @todo need validation
        // @todo need date processing
        $mapper = new CdMapper($this->app->db);
        $cd = (new Cd($_REQUEST));
        $cd->img = $this->processImg();
        $cd->buy_date = (\DateTime::createFromFormat('Y-m-d', $cd->buy_date)->setTime(0, 0, 0, 0)->getTimestamp());
        
        $id = $mapper->create($cd);
        
        if ($id) {
            $this->actionIndex();
        } else {
            http_response_code(400);
        }
    }

    public function actionUpdate()
    {
        // @todo need validation
        if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {
            http_response_code(400);
        }
        
        $mapper = new CdMapper($this->app->db);
        $cd = $mapper->getById($_REQUEST['id']);
        
        if (!$cd) {
            http_response_code(400);
        }
        
        $cd->load($_REQUEST);
        $cd->img = $this->processImg() ?: $cd->img;
        $cd->buy_date = (\DateTime::createFromFormat('Y-m-d', $cd->buy_date)->setTime(0, 0, 0, 0)->getTimestamp());
        $result = $mapper->update($cd);

        if ($result) {
            $this->actionIndex();
        } else {
            http_response_code(400);
        }
    }

    public function actionDelete()
    {
        $id = $_REQUEST['id'];
        $mapper = new CdMapper($this->app->db);
        $result = $mapper->delete($id);
        
        $this->jsonRsponse(['result' => $result]);
    }
    
    protected function jsonRsponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    protected function processImg() {
        $imgName = '';
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0 && $_FILES['img']['size'] > 0) {
            $imgName = md5_file($_FILES['img']['tmp_name']) .'.'. strtolower(pathinfo($_FILES['img']['name'])['extension']);
            $imgPath = $this->app->assetsPath . DIRECTORY_SEPARATOR . $imgName;

            if (!file_exists($imgPath)) {
                move_uploaded_file($_FILES['img']['tmp_name'], $imgPath);
            }
        }
        
        return $imgName;
    }
}