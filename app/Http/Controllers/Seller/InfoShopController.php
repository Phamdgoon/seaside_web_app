<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\UpdateInfoshopRequest;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InfoShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('shopProfile');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shopProfiles = $request->shopProfile;
        return view('seller.info-shop.index', compact('shopProfiles'));
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
        //
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
    public function edit(string $id, Request $request)
    {
        $shopProfiles = $request->shopProfile->findOrFail($id);

        return view('seller.info-shop.update', compact('shopProfiles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfoshopRequest $request, string $id)
    {
        try {
            $infoShop = ShopProfile::findOrFail($id);

            $infoShop->name_shop = $request->input('name_shop');
            $infoShop->address = $request->input('address');

            $file_name_avt = $infoShop->avt;
            if ($request->hasFile('image_upload_avt')) {
                $file = $request->file('image_upload_avt');
                $ext = $file->extension();
                $file_name_avt = 'avt-' . uniqid() . '.' . $ext;;
                $file->move(public_path('images/seller/info-shop'), $file_name_avt);
                $infoShop->avt = $file_name_avt;
            }

            $file_name_cover = $infoShop->cover_image;
            if ($request->hasFile('image_upload_cover')) {
                $file = $request->file('image_upload_cover');
                $ext = $file->extension();
                $file_name_cover = 'cover-' . uniqid() . '.' . $ext;;
                $file->move(public_path('images/seller/info-shop'), $file_name_cover);
                $infoShop->cover_image = $file_name_cover;
            }

            $infoShop->save();

            Session::flash('success', 'Cập thông tin shop thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập thông tin shop lỗi');
            // \Log::error($err->getMessage());
            // dd($err->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->intended('/seller1/infos/info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
