<?php

namespace app\Http\Controllers\System;


use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected $repository;

    public function index() {
        return view('system.user.index');
    }

	public function getList() {

	}

    public function add() {
        echo 'add';
        return;
    }

    public function edit() {
        echo 'edit';
    }

    public function delete() {

    }
}