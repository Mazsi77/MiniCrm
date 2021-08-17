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
        public function view($view, $data = [], $datas = [], $data1 = [],$data2 = [],$data3 = [],$data4 = [],$data5 = [],$data6 = [], $janWon=[], $janLost=[],$janPros=[],$janNeg=[],$febWon=[], $febLost=[],$febPros=[],$febNeg=[],$marWon=[], $marLost=[],$marPros=[],$marNeg=[],$aprWon=[], $aprLost=[],$aprPros=[],$aprNeg=[],$mayWon=[], $mayLost=[],$mayPros=[],$mayNeg=[],$junWon=[], $junLost=[],$junPros=[],$junNeg=[],$julWon=[], $julLost=[],$julPros=[],$julNeg=[],$augWon=[], $augLost=[],$augPros=[],$augNeg=[],$sepWon=[], $sepLost=[],$sepPros=[],$sepNeg=[],$avgAmount=[],$topLeads=[]) {
            if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                die("View does not exists.");
            }
        }
    }
