<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::orderBy('id', 'desc')->get();
        return view('admin.category.category', [
            'categorys' => $categorys,
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Danh mục đã được xóa thành công.');
    }

    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $category = new Category;
        $category->name_category = $request->input('category_name');
        $category->url_category = 'generate_unique_url_here'; // Bạn có thể tạo một hàm để tạo URL duy nhất
        $category->save();
    
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('profile_images','public');
            $category->update(['url_category' => Storage::url($imagePath)]);
            
        }
    
        return redirect()->route('admin.category')->with('success', 'Danh mục đã được thêm thành công');
    }    
    public function editCategory($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->route('admin.category')->with('error', 'Danh mục không tồn tại.');
        }
    
        return view('admin.category.edit', compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
        // Xử lý validation tương tự như phương thức storeCategory
    
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->route('admin.category')->with('error', 'Danh mục không tồn tại.');
        }
    
        $category->name_category = $request->input('category_name');
    
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('profile_images','public');
            $category->update(['url_category' => Storage::url($imagePath)]);
        }
    
        $category->save();
    
        return redirect()->route('admin.category')->with('success', 'Danh mục đã được cập nhật thành công.');
    }
        
}
