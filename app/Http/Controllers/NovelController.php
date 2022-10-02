<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Providers\RouteServiceProvider;

class NovelController extends Controller
{
    // 小説一覧画面の表示
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        return Inertia::render('Novels', [
            'novels_latest' => $user
                ->novels()
                ->latest('updated_at')
                ->limit(10)
                ->get(),
            'novels_doing' => $user
                ->novels()
                ->where('is_done', 0)
                ->latest('updated_at')
                ->limit(10)
                ->get(),
            'novels_done' => $user
                ->novels()
                ->where('is_done', 1)
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
            'is_done' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $newNovel = $novel->create($request->only(['title', 'body', 'is_done', 'user_id']));

        session()->flash('saveMessage', '✓新規保存しました');
        return redirect()->route('novelEdit', $newNovel->id);
    }

    // 既存小説編集
    public function edit(Novel $novel)
    {
        return Inertia::render('NovelEdit', [
            'novel' => $novel->where("id", $novel->id)->first(), 
            'user' =>  Auth::user(),
        ]);
    }

    // 既存小説保存
    public function update(Novel $novel, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'is_done' => 'required|integer',
            // authorはNULL able
        ]);

        $novel->fill($request->only(['title', 'body', 'author']))->save();
        // is_doneの変更(執筆中/執筆完了)ではupdated_atを更新させない
        $novel->timestamps = false;
        $novel->fill($request->only(['is_done']))->save();

        return "✓保存しました";
    }

    // 小説をもっと見る
    public function more(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        if($request->category=='最近更新した小説'){
            return Inertia::render('NovelsMore', [
                'novels' => $user
                    ->novels()
                    ->latest('updated_at')
                    ->get(),
                'category' => $request->category,
                'user' =>  Auth::user(),
            ]);
        }else if($request->category=='執筆中の小説'){
            return Inertia::render('NovelsMore', [
                'novels' => $user
                    ->novels()
                    ->where('is_done', false)
                    ->latest('updated_at')
                    ->get(),
                'category' => $request->category,
                'user' =>  Auth::user(),
            ]);
        }else if($request->category=='執筆完了した小説'){
            return Inertia::render('NovelsMore', [
                'novels' => $user
                    ->novels()
                    ->where('is_done', true)
                    ->latest('updated_at')
                    ->get(),
                'category' => $request->category,
                'user' =>  Auth::user(),
            ]);
        }else{ // カテゴリーごと
            // return Inertia::render('NovelsMore', [
            //     'novels' => $user
            //         ->novels()
            //         ->where('category_id', 1)
            //         ->latest('updated_at')
            //         ->get(),
            //     'category' => $request->category,
            //     'user' =>  Auth::user(),
            // ]);
        }
    }
}
