<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    public function dashboard() 
    {
        return view('admin.dashboard');
    }

    public function productList()
    {
        return view('admin.product_list');
    }

    public function productRequests()
    {
        return view('admin.product_requests');
    }

    public function productArchive()
    {
        return view('admin.product_archive');
    }
    
    public function storeList()
    {
        return view('admin.store_list');
    }

    public function storeRequests()
    {
        return view('admin.store_requests');
    }

    public function storeOwners()
    {
        return view('admin.store_owners');
    }

    public function storeArchive()
    {
        return view('admin.store_archive');
    }
}
