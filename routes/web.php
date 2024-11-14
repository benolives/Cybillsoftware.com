<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

use App\Mail\PurchaseConfirmation;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\payments\mpesa\MpesaController;
use App\Http\Controllers\payments\mpesa\MpesaB2BController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BlogController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Email Sending Test Route
Route::get('/send-test-email', function () {
    $email = 'gababoabdiaelema@gmail.com';
    $customerName = 'John Doe'; // 
    $productId = 123;
    $productName = 'Sample Product'; // Add the correct product name here
    $amount = 1000; // Add the correct amount here
    $transactionDate = null; // You can set a date if needed
    $keyCode = null; // You can set a keyCode if needed

    Mail::to($email)->send(new PurchaseConfirmation($email, $productId, $productName, $amount, $transactionDate, $keyCode));
  
    return 'Test email sent!';
});

/*========================================================================================\
                                Database connection test route
\*========================================================================================*/
Route::get('/test-database', function () {
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to database: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Could not connect to the database. Error: " . $e->getMessage());
    }
});

/*========================================================================================\
                            Listing all the routes
\*========================================================================================*/
Route::get('/routes', function() {
    $routeCollection = Route::getRoutes();
    echo "<table style='width:100%'>";
    echo "<tr><th>HTTP Method</th><th>Route</th><th>Controller</th></tr>";
    foreach ($routeCollection as $value) {
        echo "<tr><td>" . $value->methods()[0] . "</td><td>" . $value->uri() . "</td><td>" . $value->getActionName() . "</td></tr>";
    }
    echo "</table>";
});


/*========================================================================================\
                                Common page Route... 
\*========================================================================================*/
//home page
Route::get('/', [AppController::class, 'index'])->name('app.index');
//about page
Route::get('/about-us', [AppController::class, 'show_About_us'])->name('about-us');
Route::get('/contact-us', [AppController::class, 'show_Contact_us'])->name('contact-us');


/*========================================================================================\
                                The Authentication Routes... 
\*========================================================================================*/

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send');
});


Route::get('register', function () {
    //check if the user is logged in
    if (Auth::check()) {
        // Set a toast message in session
        session()->flash('toast', 'You are already have an account and logged in!');
        return redirect('/');
    }
    //otherwise sho the login page
    return view('auth.register');
})->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/login', function () {
    //check if the user is logged in
    if (Auth::check()) {
        // Set a toast message in session
        session()->flash('toast', 'You are already logged in!');

        //if logged in redirect user to home page with a message on a toast
        return redirect('/');
    }
    //otherwise sho the login page
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*========================================================================================\
                                  PRODUCTS  ROUTES       
    This Routes are wrapped by 'auth' middleware to ensure that they are protected. only 
    logged in users can access them.
\*========================================================================================*/
Route::middleware(['auth'])->group(function () {
    //Route to display a page to choose products the partner wants to sell
    Route::get('/select-products', [ProductsController::class, 'showAvailableProducts'])->name('select-products');
    //Route to display all the products
    Route::get('/products', [ProductsController::class, 'showProductsPage'])->name('products.index');
    
    //Route for displaying kaspersky products
    Route::get('/products/kaspersky', [ProductsController::class, 'showKasperskyProducts'])->name('products.kaspersky');
    // Route for desplaying the specific kaspersky product
    Route::get('/products/kaspersky/{id}', [ProductsController::class, 'showSpecificKasperskyProduct'])->name('product.show_kaspersky_prod');
   
    //Route for displayinh bitdefender products
    Route::get('/products/bitdefender', [ProductsController::class, 'showBitdefenderProducts'])->name('products.bitdefender');
    // Route for desplaying the specific product
    Route::get('/products/{id}', [ProductsController::class, 'showSpecificProduct'])->name('product.details');
    // Route for displaying the product receipt
    Route::get('/purchase/receipt/{id}', [ProductsController::class, 'showReceipt'])->name('purchase.receipt');
});

/*========================================================================================\
                                The user dashboard Route
\*========================================================================================*/
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
});


/*========================================================================================\
                                ADMIN dashboard Route
\*========================================================================================*/
Route::get('/admin/dashboard', [AdminDashboardController::class, 'showAdminDashboard'])->name('admin.dashboard');

/*========================================================================================\
                                The Mpesa STKPUSH/MPESA EXPRESS payment Routes... 
\*========================================================================================*/

Route::get('/modal/{product}', [MpesaController::class, 'showModal'])->name('modal.show');
Route::post('/checkout/{productId}', [MpesaController::class, 'processCheckout'])->name('processCheckout');
//initiate stk push
Route::post('/stkpush/{productId}', [MpesaController::class, 'initiateStkPush'])->name('initiateStkPush');
Route::any('/stkcallback', [MpesaController::class, 'stkCallback'])->name('stkcallback');
Route::get('/payment-status/{checkoutRequestId}', [MpesaController::class, 'getStatus'])->name('payment.status');

Route::get('/checkout', 'CheckoutController@showCheckoutForm')->name('checkout.form');
Route::post('/checkout', 'CheckoutController@processCheckout')->name('checkout.process');
Route::post('/checkout/{productId}', [CheckoutController::class, 'processCheckout'])->name('processCheckout');
//Route::post('/initiate-payment', [\App\Http\Controllers\payments\mpesa\MpesaController::class, 'initiatePayment']);
Route::post('/mpesa/callback', [MpesaController::class, 'stkCallback']);
Route::post('/purchase/confirm', [PurchaseController::class, 'confirmPurchase'])->middleware('auth');


/*========================================================================================\
                                The Mpesa B2B/BUSINESS PAYBILL payment Routes... 
\*========================================================================================*/
Route::post('/cybill/b2b/payBenOlives', [MpesaB2BController::class, 'initiateB2B'])->name('initiateB2B');
Route::any('/b2bcallback', [MpesaB2BController::class, 'b2BCallback']);
Route::any('/timeoutUrl', [MpesaB2BController::class, 'PaymentProcessTimeOut']);

/*========================================================================================\
                             Send Email Enquiry route When someone sends
                             from frontend 
\*========================================================================================*/
Route::post('/enquiry-email', [YourController::class, 'makeEnquiry'])->name('makeEnquiry');



/*========================================================================================\
                                Password reset routes 
\*========================================================================================*/
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// Symlink Creation Route (Remove in production)
Route::get('/symlink', function () {
   $target = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
   $link = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
   symlink($target, $link);
   echo "Done";
});

Route::get('/run-migrations', function () {
    Artisan::call('migrate');

    return 'Migrations run successfully!';
});

Route::get('/migration-status', function () {
    $status = \Illuminate\Support\Facades\Artisan::call('migrate:status');
    return response()->json(['status' => $status]);
});

// Clear cache
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'Cache cleared';
});

// Define routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
});
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


/*========================================================================================\
                                This is a temporary route that we will delete
                                after setting up a cron job or finding better method
\*========================================================================================*/
// routes/web.php

use App\Services\KasperskyBenOlivesApiService;

Route::get('/fetch', function (KasperskyBenOlivesApiService $kasperskyService) {
    try {
        // Call the service to fetch and store products
        $kasperskyService->fetchKasperskyProductsAndStoreInDb();
        
        // Return a success message in the browser
        return response()->json([
            'status' => 'success',
            'message' => 'Kaspersky products fetched and stored successfully!'
        ]);
    } catch (\Exception $e) {
        // In case of an error, return an error message
        return response()->json([
            'status' => 'error',
            'message' => 'There was an issue fetching the products: ' . $e->getMessage()
        ], 500);
    }
});

/*========================================================================================\
             THIS IS THE BLOGS ROUTE. FOR NOw it is hardcoded but we will will implement
             dynamic content using The News Api it has a free tier version
             that can handle 100 requests per day. and We will only need probably
             One request daily based on how we structure the application
\*========================================================================================*/
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');