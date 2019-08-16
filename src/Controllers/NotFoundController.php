<?php


namespace Quiz\Controllers;


class NotFoundController extends BaseController
{
    protected $template = 'error';

    public function index()
    {
        return $this->view('errors' . DS . '404');
    }
}
