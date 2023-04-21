<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        Mail::to('cek@cek.com')->send(new SendEmail);
        return 'berhasil mengirim email';
    }
}
