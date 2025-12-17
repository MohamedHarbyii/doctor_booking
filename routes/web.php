<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ProvisionServer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('invoke',ProvisionServer::class);
