<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 使用控制器 PagesController 来处理所有自定义页面的逻辑
 */
class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }
}
