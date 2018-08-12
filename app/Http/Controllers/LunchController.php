<?php

namespace App\Http\Controllers;

use App\Lunch;
use Illuminate\Http\Request;


class LunchController extends Controller
{
    const PAGENAME = '午餐拉霸機 v2.0';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $lunchList = Lunch::all();
//        $lunchList = Lunch::orderBy('id')->get();
        $lunchList = Lunch::inRandomOrder()->get();

        $data = [
            'pageName' => self::PAGENAME,
            'lunchList' => $lunchList,
            'firstItem' => $lunchList[0],
            'AA' => 'AA'
        ];

        return view('index',$data);

        
    }

    public function list()
    {
        $per_page = 30;

        $lunchList = Lunch::OrderBy('id', 'desc')
            ->paginate($per_page);

        $data = [
            'pageName' => self::PAGENAME,
            'lunchList'=> $lunchList,
        ];

        return view('list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_name'    => 'required|max:60|unique:lunch',
            'address' 	    => 'required|max:255',
        ],[
            'store_name.required' => '請填寫店家名稱',
            'store_name.max'      => '店家名稱請小於60字元',
            'store_name.unique'   => '店家名稱重複',
            'address.required'    => '請填寫地址',
            'address.max'    => '地址請小於255字元'
        ]);
        Lunch::create($request->all());
        return redirect()->route('lunch.item.index')
            ->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'pageName' => self::PAGENAME,
            'lunch' => Lunch::findOrFail($id)
        ];
        return view('edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'store_name'    => 'required|max:60',
            'address' 	    => 'required|max:255',
        ],[
            'store_name.required' => '請填寫店家名稱',
            'store_name.max'      => '店家名稱請小於60字元',
            'address.required'    => '請填寫地址',
            'address.max'    => '地址請小於255字元'
        ]);

        Lunch::findOrFail($id)->update($request->all());
        return redirect()->route('lunch.item.index')
            ->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lunch::findOrFail($id)->delete();
        return redirect()->route('lunch.item.index')
            ->with('success','刪除成功');
    }


    public function ajaxGetAddress(Request $request){

        $lunchDatas = Lunch::findOrFail( $request->id );

        return json_decode($lunchDatas, true);
    }
}
