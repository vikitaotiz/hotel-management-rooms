@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.bookings.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-4">
                    @lang('quickadmin.qa_view')
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#addDays">
                        Add Days
                    </button>
                </div>
                <div class="col-md-4">
                    <a href="{{route('admin.bookings.edit', $booking->id)}}" class="btn btn-sm btn-success">Edit Booking</a>
                </div>
            </div>
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.customer')</th>
                            <td field-key='customer'>
                                {{ $booking->customer->first_name or '' }}
                                {{ $booking->customer->last_name or '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.room')</th>
                            <td field-key='room'>{{ $booking->room->room_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.time-from')</th>
                            <td field-key='time_from'>{{ $booking->time_from }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.time-to')</th>
                            <td field-key='time_to'>{{ $booking->time_to }}</td>
                        </tr>
                        
                        <tr>
                            <th>Account Type</th>
                            <td field-key='time_to'>{{ $booking->account_type }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td field-key='time_to'>{{ $booking->amount }}</td>
                        </tr>
                        <tr>
                            <th>Payment Mode</th>
                            <td field-key='time_to'>{{ $booking->payment_mode }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bookings.fields.additional-information')</th>
                            <td field-key='additional_information'>{!! $booking->additional_information !!}</td>
                        </tr>
                    </table>
                </div>

                @if ($booking->org_time_to)
                  <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Initial Time To</th>
                            <td field-key='time_to'>{{ $booking->org_time_to }}</td>
                        </tr>

                        <tr>
                            <th>New Time (To)</th>
                            <td field-key='time_to'>{{ $booking->time_to }}</td>
                        </tr>

                        <tr>
                            <th>Days</th>
                            <td>
                                {{$days_added}}
                            </td>
                        </tr>

                        <tr>
                            <th>Additional Charges</th>
                            <td field-key='time_to'>{{ $booking->add_amount }}</td>
                        </tr>
                        <tr>
                            <th>Payment Mode</th>
                            <td field-key='time_to'>{{ $booking->add_payment_mode }}</td>
                        </tr>
                    </table>
                  </div>
                @endif

            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.bookings.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
  

@section('javascript')
  @parent
  <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <script>
      $('.datetime').datetimepicker({
          format: "YYYY-MM-DD HH:mm"
      });
  </script>
@stop

<div class="modal fade" id="addDays" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 90%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">
                    Add Days For {{$booking->customer->first_name}} {{$booking->customer->last_name}}
                </h4>
            </div>
  
            <div class="modal-body">
                <form action="{{route('admin.bookings.add_days', $booking->id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <label>Initial Time (From) *</label>
                            <input type="text" class="form-control datetime" value="{{$booking->time_from}}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label>Time To *</label>
                            <input type="text" class="form-control datetime" name="time_to" value="{{$booking->time_to}}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label>Additional Charges *</label>
                            <input type="number" name="add_amount" class="form-control" placeholder="Enter Amount">
                            <p class="help-block"></p>
                            @if($errors->has('add_amount'))
                                <p class="help-block">
                                    {{ $errors->first('add_amount') }}
                                </p>
                            @endif
                        </div>

                        
                        <div class="col-xs-6 form-group">
                            <label>Select Payment Mode *</label>
                            <select name="add_payment_mode" class="form-control">
                                <option value="cash">Cash</option>
                                <option value="mpesa">Mpesa</option>
                                <option value="cheque">Cheque</option>
                            </select>
                            <p class="help-block"></p>
                            @if($errors->has('account_type'))
                                <p class="help-block">
                                    {{ $errors->first('account_type') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="padding:1%">
                        <div class="form-group">
                            <input type="submit" value="Add Days" class="btn btn-sm btn-info btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>