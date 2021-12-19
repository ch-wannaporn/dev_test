<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function __construct(Request $req) {
        $this->bookingData = json_decode(Storage::disk('local')->get('data.json'), true);
        $this->roomId = $req->roomId;
    }

    public function getTodayBookings() {
        $todayBookings = [];
        $today = date('d-m-Y');

        foreach($this->bookingData as $booking) {
            $bookingStartDate = date('d-m-Y', strtotime($booking["startTime"]));
            $bookingEndDate = date('d-m-Y', strtotime($booking["endTime"]));
            
            if($booking["roomId"] === $this->roomId && ($bookingStartDate === $today || $bookingEndDate === $today))
                array_push($todayBookings, $booking);
        }

        return $todayBookings;
    }

    public function getWeekBookings($nextWeekFlag) {
        $weekBookings = [];
        $year = date('Y');
        $weekNo = (int) date('W') + $nextWeekFlag;

        foreach($this->bookingData as $booking) {
            $startYear = date('Y', strtotime($booking["startTime"]));
            $endYear = date('Y', strtotime($booking["endTime"]));

            $startWeekNo = (int) date('W', strtotime($booking["startTime"]));
            $endWeekNo = (int) date('W', strtotime($booking["endTime"]));

            if($booking["roomId"] === $this->roomId && ($startYear === $year && $startWeekNo === $weekNo) || ($endYear === $year && $endWeekNo === $weekNo))
                array_push($weekBookings, $booking);
        }

        return $weekBookings;
    }

    public function getThisWeekBookings() {
        $roomId = $this->roomId;
        $todayBookings = $this->getTodayBookings();
        $thisWeekBookings = $this->getWeekBookings(0);

        return view('main', compact('roomId', 'todayBookings', 'thisWeekBookings'));
    }

    public function getNextWeekBookings() {
        $roomId = $this->roomId;
        $todayBookings = $this->getTodayBookings();
        $nextWeekBookings = $this->getWeekBookings(1);

        return view('main', compact('roomId', 'todayBookings', 'nextWeekBookings'));
    }

    public function getWholeMonthBookings() {
        $roomId = $this->roomId;
        $todayBookings = $this->getTodayBookings();

        $monthBookings = [];
        $year = date('Y');
        $month = date('m');

        foreach($this->bookingData as $booking) {
            $startYear = date('Y', strtotime($booking["startTime"]));
            $endYear = date('Y', strtotime($booking["endTime"]));

            $startMonth = date('m', strtotime($booking["startTime"]));
            $endMonth = date('m', strtotime($booking["endTime"]));

            if($booking["roomId"] === $this->roomId && ($startYear === $year && $startMonth === $month) || ($endYear === $year && $endMonth === $month))
                array_push($monthBookings, $booking);
        }

        return view('main', compact('roomId', 'todayBookings', 'monthBookings'));
    }
}
