<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BackEnd\Order\OrderController;
use App\Models\Customer;
use App\Models\Log;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Post;
use App\Models\ProductModel;
use App\Models\Statics;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tpl = [];
//        $count_post = Post::query()->count();
        $count_customer = Customer::query()->count();
        $order_item = OrderItem::query()->get()->groupBy('product_id')->toArray();
        foreach ($order_item as $k => $item){
            $order_item[$k]['count'] = 0;

            foreach ($item as $value){

                $order_item[$k]['count'] += $value['quantity'];
                $order_item[$k]['name'] = $value['product_name'];
            }

        }
        usort($order_item, function($a, $b) {
            return $b['count'] <=> $a['count'];
        });
        $order_item = array_slice($order_item, 0, 8);
        $order = Orders::query()->with('order_item')->get();
//        $tpl['count_post'] = $count_post;
        $tpl['count_customer'] = $count_customer;
        $tpl['product'] = $order_item;
        $tpl['order'] = $order;
        $tpl['order_item'] = $order_item;
        $total_revenue = 0;
        foreach ($order as $item){
            foreach ($item->order_item as $value){
                $total_revenue += $value->total;
            }
        }
        $order_rank = Orders::query()->get()->groupBy('customer_id');
        $rank = [];
        foreach ($order_rank as $k => $item){
            $total = 0;
            foreach ($item as $value){
                $total += $value->total;
            }
            $rank[$k] = $total;

        }
        arsort($rank);
        $keys = array_keys($rank);
        $customer_rank = Customer::query()->whereIn('id',$keys)->get()->keyBy('id');


        $log = Log::query()->orderBy('created_at','desc')->get()->take('200');

        $tpl['log'] = $log;
        $tpl['total_revenue'] = $total_revenue;
        $tpl['customer_rank'] = $customer_rank;
        $tpl['rank'] = $rank;
        return view('home', $tpl);
    }

    public function analytics(Request $request){
        $type = $request->get('type');
        $data = [];
        if($type == 'Day'){
            $today = Carbon::today();
            // Lặp qua các khoảng thời gian mỗi 2 giờ từ 0 giờ đến 22 giờ
            for ($hour = 0; $hour < 24; $hour += 2) {
                // Tạo thời gian bắt đầu và kết thúc cho khoảng thời gian
                $startHour = $today->copy()->startOfDay()->addHours($hour);
                $endHour = $startHour->copy()->addHours(2);

                // Truy vấn các đơn hàng trong khoảng thời gian hiện tại
                $orders = Orders::where('created_at', '>=', $startHour->timestamp)
                    ->where('created_at', '<', $endHour->timestamp);

                $data['data_order'][] =$orders ->count() ;
                $data['income'][] =  $orders->sum('total');
                $data['labels'][] = $startHour->format('H:i') . ' - ' . $endHour->format('H:i');
            }
        }
        if($type == 'Monthly'){
            // Lấy ngày đầu tiên của tháng hiện tại
            $firstDayOfMonth = Carbon::now()->startOfMonth();

            // Lấy ngày cuối cùng của tháng hiện tại
            $lastDayOfMonth = Carbon::now()->endOfMonth();

            // Khởi tạo mảng chứa tổng giá trị của trường 'value' trong mỗi tuần của tháng
            $orderSegments = [];

            // Lặp qua các tuần trong tháng
            while ($firstDayOfMonth->lt($lastDayOfMonth)) {
                // Tạo thời gian bắt đầu và kết thúc cho tuần hiện tại
                $startOfWeek = $firstDayOfMonth->copy()->startOfWeek();
                $endOfWeek = $firstDayOfMonth->copy()->endOfWeek();

                // Truy vấn tổng giá trị của trường 'value' trong tuần hiện tại
                $orders = Orders::where('created_at', '>=', $startOfWeek->timestamp)
                    ->where('created_at', '<=', $endOfWeek->timestamp);
                $data['data_order'][] =$orders ->count() ;
                $data['income'][] =  $orders->sum('total');
                $data['labels'][] = $firstDayOfMonth->format('d/m') . ' - ' . $firstDayOfMonth->addWeek()->format('d/m');

            }
        }
        return response()->json($data);
    }
}
