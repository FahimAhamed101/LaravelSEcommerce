<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Charts\MonthlyOrdersChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AuthAdminRequest;

class AdminController extends Controller
{
    /**
     * Display the customers orders & reviews
     */
    public function index() : View
    {
          $chartTitle = 'Orders during '.Carbon::now()->year.'.';
   // Define month labels
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        //send the data to the chart
        $chart = '1';

        //the chart will display orders by month
        return view('admin.dashboard',compact( 'chart'));
    }

    /**
     * Display the login form for the admin
     */
    public function login() : View
    {
        return view('admin.login');
    }

    /**
     * Log in the admin
     */
    public function auth(AuthAdminRequest $request) : RedirectResponse
    {
        if(auth()->guard('admin')->attempt($request->validated())) {
            $request->session()->regenerate();
            return to_route('admin.index');
        }else {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.'
            ])->onlyInput('email');
        }
    }

    /**
     * Log out the admin
     */
    public function logout(Request $request) : RedirectResponse
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('admin.login');
    }

    
    
}