<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private function convertNameToVietnamese($name)
    {
        $dictionary = [
            "nguyen"=>"Nguyễn", "tran"=>"Trần", "le"=>"Lê", "pham"=>"Phạm",
            "hoang"=>"Hoàng", "huynh"=>"Huỳnh", "phan"=>"Phan", "vu"=>"Vũ",
            "vo"=>"Võ", "dang"=>"Đặng", "bui"=>"Bùi", "do"=>"Đỗ", "ho"=>"Hồ",
            "duong"=>"Dương", "ly"=>"Lý", "van"=>"Văn", "thi"=>"Thị",
            "thanh"=>"Thành", "tuan"=>"Tuấn", "anh"=>"Ánh", "hung"=>"Hùng",
            "khanh"=>"Khánh","t"=>"Thị","v"=>"Văn"
        ];

        $parts = preg_split('/\s+/', trim($name));
        $count =count($parts);

        if($count==0) return'';

        $lastname = array_pop($parts);
        $covertedParts=[];

        foreach ($parts as $part) {
            $key = strtolower($part);
            if (isset($dictionary[$key])) {
                $covertedParts[] = $dictionary[$key];
            } else {
                $covertedParts[] = ucfirst(strtolower($part));
            }
        }

        $lastname =ucfirst(strtolower($lastname));

        return implode(" ", $covertedParts).' '.$lastname;
    }

    public function index()
    {
        // Đọc dữ liệu từ database
        $sanphams = DB::connection('mysql')->table('sanpham')->get();
        $khachhangs = DB::connection('mysql')->table('khachhang')->get()->map(function($item) {
            if (!empty($item->tenkh)) {
                $item->tenkh = $this->convertNameToVietnamese($item->tenkh);
            }
            return $item;
        });

        $hoadons = DB::connection('mysql')->table('hoadon')->get();
        $khohangs = DB::connection('mysql')->table('khohang')->get();
        $chitiethoadons = DB::connection('mysql')->table('chitiethoadon')->get();

        // Đọc dữ liệu từ file CSV
        $csvFile = base_path('data/khotong.csv');
        $stocks = [];

        if (($handle = fopen($csvFile, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $stocks[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        // Trả dữ liệu ra view
        return view('product.index', compact(
            'sanphams',
            'khachhangs',
            'hoadons',
            'khohangs',
            'chitiethoadons',
            'stocks'
        ));
    }
}
