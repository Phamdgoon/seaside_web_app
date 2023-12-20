<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\CategoryChild\CreateCategoryChildRequest;
use App\Models\Category;
use App\Models\Category_Child;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryChildController extends Controller
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
        $shopProfile = $request->shopProfile;
        $categories_child = $shopProfile->categories_child()->oldest('id')->paginate(5);
        $categories = Category::get(['id', 'name_category']);
        return view('seller.category-child.index', compact('categories_child', 'categories'));
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
    public function store(CreateCategoryChildRequest $request)
    {
        try {
            $nameShop = $request->nameShop;
            Category_Child::create([
                'name_category_child' => $request->input('name_category_child'),
                'id_category' => $request->input('id_category'),
                'name_shop' => $nameShop,
            ]);
    
            Session::flash('success', 'Thêm danh mục thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Thêm danh mục lỗi');
            // \Log::error($err->getMessage());
            dd($err->getMessage());
            return redirect()->back()->withInput();
        }
    
        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
