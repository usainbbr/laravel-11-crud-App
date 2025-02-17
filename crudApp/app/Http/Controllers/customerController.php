<?php

namespace App\Http\Controllers;

use App\Http\Requests\customerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use File;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     dd($request->search);
        // }
        $customers = Customer::when($request->has('search'),function($query) use($request){
            $query->where('first_name','LIKE',"%$request->search%")
            ->orWhere('last_name','LIKE',"%$request->search%")
            ->orWhere('email','LIKE',"%$request->search%")
            ->orWhere('bank_account_number','LIKE',"%$request->search%")
            ->orWhere('phone','LIKE',"%$request->search%");
        })->orderBy('id',$request->has('order') && $request->order =='asc'?'ASC':'DESC')->get();
        return view('customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(customerStoreRequest $request)
    {        $customer =new Customer();

        if($request->hasFile('image')){
            $image =$request->file('image');
            $fileName =$image->store('','public');
            $path ='/uploads/'.$fileName;
            $customer->image =$path;
        }
        $customer->first_name =$request->first_name;
        $customer->last_name =$request->last_name;
        $customer->email =$request->email;
        $customer->phone = $request->phone;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->about = $request->about;
        $customer->save();
        return redirect()->route('customers.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   $customer =Customer::findOrFail($id);
        return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer =Customer::findOrFail($id);
        return view('customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(customerStoreRequest $request, string $id)
    {
        $customer =Customer::findOrFail($id);
        if($request->hasFile('image')){
            //deleting the existing file
            $file =File::delete(public_path($customer->image));

            $image =$request->file('image');
            $fileName =$image->store('','public');
            $path ='/uploads/'.$fileName;
            $customer->image =$path;
        }
        $customer->first_name =$request->first_name;
        $customer->last_name =$request->last_name;
        $customer->email =$request->email;
        $customer->phone = $request->phone;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->about = $request->about;
        $customer->save();
        return redirect()->route('customers.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer =Customer::findOrFail($id);
        // File::delete(public_path($customer->image));
        $customer->delete();
        return redirect()->route('customers.index');
        
    }
    public function trash(Request $request)
    {
        $customers = Customer::when($request->has('search'),function($query) use($request){
            $query->where('first_name','LIKE',"%$request->search%")
            ->orWhere('last_name','LIKE',"$request->search")
            ->orWhere('email','LIKE',"$request->search")
            ->orWhere('bank_account_number','LIKE',"%$request->search%")
            ->orWhere('phone','LIKE',"$request->search");
        })->orderBy('id',$request->has('order') && $request->order =='asc'?'ASC':'DESC')->onlyTrashed()->get();
        return view('customer.trash',compact('customers'));
       
    }
    public function restore(string $id){
        $customer =Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();
        return redirect()->back();
    }
    function forceDeleted (int $id){
       $customer =Customer::onlyTrashed()->findOrFail($id);
       File::delete(public_path($customer->image));
       $customer->forceDelete();
       return redirect()->back();
    }
}
