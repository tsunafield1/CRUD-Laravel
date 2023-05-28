<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(3);
        return view('product.index', compact('products'));
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required|unique:products|max:255',
            'image' => 'required|mimes:jpg,png,jpeg',
            'price' => 'required|max:11|'
        ],
        [
            'name.required' => 'กรุณาใส่ชื่อสินค้า',
            'name.unique' => 'ชื่อสินค้าซ้ำ',
            'name.max' => 'ชื่อสินค้าห้ามเกิน 255 ตัวอักษร',
            'image.required' => 'กรุณาใส่รูปสินค้า',
            'image.mimes' => 'กรุณาใส่ไฟล์ .jpg .jpeg .png เท่านั้น',
            'price.required' => 'กรุณาใส่ราคาสินค้า',
            'price.max' => 'ราคาสินค้าห้ามเกิน 11 หลัก'
        ]);

        $image = $request-> file('image');

        $gen_name = hexdec(uniqid());
        
        $ext = strtolower($image->getClientOriginalExtension());
        $image_name = $gen_name. '.' . $ext;

        $path = 'image/product/';
        $full_path = $path.$image_name;

        $image->move($path, $image_name);

        $product = new Product;
        $product->name = $request->name;
        $product->image = $full_path;
        $product->price = $request->price;
        $product->save();

        return redirect()->back()->with('success', 'เพิ่มสินค้าสำเร็จ');
    }

    public function edit($id){
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'mimes:jpg,png,jpeg',
            'price' => 'required|max:11|'
        ],
        [
            'name.required' => 'กรุณาใส่ชื่อสินค้า',
            'name.max' => 'ชื่อสินค้าห้ามเกิน 255 ตัวอักษร',
            'image.mimes' => 'กรุณาใส่ไฟล์ .jpg .jpeg .png เท่านั้น',
            'price.required' => 'กรุณาใส่ราคาสินค้า',
            'price.max' => 'ราคาสินค้าห้ามเกิน 11 หลัก'
        ]);

        $product = Product::find($request->id);

        if(empty($request->image)){
            $product->update([
                'name' => $request->name,
                'price' => $request->price
            ]);
        }
        else{
            $image = $request->file('image');
            $gen_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_name = $gen_name.'.'.$ext;

            $path = 'image/product/';
            $full_path = $path.$image_name;

            $image->move($path, $image_name);

            $old_image = $product->image;
            unlink($old_image);

            $product->update([
                'name' => $request->name,
                'image' => $full_path,
                'price' => $request->price
            ]);
        }
        
        return redirect()->route('product')->with('success', 'แก้ไขข้อมูลสินค้าสำเร็จ');
    }

    public function delete($id){
        $product = Product::find($id);
        $image = $product->image;
        unlink($image);

        $product->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
