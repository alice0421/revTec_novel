<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Providers\RouteServiceProvider;

class NovelController extends Controller
{
    // 小説一覧画面の表示
    public function index()
    {
        $user = User::where("id", Auth::id())->first();
        return Inertia::render('Novels', [
            'novels' => $user
                ->novels()
                ->latest('updated_at')
                ->limit(10)
                ->get(),
            'user' =>  Auth::user(),
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

        $form = $request->all();
        $newNovel = $novel->create($form);

        // $newNovel = $novel->create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'user_id' => $request->user_id,
        //     'output_setting_template_id' => $request->output_setting_template_id,
        // ]);

        return redirect()->route('novelEdit', $newNovel->id);
    }

    // 既存小説編集
    public function edit(Novel $novel)
    {
        return Inertia::render('NovelEdit', [
            'novel' => $novel->where("id", $novel->id)->first(), 
            // 'id' => $novel->id,
            // 'title' => $novel->title,
            // 'body' => $novel->body,
            // 'author' => $novel->author,
            // 'output_setting_template_id' => $novel->output_setting_template_id,
            'user' =>  Auth::user(),
        ]);
    }

    // 既存小説保存
    public function update(Novel $novel, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'output_setting_template_id' => 'required|integer',
        ]);
        // authorはNULLable

        $form = $request->all();
        $novel->fill($form)->save(); // 差分なしは変更しない
    }
}
