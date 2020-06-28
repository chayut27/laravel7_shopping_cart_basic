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
                    สินค้าทั้งหมด
                </div>

                @if(session('success'))
                    <div style="background-color: #28a745; color: #fff;">
                        <p>{{session('success')}}</p>
                    </div>
                @endif

                @if(session('errors'))
                    <div style="background-color: red; color: #fff;">
                        <p>{{session('errors')}}</p>
                    </div>
                @endif

               <table width="100%" border="1">
                   <thead>
                       <tr>
                           <th>รหัสสินค้า</th>
                           <th>รูปภาพ</th>
                           <th>ชื่อสินค้า</th>
                           <th>ราคา</th>
                           <th></th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($data as $v)
                       <tr>
                            <td>{{$v['id']}}</td>
                            <td><img src="{{$v['img']}}" alt="" width="80"></td>
                            <td>{{$v['name']}}</td>
                            <td>{{number_format($v['price'],2)}}</td>
                            <td><a href="/add_cart/{{$v['id']}}">ใส่ตะกร้า</a></td>
                        </tr>
                       @endforeach
                   </tbody>
               </table>

               <a href="/cart">ตะกร้าสินค้า</a>
            </div>
        </div>
    </body>
</html>
