<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Category;
use App\Models\DeliveryCenters;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*user*/
Route::middleware('role.user')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});
/**/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'show_profile'])->name('show.profile');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/profile/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register/user', [UserController::class, 'register'])->name('register.user');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'register_index'])->name('index.register');
Route::get('/login', [UserController::class, 'login_index'])->name('index.login');
/*customer*/
Route::middleware(['role.customer'])->group(function () {
    Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/comment/{product}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/ticket', function () {
        return view('ticket');
    });
    Route::post('/ticket/', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/my-tickets', function () {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->paginate(10);
        return view('my-tickets', compact('tickets'));
    });
    Route::get('/ticket/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
    Route::get('/payment/form', [PaymentController::class, 'showForm'])->name('payment.form');
    Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/orders', function () {
        $orders = Transaction::where('user_id', Auth::id())->latest()->get();
        $customer = Auth::user();
        return view('orders', compact('orders', 'customer'));
    })->name('customer.orders');
    Route::get('/order/{id}', function ($id) {
        $transaction = Transaction::where('user_id', Auth::id())->with(['cart.cartItems' => function ($query) {
            $query->withTrashed();
        }, 'cart.cartItems.product'])
            ->where('id', $id)
            ->firstOrFail();

        return view('information-order', compact('transaction'));
    })->name('order.show');

});
/**/
Route::get('/about-us', function () {
    return view('about-us');
});
Route::get('/feq', function () {
    return view('feq');
});
Route::get('/', [CommentController::class, 'index'])->name('index');
Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/contact-us', function () {
    return view('contact-us');
});
Route::get('/page', function () {
    return view('page');
});

Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/{id}', [CategoryController::class, 'index'])->name('category.index');
/*seller*/
Route::middleware(['role.seller'])->group(function () {
    Route::post('/category/add', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/product-create', function () {
        $categories = Category::all();
        return view('product-create', compact('categories'));
    });
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('my-products', function () {
        $categories = Category::all();
        $products = auth()->user()->products()->latest()->get();
        return view('my-products', compact('products', 'categories'));
    });
});

/*Admin and seller*/
/**/
/*admin*/
Route::middleware(['role.admin'])->prefix('/panel')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/reply/{ticket}', [TicketController::class, 'show_reply'])->name('ticket.show.reply');
    Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('reply.ticket');
    Route::delete('/ticket/destroy/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');
    Route::post('/ticket/close/{id}', [TicketController::class, 'close'])->name('ticket.close');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.admin.delete');
    Route::get('/tickets', function () {
        $tickets = Ticket::orderby('created_at', 'asc')->get();
        return view('tickets-for-admin', compact('tickets'));
    })->name('tickets.admin');
    Route::get('/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::get('/user/restore/{id}', [AdminController::class, 'restore_user'])->name('user.restore');
    Route::get('/user/edit/{user}', [AdminController::class, 'edit'])->name('user.admin.edit');
    Route::put('/user/update/{id}', [AdminController::class, 'user_update'])->name('user.admin.update');
    Route::delete('/user/delete/{id}', [AdminController::class, 'delete_user'])->name('user.admin.delete');
    Route::get('/user/show/{id}', [AdminController::class, 'show_user'])->name('user.admin.show');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/show/{id}', [AdminController::class, 'show_product'])->name('admin.product.show');
    Route::get('/products/edit/{id}', [AdminController::class, 'edit_product'])->name('admin.product.edit');
    Route::put('/products/update/{id}', [AdminController::class, 'update_product'])->name('admin.product.update');
    Route::delete('/products/delete/{id}', [AdminController::class, 'delete_product'])->name('admin.product.delete');
    Route::delete('/products/comment/delete/{id}', [AdminController::class, 'delete_comment'])->name('admin.comment.delete');
    Route::post('/categories/store', [AdminController::class, 'store_category'])->name('admin.category.store');
    Route::put('/categories/update/{id}', [AdminController::class, 'update_category'])->name('admin.category.update');
    Route::delete('/categories/delete/{id}', [AdminController::class, 'delete_category'])->name('admin.category.delete');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/delivery/centers', [AdminController::class, 'delivery_centers'])->name('admin.delivery.centers');
    Route::get('/delivery/centers/create', [AdminController::class, 'delivery_center_create'])->name('center.create');
    Route::post('/delivery/centers/store', [AdminController::class, 'delivery_center_store'])->name('center.store');
    Route::delete('/delivery/centers/delete/{id}', [AdminController::class, 'delivery_center_delete'])->name('center.delete');
    Route::get('/generate-password', [AdminController::class, 'generate_password'])->name('generate.password');
    Route::get('/order/{id}', [AdminController::class, 'information_order'])->name('admin.order.show');
});
/**/




