<?php
namespace app\controller;

use app\core\Controller;

class PagesController extends Controller {

    public function home() {

        $this->load('home/main');

    }

    public function produto() {

        $this->load('produto/main');

    }

    public function quemSomos() {

        $this->load('quemSomos/main');

    }

    public function contato() {

        $this->load('contato/main');

    }
    
}
