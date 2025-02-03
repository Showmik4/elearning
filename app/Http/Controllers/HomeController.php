<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Category;
use App\Models\Course;
use App\Models\KPI;
use App\Models\KpiAssign;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sku;
use App\Models\Trainer;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;

class HomeController extends Controller
{
    public function index()
    {  
        $totalCourse=Course::count();   
        $totalSales=Order::sum('total_price');  
        $totalOrders=Order::count();  
        $totalTrainer=Trainer::count();        
            
        return view('home',compact('totalCourse','totalTrainer','totalSales','totalOrders','totalCourse'));
    }  
      
}
