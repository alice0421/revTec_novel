<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Providers\RouteServiceProvider;

class NovelController extends Controller
{
    // 小説一覧画面の表示
    public function index(Novel $novel)
    {
        return Inertia::render('Novels', [
            'novels' => $novel->get()
        ]);
    }

    // 新規小説作成
    public function create(Novel $novel)
    {
        return Inertia::render('NovelCreate');
    }

    // 新規小説保存
    public function store(Novel $novel, Request $request)
    {
        //dd($request->title, $request->body);

        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $novel->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'output_setting_template_id' => $request->output_setting_template_id,
        ]);
    }

    // 既存小説編集
    public function edit(Novel $novel)
    {

    }

    // 既存小説保存
    public function update(Novel $novel)
    {

    }
}
