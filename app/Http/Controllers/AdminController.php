<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\StoreDeliveryCenterRequest;
use App\Http\Requests\UpdateProduct_AdminRequest;
use App\Http\Requests\UpdateUser_AdminRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\DeliveryCenters;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showUsers()
    {
        $users = User::withTrashed()->latest()->paginate(20);
        return view('users', compact('users'));
    }
    public function edit(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $roles = Role::all();
        return view('edit-users-for-admin', compact('user', 'roles'));
    }

    public function user_update(UpdateUser_AdminRequest $request, string $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'store_name' => $request->store_name,
            'store_phone' => $request->store_phone,
            'store_address' => $request->store_address,
            'license_number' => $request->license_number,
        ]);
        if (!empty($request->role)) {
            $user->roles()->detach();
            $user->roles()->attach($request->role);
        }
        return redirect('/panel/users')->with('success','اطلاعات کاربر به روزرسانی شد');
    }
    public function delete_user(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        return redirect()->back()->with('massage', '.حساب کاربر حذف شد');
    }

    public function show_user(string $id)
    {
        $user = User::withTrashed()->where('id', $id)->firstOrFail();
        return view('show-user-for-admin', compact('user'));
    }
    public function restore_user(string $id)
    {
        $user = User::withTrashed()->where('id', $id)->firstOrFail();
        $user->restore();
        return redirect()->back();
    }

    public function products()
    {
        $products = Product::withTrashed()->latest()->paginate(20);
        $categories = Category::all();

        return view('products-for-admin', compact('products', 'categories'));
    }

    public function show_product(string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $averageRating = $product->comments()->avg('rate') ?? 0;
        $comments = Comment::where('product_id', $id)->get();

        return view('showProduct-for-admin', compact('product', 'averageRating', 'comments'));
    }

    public function edit_product(string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $categories = Category::all();
        return view('editProduct-for-admin', compact('product', 'categories'));
    }

    public function update_product(UpdateProduct_AdminRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if (!empty($product->image_url)) {
                $oldImagePath = str_replace('/storage/', 'public/', $product->image_url);
                Storage::delete($oldImagePath);
            }
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/images', $fileName);

            $publicPath = Storage::url($path);

            $product->image_url = $publicPath;
        } else {
            $publicPath = $product->image_url;
        }
        if (!$request->hasFile('image')) {
            if (!$product->image_url) {
                return redirect()->back()->withErrors('لطفا یک تصویر اپلود کنید')->withInput();
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'category_id' => $request->category_id,
            'image_url' => $publicPath,
        ]);
        /*مسیر برای انتقال دقیق به محصولات ادیت شده*/
        return redirect('/panel/products#product-' . $id);
    }

    public function delete_product(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_url) {
            $imagePath = str_replace('/storage/', 'public/', $product->image_url);
            Storage::delete($imagePath);
        }
        $product->delete();

        return redirect('/panel/products')->with('با موفقیت حذف شد');

    }

    public function store_category(CategoryCreateRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->to('/panel/products#id-' . $category->id)
            ->with('success', 'دسته‌بندی با موفقیت اضافه شد.');
    }

    public function update_category(CategoryCreateRequest $request, string $id)
    {
        $request->validate([
            'name' => 'nullable|string|min:3|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);
        $path = '/panel/products#id-' . $category->id;

        return redirect($path);
    }

    public function delete_category(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Product::where('category_id', $id)->delete();

        return redirect('/panel/products#categories')->with('<UNK> <UNK> <UNK> <UNK>');
    }

    public function dashboard()
    {
        return view('dashboard-admin', [
            'productsCount' => Product::count(),
            'categoriesCount' => Category::count(),
            'usersCount' => User::withTrashed()->count(),
            'totalSales' => Transaction::sum('amount'),
            'latestOrders' => Transaction::latest()->take(5)->get(),
        ]);
    }

    public function orders()
    {
        $orders = Transaction::all();
        return view('orders-for-admin', compact('orders'));
    }

    public function delivery_center_create()
    {
        return view('delivery-center-create');
    }

    public function delivery_center_store(StoreDeliveryCenterRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/delivery-images', $fileName);
            $publicPath = Storage::url($path);
        } else $publicPath = null;

        DeliveryCenters::create([
            'name' => $request->name,
            'image_url' => $publicPath,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.delivery.centers')->with('success','مرکز تحویل با موفقیت ثبت شد');
    }

    public function delivery_center_delete(string $id)
    {
        $center = DeliveryCenters::where('id', $id)->firstOrFail();
        $center->delete();
        return redirect()->back()->with('success','مرکز تحویل با موفقیت حذف شد');
    }

    public function delivery_centers()
    {
        $centers = DeliveryCenters::all();
        return view('delivery-centers', compact('centers'));
    }
    public function delete_comment(string $id)
    {
        Comment::where('id', $id)->delete();
        return redirect()->back();
    }
    public function generate_password()
    {
        return response()->json(['password' => \Illuminate\Support\Str::password(10,true,true,false)]);
    }
    public function information_order(string $id)
    {
        $transaction = Transaction::with(['cart.cartItems' => function ($query) {
            $query->withTrashed();
        }, 'cart.cartItems.product'])
            ->where('id', $id)
            ->firstOrFail();

        return view('information-order-for-admin', compact('transaction'));
    }
}
