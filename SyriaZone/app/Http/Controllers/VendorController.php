<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getVendorOrders()
    {
        $user_id=Auth::user();
        $vendor=vendor::findOrfail($user_id->vendor->id);
        $orders = $vendor->orders()
            ->with(['order:id,status,created_at', 'Product:id,name'])
            ->get();

        return response()->json(['orders' => $orders], 200);
    }


    public function getVendorOrdersByStatus(Request $request)
    {
        // التحقق من أن status موجود في الطلب
        $request->validate([
            'status' => 'required|string|in:pending,complete,cancelled',
        ]);

        $status = $request->status;
        $user_id=Auth::user();
        $vendor=vendor::findOrfail($user_id->vendor->id);
        // جلب الطلبات بناءً على الحالة
        $orders = $vendor->orders()
            ->where('status', $status)
            ->with(['order:id,status,created_at', 'Product:id,name'])
            ->get();

        return response()->json(['orders' => $orders], 200);
    }

    public function getOrdersByProductId($id)
    {
        // جلب المستخدم الحالي
        $user = Auth::user();

        // التحقق من وجود التاجر المرتبط بالمستخدم
        if (!$user || !$user->vendor) {
            return response()->json(['error' => 'Vendor not found for the current user.'], 403);
        }

        // جلب التاجر المرتبط
        $vendor = $user->vendor;

        // البحث عن المنتج بناءً على ID المنتج ومعرف التاجر
        $product = Product::where('id', $id)
            ->where('vendor_id', $vendor->id)
            ->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found or does not belong to this vendor.'], 404);
        }

        // جلب الطلبات المتعلقة بالمنتج
        $orders = $product->order_product()
            ->with(['order:id,status,created_at'])
            ->get();

        return response()->json(['orders' => $orders], 200);
    }




}
