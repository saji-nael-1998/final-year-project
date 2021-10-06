<?php

require_once('../model/admin.php');
require_once('./BaseController.php');
require_once('../model/TaxiModel.php');

class TaxiController extends BaseController
{
    public function addTaxi()
    {
        $data = $_POST;
        if (!empty($data)) {
            //todo validate data
//            if (isset($_FILES['license_photo']) && !empty($_FILES['license_photo'])) {
//                $data['image'] = $this->saveImage($_FILES['license_photo']);
//            } else {
            $data['image'] = '';
//            }
            $taxi_model = new TaxiModel();
            $taxi_model->insertData($data);
        }
    }

    private function saveImage($file): string
    {
        $valid_extensions = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/'; // upload directory
        $img = $file['name'];
        $tmp = $file['tmp_name'];
// get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
        $final_image = rand(1000, 1000000) . $img;
// check's valid format
        if (in_array($ext, $valid_extensions)) {
            $path = $path . strtolower($final_image);
            if (move_uploaded_file($tmp, $path)) {
                return $path;
            }
        }
        return '';
    }
}

$taxiController = new TaxiController();
$taxiController->addTaxi();
