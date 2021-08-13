<?php
    //Load the model and the view
    class Controller {
        public function model($model) {
            //Require model file
            require_once '../app/models/' . $model . '.php';
            //Instantiate model
            return new $model();
        }

        //Load the view (checks for the file)
        public function view($view, $data = [], $datas = [], $data1 = [],$data2 = [],$data3 = [],$data4 = [],$data5 = [],$data6 = [],$data7 = [],$data8 = []) {
            if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                die("View does not exists.");
            }
        }
    }
