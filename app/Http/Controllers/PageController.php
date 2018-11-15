<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return v('pages.home');
    }

    public function getContact()
    {
        return v('contact.contact');
    }
}
