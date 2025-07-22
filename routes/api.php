<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authcontroller;




Route::post('/signup', [Authcontroller::class, 'signup']);