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
              <table id="rooms_table" class="table table-bordered table-striped {{ count($rooms) > 0 ? 'datatable' : '' }} ">
                  <thead>
                      <tr>
  
                          <th>Customer</th>
                          <th>Room</th>
                          <th>Time From</th>
                          <th>Time To</th>
                          <th>Account</th>
                          <th>Amount</th>
                          <th>Mode</th>
                          <th>Days Added</th>
                          <th>Balance</th>
                          
                          <th>&nbsp;</th>
                      </tr>
                  </thead>
                  
                  <tbody>
                      @if (count($rooms) > 0)
                          @foreach ($rooms as $room)
                              <tr data-entry-id="{{ $room->id }}">

                                  <td field-key='customer'>{{ $room->booking->customer->full_name or 'vacant' }}</td>
                                  <td field-key='room'>{{ $room->room_number or '' }}</td>
                                  <td field-key='time_from'>{{ $room->booking['time_from'] or 'vacant' }}</td>
                                  <td field-key='time_to'>{{ $room->booking['time_to'] or 'vacant'  }}</td>
                                  <td field-key='amount'>{{ $room->booking['account_type']  or 'vacant' }}</td>
                                  <td field-key='amount'>{{ $room->booking['amount']  or 'vacant' }}</td>
                                  <td field-key='amount'>{{ $room->booking['payment_mode']  or 'vacant' }}</td>
                                  <td field-key='amount'>
                                    @if ($room->booking['org_time_to'])
                                      {{$room->booking->days_added()}}
                                    @else
                                        No Days Added
                                    @endif
                                  </td>
                                  <td field-key='amount'>#</td>
                                  
                                  <td>
                                    <a href="{{ route('admin.rooms.show',[$room->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
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
