<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show()
    {
        return view('order.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $order = Order::with('user','course')->get();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($order)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            }) 

            ->addColumn('course', function (Order $order) {
                return $order->course->title;
            })

            ->addColumn('user', function (Order $order) {
                return $order->user->firstName;
            })
                 
            ->setRowAttr([
                'align' => 'center',
            ])            
               
            ->make(true);
    }

       public function edit($id)
    {      
        $about = About::findOrFail($id);  
        
        return view('about.edit', compact('about'));
    }
}
