<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Item; //追加
use Illuminate\Support\Facades\Auth; // この行を追加
use Illuminate\Support\Facades\Validator; //追加
use App\Models\Cost;

class AdminItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$user_id = auth()->id();
        $items = Item::where('deleted', false)->paginate(10);
        //$costs = Cost::where('deleted', false)->get();

        return view('admin.items.index', compact('items'));
        // $変数 = モデルクラス::where(カラム名, 値)->get(); // 複数のレコードを取得するとき
        // $変数 = モデルクラス::where(カラム名, 値)->first(); // 最初のレコードだけ取得するとき
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'item_name' => 'required|max:100',  'seal_price' => 'required|max:100',
        ];

        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];

        Validator::make($request->all(), $rules, $messages)->validate();




        //モデルをインスタンス化
        $item = new Item;

        //モデル->カラム名 = 値 で、データを割り当てる
        $item->item_name = $request->input('item_name');
        $item->seal_price = $request->input('seal_price');

        // 現在認証されているユーザーのIDを取得し、user_idに割り当てる
        $item->user_id = Auth::id();


        //データベースに保存
        $item->save();

        //リダイレクト
        return redirect()->route('admin.items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('admin.items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //編集するボタンを押したとき
        if ($request->deleted === null) {
            $rules = [
                'item_name' => 'required|max:100',
            ];

            $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];

            Validator::make($request->all(), $rules, $messages)->validate();


            //該当のタスクを検索
            $item = Item::find($id);

            //モデル->カラム名 = 値 で、データを割り当てる
            $item->item_name = $request->input('item_name');
            $item->seal_price = $request->input('seal_price');

            if ($request->hasFile('image')) {
                $name = $request->file('image')->getClientOriginalName();
                $request->file('image')->move('storage/images', $name);
                $item->image = $name;
            } else {
                // デフォルトの画像ファイル名を設定
                $item->image = 'no-image.jpg';
            }

            //データベースに保存
            $item->save();
            return redirect()->route('admin.items.index');
        } else {
            //完了ボタンを押したとき
            $item = Item::find($id);
            //モデル->カラム名 = 値 で、データを割り当てる
            $item->deleted = true; //true:完了、false:未完了
            //データベースに保存
            $item->save();
        }

        //リダイレクト
        return redirect()->route('admin.items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Item::destroy($id);

        Cost::where('item_id', $id)->delete();

        return redirect('/admin/items');
    }
}
