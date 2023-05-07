<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Cost;
use Illuminate\Support\Facades\Auth; // この行を追加
use Illuminate\Support\Facades\Validator; //追加
use App\Models\Item;
use App\Models\User;


class AdminCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user_id = auth()->id();
        $costs = Cost::where('deleted', false)->paginate(10);
        $items = Item::where('deleted', false)->paginate(10);
        $users = User::all();
        $item_ids_with_cost = Cost::where('deleted', false)->pluck('item_id')->toArray();

        $itemsWithoutCost = Item::where('deleted', false)->whereNotIn('id', $item_ids_with_cost)->get();

        $totalExpenses = 0;

        foreach ($costs as $item) {
            $totalExpenses += $item->all_cost;
        }
        return view('admin.costs.index', compact('costs', 'items', 'users', 'itemsWithoutCost', 'totalExpenses'));
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
            'others_cost' => 'required|max:100',
            'item_name' => 'required', // 追加
        ];

        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];

        Validator::make($request->all(), $rules, $messages)->validate();


        $cost = new Cost;
        $cost->others_cost = $request->input('others_cost');
        $cost->send_cost = $request->input('send_cost');
        $cost->original_cost = $request->input('original_cost');
        $cost->number = $request->input('number');

        // all_costの計算
        $cost->all_cost = ($cost->others_cost + $cost->send_cost) + ($cost->original_cost * $cost->number);


        // 現在認証されているユーザーのIDを取得し、user_idに割り当てる
        $cost->user_id = Auth::id();
        //選択されたアイテムのidがcostsテーブルのitem_idカラムに保存されるようになります
        $cost->item_id = $request->input('item_id'); // この行を追加

        $cost->item_name = $request->input('item_name'); // 追加

        $cost->save();



        return redirect()->route('admin.costs.index');
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
        $cost = Cost::find($id);
        return view('admin.costs.edit', compact('cost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if ($request->deleted === null) {
            $rules = [
                'others_cost' => 'required|max:100',
            ];

            $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];

            Validator::make($request->all(), $rules, $messages)->validate();


            //該当のタスクを検索
            $cost = Cost::find($id);

            //モデル->カラム名 = 値 で、データを割り当てる
            $cost->others_cost = $request->input('others_cost');
            $cost->send_cost = $request->input('send_cost');
            $cost->original_cost = $request->input('original_cost');
            $cost->number = $request->input('number');

            $cost->all_cost = ($cost->others_cost + $cost->send_cost) + ($cost->original_cost * $cost->number);

            //データベースに保存
            $cost->save();
        } else {
            $cost = Cost::find($id);
            $cost->deleted = true;
            $cost->save();
        }

        //リダイレクト
        return redirect()->route('admin.costs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cost::destroy($id);



        return redirect('/admin/costs');
    }
}
