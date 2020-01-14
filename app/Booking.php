<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Booking
 *
 * @package App
 * @property string $customer
 * @property string $room
 * @property string $time_from
 * @property string $time_to
 * @property text $additional_information
 */
class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = ['time_from', 'time_to', 'people_count', 'additional_information', 'account_type', 'payment_mode', 'customer_id', 'room_id','amount'];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCustomerIdAttribute($input)
    {
        $this->attributes['customer_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoomIdAttribute($input)
    {
        $this->attributes['room_id'] = $input ? $input : null;
    }

    protected $dates = ['time_from', 'time_to', 'add_time_to'];
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTimeFromAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['time_from'] = Carbon::createFromFormat(config('app.date_format') . ' H:i', $input)->format('Y-m-d H:i');
        } else {
            $this->attributes['time_from'] = null;
        }
    }

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

    public function days_added(){
        $date1 = $this->time_to;
        $date2 = $this->org_time_to;

        $date1 = Carbon::parse($date1)->format('Y-m-d');
        $date2 = Carbon::parse($date2)->format('Y-m-d');
    
        $date1 = Carbon::createFromFormat('Y-m-d', $date1);
        $date2 = Carbon::createFromFormat('Y-m-d', $date2);

        $days_added = $date1->diffInDays($date2);

        return $days_added;
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTimeFromAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTimeToAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['time_to'] = Carbon::createFromFormat(config('app.date_format') . ' H:i', $input)->format('Y-m-d H:i');
        } else {
            $this->attributes['time_to'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTimeToAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id')->withTrashed();
    }
}
