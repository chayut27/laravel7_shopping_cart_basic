<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $data = array(
            [
            'id' => 1,
            'name' => 'หูฟัง',
            'price' => 2500,
            'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80'
            ],
            [
            'id' => 2,
            'name' => 'นาฬิกา',
            'price' => 3500,
            'img' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=989&q=80'
            ],
            [
                'id' => 3,
                'name' => 'แว่น',
                'price' => 4200,
                'img' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2000&q=80'
            ],
            [
                'id' => 4,
                'name' => 'กล้อง',
                'price' => 5400,
                'img' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80'
            ]
                
        );

        return view('product', compact(['data']));
    }

    public function addcart($id, Request $request){
        $data = array(
            [
            'id' => 1,
            'name' => 'หูฟัง',
            'price' => 2500,
            'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80'
            ],
            [
            'id' => 2,
            'name' => 'นาฬิกา',
            'price' => 3500,
            'img' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=989&q=80'
            ],
            [
                'id' => 3,
                'name' => 'แว่น',
                'price' => 4200,
                'img' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2000&q=80'
            ],
            [
                'id' => 4,
                'name' => 'กล้อง',
                'price' => 5400,
                'img' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80'
            ]
                
        );

        $cart = session()->get('cart');
        // get key
        foreach($data as $k => $v){
        if($v['id'] == $id){
            $key = $k;
            break;
        }
        
       }
       // empty cart
       $arr = array();
        if(empty($cart)){
            $arr[$id] = true;
            $cart[0] = array(
                'id' => $data[$key]['id'],
                'img' => $data[$key]['img'],
                'name' => $data[$key]['name'],
                'price' => $data[$key]['price'],
                'qty' => 1,
                'total' => $data[$key]['price'],
            );
        }else{
            foreach($cart as $k => $v){
                $arr[$v['id']] = true;
                if($v['id'] == $id){
                    // ซ้ำได้ ให้ qty ++
                    $cart[$k]['qty']++;
                    $cart[$k]['total'] = $cart[$k]['price'] * $cart[$k]['qty'];
                    break;

                    // ไม่ให้ซ้ำ
                    // return redirect()->back()->with('errors', 'คุณมีสินค้าชิ้นนี้อยู่ในตะกร้าแล้ว');
                }
            }  
        }

        if(empty($arr[$id])){
            $cart[] = array(
                'id' => $data[$key]['id'],
                'img' => $data[$key]['img'],
                'name' => $data[$key]['name'],
                'price' => $data[$key]['price'],
                'qty' => 1,
                'total' => $data[$key]['price'],
            );
        }

        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'เพิ่มสินค้าไปยังตะกร้าสินค้าสำเร็จ');
    }

    public function show_cart(Request $request){

        $cart = $request->session()->get('cart');
        $count = 0;
        if(!empty($cart)){
            foreach($cart as $v){
                $count+=$v['qty'];
            }
        }

        return view('cart', compact(['cart','count']));
    }
    
    public function delete_cart(Request $request, $line)
    {
        $cart = session()->get('cart');
        $count = count($cart);
        if(isset($cart[$line])) {
            unset($cart[$line]);

            session()->put('cart', $cart);
        }
        if($count == 0){
            $request->session()->flush();
        }
        return redirect()->back()->with('success', 'ลบรายการสำเร็จ');
    }
}
