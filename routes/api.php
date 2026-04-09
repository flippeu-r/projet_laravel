<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::post('/tickets', [TicketController::class, 'apiStore']);