<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                width: 100%;
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 70vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    ตะกร้าสินค้า
                </div>

                @if(session('success'))
                <div style="background-color: #28a745; color: #fff;">
                    <p>{{session('success')}}</p>
                </div>
                @endif

            รายการสินค้าทั้งหมด {{$count}} รายการ
            @if(!empty($cart))
               <table width="100%" border="1">
                   <thead>
                       <tr>
                           <th>รหัสสินค้า</th>
                           <th>รูปภาพ</th>
                           <th>ชื่อสินค้า</th>
                           <th>ราคา</th>
                           <th>จำนวน</th>
                           <th>รวม</th>
                           <th></th>
                       </tr>
                   </thead>
                   <tbody>
                    
                       @foreach ($cart as $k => $v)
                       <tr>
                            <td>{{$v['id']}}</td>
                            <td><img src="{{$v['img']}}" alt="" width="80"></td>
                            <td>{{$v['name']}}</td>
                            <td>{{number_format($v['price'],2)}}</td>
                            <td>{{$v['qty']}}</td>
                            <td>{{number_format($v['total'],2)}}</td>
                            <td><a href="/delete_cart/{{$k}}" onClick="return confirm('คุณแน่ใจว่าต้องการลบหรือไม่?');">ลบ</a></td>
                        </tr>
                       @endforeach
                   </tbody>
               </table>
            @else
               <p>ยังไม่มีรายการตะกร้าสินค้า</p>
            @endif

               <a href="/products">กลับไปเลือกสินค้า</a>
            </div>
        </div>
    </body>
</html>
