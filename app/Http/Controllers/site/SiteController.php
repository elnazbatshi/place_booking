<?php

namespace App\Http\Controllers\site;

use App\Event;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Customer;
use App\Models\Gallery;
use App\Models\LocationInfo;
use App\Models\Menu;
use App\Models\Module;
use App\Models\Order;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\TypeCategory;
use App\Person;
use App\Policies\PostPolicy;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    private $socials;

    public function __construct()
    {
        $this->socials = Setting::where('type', 'social')->get();
    }

    public function index()
    {
        $mainSlider = Slider::query()->whereHas('categories', function ($q) {
            $q->where('title', 'صفحه اول')->where('status', 1);
        })->get();
        $aboutUs = Module::wherehas('categories', function ($q) {
            $q->where('title', 'abaut_home_page');
        })->first();

        $categories = Category::whereHas('type', function ($q) {
            $q->where('name', 'مکان');
        })->get();

        $places = LocationInfo::with('categories')->get();


        return view('booking.home', [
            'mainSlider' => $mainSlider,
            'aboutUs'    => $aboutUs,
            'categories' => $categories,
            'places'     => $places,
        ]);
    }

    public function single($id)
    {
        $place = LocationInfo::findOrFail($id);


        $related_loc = LocationInfo::whereHas('categories', function ($q) use ($place) {
            $q->where('id', $place->categories->id);
        })->get();

        return view('booking.single.placeSingle', compact('place', 'related_loc'));
    }

    public function archive(Request $request, $category = null)
    {

        $categories = Category::with('type')->whereHas('type', function ($query) {
            $query->where('name', 'مکان');
        })->get();

        $allTags = LocationInfo::get()->pluck('tags')->flatten()->unique()->toArray();
        if ($category == null) {
            $places = LocationInfo::where('status', LocationInfo::STATUS_ACTIVE)->get();
        } else {
            $places = LocationInfo::whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category);
            })->where('status', LocationInfo::STATUS_ACTIVE)->get();
        }
        return view('booking.archive.placeArchive', compact('categories', 'allTags', 'places'));
    }

    public function setOrder(Request $request)
    {


        $place = LocationInfo::with('orders')->findOrFail($request->hall);

//        full day reserved by all customer
        $days = $place->orders()->where('status', Order::STATUS_ACTIVE)
                      ->get()->groupBy(function ($data) {
                return $data->day;
            });
        $reserved_days = [];
        $reserve_data = getTimesDays($days);
        foreach ($reserve_data as $key => $date_inv) {
            if (count($date_inv) == 11) {
                list($year, $month, $day) = explode('-', $key);
                $dateFrom = \Hekmatinasser\Verta\Facades\Verta::createGregorianDate($year, $month, $day)->format('Y/m/d'); // [2015,12,25]
                list($temp['year'], $temp['month'], $temp['day']) = explode('/', $dateFrom);
                $temp['className'] = 'disabled';
                array_push($reserved_days, $temp);
            }
        }

        $user = Auth::user()->id;
        $orders = Order::query()->where('user_id', $user)->where('location_id', $request->hall);

        $order_pending = Order::query()->where('user_id', $user)
                              ->where('location_id', $request->hall)
                              ->where('status', Order::STATUS_PENDING)
                              ->get()->groupBy(function ($data) {
                return $data->day;
            });
        $order_active = Order::query()->where('user_id', $user)
                             ->where('location_id', $request->hall)
                             ->where('status', Order::STATUS_ACTIVE)
                             ->get()->groupBy(function ($data) {
                return $data->day;
            });
        $order_deactivate = Order::query()->where('user_id', $user)
                                 ->where('location_id', $request->hall)
                                 ->where('status', Order::STATUS_DEACTIVATE)
                                 ->get()->groupBy(function ($data) {
                return $data->day;
            });


        $reserve_pending = getTimesDays($order_pending);
        $reserve_active = getTimesDays($order_active);
        $reserve_deactivate = getTimesDays($order_deactivate);


        foreach ($reserve_pending as $key => $date_inv) {
            list($year, $month, $dey) = explode('-', $key);

            $date = \Hekmatinasser\Verta\Facades\Verta::createGregorianDate($year, $month, $dey)->format('Y/m/d'); // [2015,12,25]
            list($temp['year'], $temp['month'], $temp['day']) = explode('/', $date);
            $temp['className'] = 'pending';
            array_push($reserved_days, $temp);
        }

        foreach ($reserve_active as $key => $day_active) {
            list($year, $month, $day) = explode('-', $key);
            $date = \Hekmatinasser\Verta\Facades\Verta::createGregorianDate($year, $month, $day)->format('Y/m/d'); // [2015,12,25]
            list($temp['year'], $temp['month'], $temp['day']) = explode('/', $date);
            $temp['className'] = 'active';
            array_push($reserved_days, $temp);
        }
        foreach ($reserve_deactivate as $key => $date_inv) {
            list($year, $month, $day) = explode('-', $key);
            $date = \Hekmatinasser\Verta\Facades\Verta::createGregorianDate($year, $month, $day)->format('Y/m/d'); // [2015,12,25]
            list($temp['year'], $temp['month'], $temp['day']) = explode('/', $date);
            $temp['className'] = 'deactivate';
            array_push($reserved_days, $temp);
        }


        return view('booking.order.index', compact('place', 'reserved_days'));
    }

    public function storeOrder(Request $request)
    {

        $request->validate([
            'day'        => 'required',
            'startTime'  => 'required|not_in:0',
            'endTime'    => 'required|not_in:0',
            'index'      => 'required',
            'department' => 'required',
            'subject'    => 'required',
            'parking'    => 'required',
            'catering'   => 'required',
            'desc'       => 'required',
        ]);

        $dateFromJalali = convertPersianNumbersToEnglish($request->day);
        $day = $this->attributes['day'] = \Hekmatinasser\Verta\Verta::parseFormat('Y/m/d', $dateFromJalali)->datetime();


        Order::query()->create([
            'location_id' => $request->location_id,
            'user_id'     => Auth::guard('customer')->user()->id,
            'day'         => $day,
            'startTime'   => $request->startTime,
            'endTime'     => $request->endTime,
            'index'       => $request->index,
            'department'  => $request->department,
            'subject'     => $request->subject,
            'catering'    => $request->catering,
            'parking'     => $request->parking,
            'desc'        => $request->desc,
        ]);

        session()->flash('set_order', ' سفارش شما ثبت شد');
        return redirect()->route('single.place', ['id' => $request->location_id]);
    }

    public function getTimeOrder(Request $request)
    {

        $eng_date = convertPersianNumbersToEnglish($request->date);
        $dateJalali = \Hekmatinasser\Verta\Verta::parseFormat('Y/m/d', $eng_date)->datetime();
        $getTime = Order::where('day', $dateJalali)->where('location_id', $request->hall)
                        ->where('status', Order::STATUS_ACTIVE)
                        ->get()->groupBy(function ($data) {
                return $data->day;
            });
        $time_reserved = getTimesDays2($getTime);
        return response($time_reserved);
    }


    public function archivePosts(Request $request)
    {
        $places = LocationInfo::whereJsonContains('tags', $request->tags)->get();
        return view('booking.archive.placeArchive', compact('places'));
    }

    public function aboutUs()
    {

        $phoneNumber = Setting::where(['type' => 'info', 'name' => 'phoneNumber'])->pluck('value')->first();
        $address = Setting::where(['type' => 'info', 'name' => 'address'])->pluck('value')->first();
        $email = Setting::where(['type' => 'info', 'name' => 'email'])->pluck('value')->first();

        $title = 'درباره ی ما';
        return view('site.aboutUs', compact('title', 'phoneNumber', 'address', 'email'));
    }

    public function contactUS(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name'        => 'required',
            'email'       => 'required',
            'phoneNumber' => 'required',
            'subject'     => 'required',
            'message'     => 'required',
        ]);

        ContactUs::create($input);
        return back()->with('success', 'پیام شما ارسال شد');
    }

    public function search(Request $request)
    {
        $location = LocationInfo::where('name', 'LIKE', '%' . $request->search . '%')->get();
        $data['search'] = $request->search;
        $data['location'] = $location;
        return response(['data' => $data]);


    }
}
