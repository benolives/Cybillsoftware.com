<?php

// app/Http/Controllers/BlogController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Hardcoded blog posts for now but we will use News Api when we are ready
    // or another news letter api
    protected $blogs = [
        [
            'slug' => 'introducing-kaspersky-next',
            'title' => 'Introducing — Kaspersky Next: A New Portfolio of Security Solutions',
            'author' => 'Kaspersky Team',
            'date' => '2024-04-10',
            'excerpt' => 'Kaspersky Next redefines corporate security by offering seamless and customer-friendly solutions designed to combat modern cyber threats with EDR and XDR capabilities.',
            'content' => 'Kaspersky has decided to revise its portfolio and make it as seamless and customer-friendly as possible. This post explains the changes in Kaspersky’s new approach, which includes the core integration of Endpoint Detection & Response (EDR) and Extended Detection and Response (XDR) tools. Learn how Kaspersky Next simplifies security for businesses and why it’s the future of corporate cybersecurity...',
            'image' => 'https://media.kasperskydaily.com/wp-content/uploads/sites/92/2024/04/10055318/kaspersky-next-new-portfolio-Featured.jpg',
        ],
        [
            'slug' => 'how-to-install-and-update-kaspersky-apps-for-android',
            'title' => 'How to install and update Kaspersky apps for Android',
            'author' => 'Kaspersky Team',
            'date' => '2024-10-07',
            'excerpt' => 'Our apps are no longer available on Google Play due to Google’s decision to remove Kaspersky products. This post explains how to install and update Kaspersky apps from alternative stores.',
            'content' => 'We’ve recently been informed by the Google Play store that our developer account has been terminated and all Kaspersky apps have been removed from the store. Although this action only affects the U.S., we recommend downloading Kaspersky apps from alternative stores like Galaxy Store, Huawei AppGallery, Xiaomi GetApps, or directly from our website...',
            'image' => 'https://media.kasperskydaily.com/wp-content/uploads/sites/92/2024/09/30040752/kaspersky-apps-removed-from-google-play-featured-1500x986.jpg',
        ],
        [
            'slug' => 'bitdefender-why-choose-it-in-your-cybersecurity-strategy',
            'title' => 'BitDefender: Why Choose It in Your Cybersecurity Strategy',
            'author' => 'BitDefender Team',
            'date' => '2024-10-01',
            'excerpt' => 'In an age of increasing cyber threats, companies need robust data protection solutions. Learn why BitDefender is a top choice for businesses.',
            'content' => 'As businesses face growing cybersecurity threats, they need solutions that can keep up with modern challenges. BitDefender stands out as one of the leading cybersecurity providers. This post explores BitDefender’s capabilities, including endpoint protection, device control, anti-exploit features, and more. Flexa Cloud, a partner in Brazil, helps organizations secure their operations with BitDefender’s enterprise-grade tools...',
            'image' => 'https://cdn.brandient.com/cdn-cgi/imagedelivery/iZ1NdDgPoVQLl8_kv3oOFg/brandient.com/2024/03/Bitdefender-2022-01.jpg/w=1920,h=1200',
        ],
    ];

    //function to retrieve blogs could be used in another controller
    public function getLatestBlogs()
    {
        return collect($this->blogs)->take(3); // Get the 3 latest blogs
    }

    // Show list of blogs
    public function index()
    {
        return view('blogs.index', ['blogs' => $this->blogs]);
    }

    // Show single blog details
    public function show($slug)
    {
        $blog = collect($this->blogs)->firstWhere('slug', $slug);

        if (!$blog) {
            abort(404); // If the blog isn't found
        }

        return view('blogs.show', ['blog' => $blog]);
    }
}
