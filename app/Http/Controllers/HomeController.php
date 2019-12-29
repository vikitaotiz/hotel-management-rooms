<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Charts\customersChart;
use App\Charts\bookingsChart;
use App\Booking;
use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Customers
        $today_customers = Customer::whereDate('created_at', today())->count();
        $yesterday_customers = Customer::whereDate('created_at', today()->subDays(1))->count();
        $customers_2_days_ago = Customer::whereDate('created_at', today()->subDays(2))->count();
        $customers_3_days_ago = Customer::whereDate('created_at', today()->subDays(3))->count();
        $customers_4_days_ago = Customer::whereDate('created_at', today()->subDays(4))->count();

        $customersChart = new customersChart;

        $customersChart->labels(['Today', 'Yesterday', '2 days ago', '3 days ago', '4 days ago']);
        $customersChart->dataset('New Customers', 'bar', [$today_customers, $yesterday_customers, $customers_2_days_ago, $customers_3_days_ago, $customers_4_days_ago]);

        // Bookings
        $today_bookings = Booking::whereDate('created_at', today())->count();
        $yesterday_bookings = Booking::whereDate('created_at', today()->subDays(1))->count();
        $bookings_2_days_ago = Booking::whereDate('created_at', today()->subDays(2))->count();
        $bookings_3_days_ago = Booking::whereDate('created_at', today()->subDays(3))->count();
        $bookings_4_days_ago = Booking::whereDate('created_at', today()->subDays(4))->count();

        $bookingsChart = new bookingsChart;

        $bookingsChart->labels(['Today', 'Yesterday', '2 days ago', '3 days ago', '4 days ago']);
        $bookingsChart->dataset('Bookings', 'bar', [$today_bookings, $yesterday_bookings, $bookings_2_days_ago, $bookings_3_days_ago, $bookings_4_days_ago]);

        // $bookings = Booking::whereDate('created_at', today())->get();
        $bookings = Booking::all();

        return view('home', compact('customersChart', 'bookingsChart', 'bookings'));
    }
}
