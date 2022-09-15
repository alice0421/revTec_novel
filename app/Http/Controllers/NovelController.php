<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Providers\RouteServiceProvider;

class NovelController extends Controller
{
    // 小説一覧画面の表示
    public function index(Novel $novel)
    {
        return Inertia::render('Novels', [
            'novels' => $novel->where('user_id', Auth::id())->get()
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
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'user_id' => 'required|integer',
            'output_setting_template_id' => 'required|integer'
        ]);

        $newNovel = $novel->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'output_setting_template_id' => $request->output_setting_template_id,
        ]);

        return Inertia::render('NovelEdit',[
            'id' => $newNovel->id,
            'title' => $newNovel->title,
            'body' => $newNovel->body,
            'user_id' => $newNovel->user_id,
            'output_setting_template_id' => $newNovel->output_setting_template_id,
        ]);
    }

    // 既存小説編集
    public function edit(Novel $novel)
    {
        return Inertia::render('NovelEdit');
    }

    // 既存小説保存
    public function update(Novel $novel, Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string',
            'body' => 'required|string',
            'user_id' => 'required|integer',
            'output_setting_template_id' => 'required|integer'
        ]);

        $novel->where('id', $request->id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'output_setting_template_id' => $request->output_setting_template_id,
        ]);

    }
}
