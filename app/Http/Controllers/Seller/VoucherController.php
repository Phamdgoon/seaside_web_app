<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voucher\CreateVoucherRequest;
use App\Models\Order_Detail;
use App\Models\ShopProfile;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VoucherController extends Controller
{
    protected $voucher;

    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $shopProfile = ShopProfile::where('username', $user->username)->first();
        $vouchers = $shopProfile->vouchers()->orderBy('created_at', 'asc')->paginate(4);

        return view('seller.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateVoucherRequest $request)
    {
        try {
            $user = auth()->user();

            // Query the ShopProfile model to get the name_shop
            $shopProfile = ShopProfile::where('username', $user->username)->first();
            $nameShop = $shopProfile->name_shop;
            Voucher::create([
                'code' => $request->input('code'),
                'name_shop' => $nameShop,
                'discountPercentage' => $request->input('discountPercentage'),
                'discountAmount' => $request->input('discountAmount'),
                'validFrom' => $request->input('validFrom'),
                'validTo' => $request->input('validTo'),
                'usageLimit' => $request->input('usageLimit'),
                'platformVoucher' => 1
            ]);

            Session::flash('success', 'Thêm voucher thành công');
        } catch (\Exception $err) {
            // Rollback transaction in case of any error
            DB::rollBack();
            // If an error occurs after the main product is saved, redirect back
            Session::flash('error', 'Thêm voucher lỗi');
            // \Log::error($err->getMessage());
            // dd($err->getMessage());
            return redirect()->back();
        }

        return redirect()->intended('/seller1/vouchers/list');
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
