<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentRequest;
use App\Models\Product;
use App\Models\Client;
use App\Models\ProductKeys;
use App\Models\Category;
use App\Models\B2BPaymentBenOlives;
use App\Models\KasperskyKey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserRegistered;

class AdminController extends Controller
{
    // Render the full layout with the dashboard content
    public function loadDashboard()
    {
        $totalCustomers = Client::count();
        $totalRevenue = Client::sum('product_price');
        $totalCommissions = Client::sum('commission_received');
        $totalPartners = User::where('is_admin', false)->count();
        $totalProducts = Product::count();
        $totalProductKeys = ProductKeys::count();
        $inStockProducts = Product::where('stock_status', 'instock')->count();
        $outOfStockProducts = Product::where('stock_status', 'outofstock')->count();
        $kasperskyCategory = Category::where('slug', 'kaspersky')->first();
        $bitdefenderCategory = Category::where('slug', 'bitdefender')->first();

        $totalkasperskyProducts = Product::where('category_id', $kasperskyCategory->id)->count();
        $totalbitdefenderProducts = Product::where('category_id', $bitdefenderCategory->id)->count();

        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        return view('admin.sections.dashboardContent', compact(
            'totalCustomers', 
            'totalRevenue', 
            'totalPartners',
            'totalCommissions',
            'totalProducts',
            'totalProductKeys',
            'outOfStockProducts',
            'inStockProducts',
            'totalkasperskyProducts',
            'totalbitdefenderProducts',
            'notifications'
        ));
    }

    //Show the partner creation form
    public function show_partner_form()
    {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        return view('admin.sections.add_partner', compact('notifications'));
    }

    //add partner to database:
    public function addNewPartnerToDatabase(Request $request) {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed', // Ensure password matches confirm_password
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Custom error messages
            $errorMessage = 'Oops! Something went wrong. Please check the details and try again.';

            // Check specific errors and modify message accordingly
            if ($validator->errors()->has('email')) {
                $errorMessage = 'This email address is already in use. Please try another email.';
            } elseif ($validator->errors()->has('password')) {
                $errorMessage = 'Your passwords don\'t match. Please ensure both fields are identical.';
            } elseif ($validator->errors()->has('phone')) {
                $errorMessage = 'Please enter a valid phone number.';
            }

            // Store the error message in the session
            session()->flash('error', $errorMessage);

            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create the user instance (if validation passes)
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->utype = 'USR';
        $user->name_of_company = $request->input('company');
        $user->phone = $request->input('phone');
        $user->remember_token = null;
        $user->email_verified_at = Carbon::now();
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->is_admin = 0;

        // Save the user to the database
        $user->save();

        session()->flash('success', 'New partner added successfully!');
        Log::info("New partner added successfully: " . $user->name);

        // Notify the admin that new user has been added
        $admin = User::where('is_admin', true)->first();
        $admin->notify(new NewUserRegistered($user));

        return redirect()->route('admin.dashboard');
    }

    //fetch all the client
    public function allClients()
    {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        //retrieve all the clients
        $allClients = Client::all();
        $products = Product::all();
        return view('admin.sections.all_clients', compact('allClients', 'products', 'notifications'));
    }
    public function kasperskyClients()
    {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Find the category with the slug 'kaspersky'
        $kasperskyCategory = Category::where('slug', 'kaspersky')->first();
        
        if (!$kasperskyCategory) {
            // If no category is found, return an empty collection
            $kasperskyClients = collect();
        } else {
            // Step 2: Get all product IDs that belong to the "Kaspersky" category
            $kasperskyProducts = Product::where('category_id', $kasperskyCategory->id)->get();
        }
        if ($kasperskyProducts->isEmpty()) {
            $kasperskyClients = collect();
        } else {
            // Step 3: Retrieve clients whose product_id matches any of the found product IDs
            // Get only the product IDs
            $productIds = $kasperskyProducts->pluck('id'); 

            // Fetch clients with the corresponding product IDs
            $kasperskyClients = Client::whereIn('product_id', $productIds)->get();
            Log::info('Checking Kaspersky clients:', $kasperskyClients->toArray());
        }

        // Return to the view with the Kaspersky clients
        return view('admin.sections.kaspersky_clients', compact('kasperskyClients', 'notifications'));
    }

    //retrieve all partners
    public function getAllPartners(Request $request) {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Start the query for non-admin users by default
        $query = User::query();
    
        // Filter based on admin or non-admin status
        if ($request->has('filter')) {
            if ($request->filter == 'admin') {
                $query->where('is_admin', 1);
            } elseif ($request->filter == 'non-admin') {
                $query->where('is_admin', 0);
            } elseif ($request->filter == 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->filter == 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }
    
        // Retrieve the filtered partners
        $allPartners = $query->get();
    
        return view('admin.sections.all_partners', compact('allPartners', 'notifications'));
    }

    //retrieve completed orders
    public function getCompletedOrders() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Fetch completed orders with their related product details
        $orders = Order::with('product')->where('status', 'completed')->get();

        // Pass the orders to the view
        return view('admin.sections.completed_orders', compact('orders', 'notifications'));
    }

    //retrieve Incompleted orders
    public function getIncompletedOrders() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Fetch incompleted orders with their related product details
        $orders = Order::with('product')->where('status', 'pending')->get();

        // Pass the orders to the view
        return view('admin.sections.pending_orders', compact('orders', 'notifications'));
    }

    //retreive payments to benolives
    public function getPaymentsToBenolives() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Fetch all payments to Ben Olives
        $paymentsToBenOlives = B2BPaymentBenOlives::all();

        return view('admin.sections.payments_to_benolives', compact('paymentsToBenOlives', 'notifications'));
    }

    //kaspersky keys
    public function getKasperskyKeys() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        $kaspersky_keys = KasperskyKey::all();
        return view('admin.sections.kaspersky_keys', compact('notifications', 'kaspersky_keys'));
    }

    //bitdefender keys
    public function getBitdefenderKeys() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        $bitdefender_keys = BitdefenderKey::all();
        return view('admin.sections.bitdefender_keys', compact('notifications', 'kaspersky_keys'));
    
    }

    //retreve bitdefender products
    public function getBitdefenderProducts() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        // Retrieve all products with the slug 'bitdefender'
        $products = Product::where('slug', 'bitdefender')->get();

        return view('admin.sections.bitdefender_products', compact('products', 'notifications'));
    }

    //retrieve the form page to add bidefender products
    public function showFormPageToAddBitdefenderProduct() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        return view('admin.sections.add_bitdefender_product', compact('notifications'));
    }

    //add bitdefender product to the database.
    public function addNewBitdefenderProduct(Request $request)
    {
        // Log the incoming request data
        Log::info('Incoming Bitdefender Product Data:', $request->all());

        // Convert some values from string to number (float)
        $discountPercentage = floatval($request->input('discount_percentage', 0));
        $priceOffer = floatval($request->input('price_offer', 0));

        // Log the converted values to check them
        Log::info("Converted discount_percentage: $discountPercentage");
        Log::info("Converted price_offer: $priceOffer");

        // Validate incoming data
        Log::info("Validating incoming data...");
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'discount_percentage' => 'nullable|numeric',
            'compatibility' => 'nullable|array',
            'price' => 'required|numeric',
            'price_offer' => 'nullable|numeric',
            'stock_status' => 'required|in:instock,outofstock',
            'commission_percentage' => 'nullable|numeric',
            'slug' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::error("Validation failed for bitdefender product data", [
                'errors' => $validator->errors(),
            ]);
            return redirect()->route('admin.error')
                ->with('message', 'Validation failed. Please check the input fields.')
                ->with('icon', 'error-icon') // Example icon, customize with Kai Admin or FontAwesome icon
                ->with('details', $validator->errors());
        }

        // Log successful validation
        Log::info("Validation passed successfully");

        // Fetch the category whose slug is 'bitdefender'
        Log::info("Fetching category with slug 'bitdefender'...");
        $category = Category::where('slug', 'bitdefender')->first();

        if (!$category) {
            Log::error("Category 'bitdefender' not found.");
            return redirect()->route('admin.error')
                ->with('message', 'Category "bitdefender" not found.')
                ->with('icon', 'error-icon') // Customize this
                ->with('details', 'The category for Bitdefender was not found in the database. Please contact support.');
        }

        // Log the category found
        Log::info("Category found: ", ['category_id' => $category->id, 'category_slug' => $category->slug]);

        // Prepare the data to save, including fields not sent from the frontend
        $productData = [
            'category_id' => $category->id,
            'product_name' => $request->input('product_name'),
            'product_plan_name' => null,
            'description' => $request->input('description'),
            'reviews' => 0,
            'discount_percentage' => $discountPercentage,
            'compatibility' => json_encode($request->input('compatibility', [])),
            'benefits' => json_encode([]),
            'learn_more_link' => null,
            'product_link' => null,
            'price' => $request->input('price'),
            'price_offer' => $priceOffer,
            'price_partner' => null,
            'stock_status' => $request->input('stock_status'),
            'quantity' => 0,
            'image_url' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'commission_percentage' => $request->input('commission_percentage', 0),
            'last_updated_at' => Carbon::now(),
            'product_api_id' => null,
            'slug' => $request->input('slug'),
        ];

        try {
            // Log that product creation is starting
            Log::info("Creating new Bitdefender product in the database...");
            $product = Product::create($productData);

            // Log the product creation success
            Log::info("Product created successfully: ", ['product_id' => $product->id]);

            // After creation, update the product_api_id to match the product's id
            $product->product_api_id = $product->id;

            // Log before saving the updated product
            Log::info("Updating product_api_id for product with ID: {$product->id}");
            $product->save();

            // Redirect to success page with product details
            return redirect()->route('admin.success')
                ->with('message', 'Bitdefender product added successfully!')
                ->with('icon', 'success-icon')
                ->with('product', $product)
                ->with('allProductsLink', route('admin.bitdefender_products'));
        } catch (\Exception $e) {
            // Log the error if the product creation or update fails
            Log::error("Error while adding product", [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.error')
                ->with('message', 'Error while adding product')
                ->with('icon', 'error-icon') // Customize this
                ->with('details', 'An error occurred while trying to add the product. Please try again or contact support.');
        }
    }

    public function handleSuccessfulAction() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        // Get product data from the session
        $product = session('product');

        return view('admin.sections.success', compact('notifications', 'product'));
    }

    public function handleErrorInstance() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        return view('admin.sections.error', compact('notifications'));
    }
}
