<?php

require_once('../model/admin.php');
require_once('./BaseController.php');
require_once('../model/Taxi.php');

class TaxiController extends BaseController
{
    public function addTaxi()
    {
        $data = $_POST;
        if (!empty($data)) {
            $taxi_model = new Taxi();
            if (!$taxi_model->isUsedId($data['taxi_id'])) {
                $data['image_path'] = '';
                if (isset($_FILES['license_photo']) && !empty($_FILES['license_photo'])) {
                    $data['image_path'] = $this->saveImage($_FILES['license_photo']);
                }
                if ($taxi_model->insertData($data)) {
                    echo json_encode(['message' => 'Success']);
                    return;
                }
            }
            echo json_encode(['message' => 'fail']);
        }
    }

    public function updateTaxi()
    {
        $data = $_POST;
        if (!empty($data)) {
            $taxi_model = new Taxi();
            if ($taxi_model->isUsedId($data['taxi_id'])) {
                $data['image_path'] = '';
                if (isset($_FILES['license_photo']) && !empty($_FILES['license_photo'])) {
                    $data['image_path'] = $this->saveImage($_FILES['license_photo']);
                }
                if ($taxi_model->updateData($data)) {
                    echo json_encode(['message' => 'Success']);
                    return;
                }
            }
        }
        echo json_encode(['message' => 'fail']);
    }

    private function saveImage($file): string
    {
        $valid_extensions = ['jpeg', 'jpg', 'png'];

        $image_path = $file['name'];
        $target_directory = "../upload/";
        $target_file = $target_directory . basename(
                $image_path
            );
        $ext = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

        if (in_array($ext, $valid_extensions)) {
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_path = $target_directory . $_POST['taxi_id'] . "." . $filetype;
            if (move_uploaded_file($file['tmp_name'], $image_path)) {
                return $image_path;
            }
        }
        return '';
    }

    public function getTaxiData()
    {
        $taxi_model = new Taxi();
        if ($taxi_info = $taxi_model->isUsedId($_GET['id'])) {
            $taxi_info[0]['status'] = 'success';
            echo json_encode($taxi_info[0]);
        } else {
            echo json_encode(['status' => 'fail']);
        }
    }

    public function render($file)
    {
        include '../' . $file . '.php';
    }

    public function deleteTaxi()
    {
        $taxi_model = new Taxi();
        $taxi_model->deleteTaxi($_GET['taxi_id']);
    }

    public function getAllRecord(){
        $taxi_model = new Taxi();
        $taxi_model->getAllRecord();
    }

}

$taxiController = new TaxiController();
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'update') {
        $taxiController->updateTaxi();
    } elseif ($_POST['action'] == 'delete') {
        $taxiController->deleteTaxi();
    } else {
        $taxiController->addTaxi();
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $taxiController->deleteTaxi();
} elseif (isset($_GET['id'])) {
    $taxiController->getTaxiData();
}else {
    $taxiController->getAllRecord();
}

