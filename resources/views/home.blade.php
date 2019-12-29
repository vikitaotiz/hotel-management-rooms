@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-6">
                      @lang('quickadmin.qa_dashboard')
                    </div>
                    <div class="col-md-6">
                      <button type="button" class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#status">
                          Customer And Room Status
                      </button>
                    </div>
                  </div>
                </div>

            <div class="panel-body">
            
            <div class="row">

              <div class="col-lg-3 col-md-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">

                    <h3>{{App\Booking::whereDate('created_at', today())->count()}}</h3>

                    <p>Bookings Today</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="{{ action('Admin\BookingsController@today') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- ./col -->
              <div class="col-lg-3 col-md-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-orange">
                  <div class="inner">
                    <h3>{{App\Booking::all()->count()}}</h3>

                    <p>All Bookings</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="{{route('admin.bookings.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-lg-3 col-md-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>{{App\Room::where('booked', true)->count()}}</h3>

                    <p>No. of Booked Rooms</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="{{ route('admin.rooms.booked_rooms') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
               
               <!-- ./col -->
               <div class="col-lg-3 col-md-6 col-xs-12">
                 <!-- small box -->
                 <div class="small-box bg-red">
                   <div class="inner">
                     <h3>{{App\Room::all()->count()}}</h3>

                     <p>All Rooms</p>
                   </div>
                   <div class="icon">
                     <i class="ion ion-person-stalker"></i>
                   </div>
                   <a href="{{route('admin.rooms.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
               </div>
               <!-- ./col -->

           </div>

           <hr>

           <div class="row">

               <!-- ./col -->
               <div class="col-lg-3 col-md-6 col-xs-12">
                 <!-- small box -->
                 <div class="small-box bg-blue">
                   <div class="inner">
                     <h3>{{App\Room::where('booked', false)->count()}}</h3>

                     <p>Available Rooms</p>
                   </div>
                   <div class="icon">
                     <i class="ion ion-person-stalker"></i>
                   </div>
                   <a href="{{route('admin.rooms.available_rooms')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
               </div>
               <!-- ./col -->

               <!-- ./col -->
               <div class="col-lg-3 col-md-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>0</h3>

                    <p>No. of Revenue Today</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

               <!-- ./col -->
               <div class="col-lg-3 col-md-6 col-xs-12">
                 <!-- small box -->
                 <div class="small-box bg-yellow">
                   <div class="inner">
                     <h3>{{App\Customer::whereDate('created_at', today())->count()}}</h3>

                     <p>Customers Today</p>
                   </div>
                   <div class="icon">
                     <i class="ion ion-person-stalker"></i>
                   </div>
                   <a href="{{route('admin.customers.today')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
               </div>
               <!-- ./col -->

               <!-- ./col -->
               <div class="col-lg-3 col-md-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>{{App\Customer::all()->count()}}</h3>

                    <p>No. of All Customers</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="{{route('admin.customers.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              
           </div>
           <hr>

           <div class="row">

              <div class="col-md-6">
                {!! $bookingsChart->container() !!}
                {!! $bookingsChart->script() !!}
              </div>

              <div class="col-md-6">
                {!! $customersChart->container() !!}
                {!! $customersChart->script() !!}
              </div>
              
            </div>

                </div>
            </div>
        </div>
    </div>
@endsection



<div class="modal fade" id="status" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 90%;">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header bg-primary">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center">Customer And Room Status.</h4>
          </div>

          <div class="modal-body">


            <div class="panel-body table-responsive">
              <table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }} @can('booking_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                  <thead>
                      <tr>
  
                          <th>@lang('quickadmin.bookings.fields.customer')</th>
                          <th>@lang('quickadmin.bookings.fields.room')</th>
                          <th>@lang('quickadmin.bookings.fields.time-from')</th>
                          <th>@lang('quickadmin.bookings.fields.time-to')</th>
                          <th>Account</th>
                          <th>@lang('quickadmin.bookings.fields.amount')</th>
                          <th>Mode</th>
                          <th>Days Added</th>
                          <th>Balance</th>
                          
                          <th>&nbsp;</th>
                      </tr>
                  </thead>
                  
                  <tbody>
                      @if (count($bookings) > 0)
                          @foreach ($bookings as $booking)
                              <tr data-entry-id="{{ $booking->id }}">

                                  <td field-key='customer'>{{ $booking->customer->full_name or '' }}</td>
                                  <td field-key='room'>{{ $booking->room->room_number or '' }}</td>
                                  <td field-key='time_from'>{{ $booking->time_from }}</td>
                                  <td field-key='time_to'>{{ $booking->time_to }}</td>
                                  <td field-key='amount'>{{ $booking->account_type }}</td>
                                  <td field-key='amount'>{{ $booking->amount }}</td>
                                  <td field-key='amount'>{{ $booking->payment_mode }}</td>
                                  <td field-key='amount'>
                                    @if ($booking->org_time_to)
                                      {{$booking->days_added()}}
                                    @else
                                        No Days Added
                                    @endif
                                  </td>
                                  <td field-key='amount'>#</td>
                                  
                                  <td>
                                    <a href="{{ route('admin.bookings.show',[$booking->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                  </td>
                                  
                              </tr>
                          @endforeach
                      @else
                          <tr>
                              <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                          </tr>
                      @endif
                  </tbody>
              </table>
          </div>

          </div>
      </div>
  </div>
</div>
