<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YatrikService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    private $yatrikService;

    public function __construct(
        YatrikService $yatrikService
    )
    {
        $this->yatrikService = $yatrikService;
    }

    public function index(Request $request)
    {
        return view('index');
    }

    public function about(Request $request)
    {
        return view('about');
    }

    public function contact(Request $request)
    {
        return view('contact');
    }
}
