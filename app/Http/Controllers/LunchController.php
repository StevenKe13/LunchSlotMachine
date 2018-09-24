<?php

namespace App\Http\Controllers;

use App\Models\Lunch;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Str;
use Image;


class LunchController extends Controller
{
    const PAGENAME = '午餐拉霸機 v2.0';

    private $lunch;

    private $destinationPath;

    /**
     * LunchController constructor.
     * @param Lunch $lunch
     */
    public function __construct(Lunch $lunch)
    {
//        parent::__construct();
        $this->lunch = $lunch;
        $this->destinationPath = public_path('upload/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lunchList = $this->lunch->where('status', 'Y')
            ->inRandomOrder()
            ->get();

//        dd( $this->lunch->where('store_name','金花子')->first(['id', 'address']) );
//        Query: SELECT `id`,`address` FROM lunch WHERE store_name ='金花子'

        /* first() */
//        dd( Lunch::find(3) );
//        dd( $this->lunch->where('id','3')->first() );
//        $this->lunch->find('3');

        /* get() */
        /* 取得所有id=3的數組 沒什麼意義 因為是唯一值 */
//        dd( $this->lunch->where('id','3')->get() );

        /* 取得所有status = 0的數組 */
//        dd($this->lunch->where('status', '0')->get());

        /* 取得所有status = 0的數組 只取 id , address*/
//        dd($this->lunch->where('status', '0')->get(['id', 'address']));

        $data = [
            'pageName' => self::PAGENAME,
            'lunchList' => $lunchList,
//            'firstItem' => $lunchList[0],
        ];

        return view('index', $data);


    }

    public function list()
    {
        $per_page = 30;

        $lunchList = $this->lunch->OrderBy('id', 'desc')
            ->paginate($per_page);

        $data = [
            'pageName' => self::PAGENAME,
            'lunchList' => $lunchList,
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|max:60|unique:lunch',
            'address' => 'required|max:255',
            'status' => 'required|in:Y,N',
            'tel' => 'max:16',
            'menu' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'store_name.required' => '請填寫店家名稱',
            'store_name.max' => '店家名稱請小於60字元',
            'store_name.unique' => '店家名稱重複',
            'address.required' => '請填寫地址',
            'address.max' => '地址請小於255字元',
            'status.required' => '請選擇狀態',
            'tel.max' => '電話請小於16字元',
            'menu.image' => '請上傳圖片類型的檔案',
        ]);

        $data = $request->all();

        if ($request->hasFile('menu')) {
            if ($request->file('menu')->isValid()) {
                $extension = $request->file('menu')->getClientOriginalExtension();
                $fileName = 'menu_' . date('ymdHis') . '_' . Str::random(3) . '.' . $extension;

                /**
                 * config/filesystem.php
                 *
                 * 本例儲存圖片位置為public 而非storage
                 */

                /* move上傳 */
//                $request->file('menu')->move($this->destinationPath, $fileName);

                /* store上傳 */
//                $request->file('menu')->storeAs('upload', $fileName, 'public');

                /* Storage上傳 */
//                $image = $request->file('menu');
//                $img = Image::make($image->getRealPath());
//                $img->resize(120, null, function ($constraint) {
//                    $constraint->aspectRatio();
//                });
//                $img->stream();
//                Storage::disk('local')->put('upload/' . $fileName, $img, 'public');

                /* Image上傳 */
                $image = $request->file('menu');
                Image::make($image)->save($this->destinationPath . $fileName);

                $data['menu'] = $fileName;
            }
        }


        $this->lunch->create($data);
//        $this->lunch->create($request->all());
        return redirect()->route('lunch.item.index')
            ->with('success', '新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $lunchDatas = $this->lunch->findOrFail($request->id);
//        $lunchDatas = array('msg'=>'success');

        return json_encode($lunchDatas, true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'pageName' => self::PAGENAME,
            'lunch' => $this->lunch->findOrFail($id)
        ];
        return view('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'store_name' => 'required|max:60',
            'address' => 'required|max:255',
            'status' => 'required|in:Y,N',
            'tel' => 'max:16',
        ], [
            'store_name.required' => '請填寫店家名稱',
            'store_name.max' => '店家名稱請小於60字元',
            'address.required' => '請填寫地址',
            'address.max' => '地址請小於255字元',
            'status.required' => '請選擇狀態',
            'tel.max' => '電話請小於16字元',
            'menu.image' => '請上傳圖片類型的檔案',
        ]);

        $lunch = $this->lunch->findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('menu')) {
            if ($request->file('menu')->isValid()) {
                $extension = $request->file('menu')->getClientOriginalExtension();
                $fileName = 'menu_' . date('ymdHis') . '_' . Str::random(3) . '.' . $extension;

                /* Image上傳 */
                $image = $request->file('menu');
                Image::make($image)->save($this->destinationPath . $fileName);

                $oldfilename = $lunch->menu;

                if (!is_null($oldfilename)) {
                    if (file_exists(public_path('upload/' . $oldfilename))) {
                        unlink(public_path('upload/' . $oldfilename));
                    }
                }

                $data['menu'] = $fileName;
            }
        }


        $this->lunch->findOrFail($id)->update($data);
        return redirect()->route('lunch.item.index')
            ->with('success', '修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lunch = $this->lunch->findOrFail($id);
        $oldfilename = $lunch->menu;

        if (!is_null($oldfilename)) {
            if (file_exists(public_path('upload/' . $oldfilename))) {
                unlink(public_path('upload/' . $oldfilename));
            }
        }

        $this->lunch->findOrFail($id)->delete();
        return redirect()->route('lunch.item.index')
            ->with('success', '刪除成功');
    }


//    public function ajaxGetAddress(Request $request)
//    {
//        $lunchDatas = $this->lunch->findOrFail($request->id);
//
//        return json_decode($lunchDatas, true);
//    }

    public function changeStatus(Request $request)
    {
        $status = $request->status_mode == 'turnOn' ? 'Y' : 'N';
        $this->lunch->findOrFail($request->id)->update(['status' => $status]);
    }
}
