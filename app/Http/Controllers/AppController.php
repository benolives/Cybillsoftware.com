<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BlogController;

/**
 * Class AppController
 * 
 * This controller handles the application's main views and interactions.
 */
class AppController extends Controller
{
    /**
     * Display the index view.
     *
     * This method returns the main index view of the application,
     * which serves as the entry point for users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //This data containing how it works steps that we will show in our home page
        $howItWorksSteps = [
            [
                'title' => 'Step 1: Create an Account',
                'description' => 'Sign up and create an account to get access to our reseller platform.',
                'more_info' => 'To begin your journey, sign up with us by providing basic details such as your name, email, and password. You will then have full access to the reseller platform.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>'
            ],
            [
                'title' => 'Step 2: Verify Email',
                'description' => 'Check your inbox for a verification email to confirm your registration.',
                'more_info' => 'Once you sign up, you will receive a verification email. Please click the verification link in the email to confirm your registration and activate your account.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M560-520h280v-200H560v200Zm140-50-100-70v-40l100 70 100-70v40l-100 70ZM80-120q-33 0-56.5-23.5T0-200v-560q0-33 23.5-56.5T80-840h800q33 0 56.5 23.5T960-760v560q0 33-23.5 56.5T880-120H80Zm556-80h244v-560H80v560h4q42-75 116-117.5T360-360q86 0 160 42.5T636-200ZM360-400q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM182-200h356q-34-38-80.5-59T360-280q-51 0-97 21t-81 59Zm178-280q-17 0-28.5-11.5T320-520q0-17 11.5-28.5T360-560q17 0 28.5 11.5T400-520q0 17-11.5 28.5T360-480Zm120 0Z"/></svg>'
            ],
            [
                'title' => 'Step 3: Choose Products',
                'description' => 'Pick the software products you want to resell and start earning commissions.',
                'more_info' => 'After confirming your email, you can log in to the platform and choose the software products you\'d like to resell. You will see a variety of products with full details, features, and prices.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m260-520 220-360 220 360H260ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-20v-320h320v320H120Zm580-60q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-500-20h160v-160H200v160Zm202-420h156l-78-126-78 126Zm78 0ZM360-340Zm340 80Z"/></svg>'
            ],
            [
                'title' => 'Step 4: View Product Details',
                'description' => 'Click on a product to see its details, including features, advantages, and installation instructions.',
                'more_info' => 'Click on the desired product to view more detailed information, including its features, advantages, and instructions on how to install it for your clients.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>'
            ],
            [
                'title' => 'Step 5: Make the Purchase',
                'description' => 'Buy the product for your clients, and they will receive a payment link.',
                'more_info' => 'After selecting the product, proceed to make the purchase. You can buy the product directly for your clients using secure payment methods.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>'
            ],
            [
                'title' => 'Step 6: Complete the Payment',
                'description' => 'The client will receive a payment link (via STK Push) to complete the purchase.',
                'more_info' => 'Once the product is selected, your client will receive a payment link through STK Push. They can complete the payment using mobile money or other available methods.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/></svg>'
            ],
            [
                'title' => 'Step 7: Earnings Dashboard',
                'description' => 'Once the payment is successful, you can view your earnings and commissions in your dashboard.',
                'more_info' => 'After the payment is confirmed, you will be able to see your earnings and commissions in your personal dashboard. You can track your progress and earnings over time.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>'
            ],
            [
                'title' => 'Step 8: Client Receives Product Info',
                'description' => 'Your client will receive an email with the product activation code and a download link.',
                'more_info' => 'Once the transaction is completed, your client will receive an email containing the activation code and a link to download the software.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M640-200v80q0 17-11.5 28.5T600-80H120q-17 0-28.5-11.5T80-120v-320q0-17 11.5-28.5T120-480h120v-160q0-100 70-170t170-70h160q100 0 170 70t70 170v560h-80v-120H640Zm0-80h160v-360q0-66-47-113t-113-47H480q-66 0-113 47t-47 113v160h280q17 0 28.5 11.5T640-440v160ZM400-560v-80h320v80H400Zm-40 274 200-114H160l200 114Zm0 70L160-330v170h400v-170L360-216ZM160-400v240-240Z"/></svg>'
            ],
            [
                'title' => 'Step 9: Repeat the Process',
                'description' => 'The process is complete. You can repeat the process and continue earning commissions.',
                'more_info' => 'You can now repeat this process with different products or clients, earning commissions each time you successfully resell a product.',
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M160-160v-80h110l-16-14q-52-46-73-105t-21-119q0-111 66.5-197.5T400-790v84q-72 26-116 88.5T240-478q0 45 17 87.5t53 78.5l10 10v-98h80v240H160Zm400-10v-84q72-26 116-88.5T720-482q0-45-17-87.5T650-648l-10-10v98h-80v-240h240v80H690l16 14q49 49 71.5 106.5T800-482q0 111-66.5 197.5T560-170Z"/></svg>'
            ]
        ];
        // Get the latest blogs from the BlogController (you can also directly fetch them here)
        $blogs = (new BlogController())->getLatestBlogs();

        return view('index', ['blogs' => $blogs], compact('howItWorksSteps'));
    }
    public function show_About_us()
    {
        return view('about_us');
    }
    public function show_Contact_us()
    {
        return view('contact_us');
    }
}