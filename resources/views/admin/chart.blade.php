<!DOCTYPE html>
<html lang="en">

<head>
    @include('library')
    <link rel="stylesheet" href="{{ URL::asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin-public.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/chart.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Charts</title>
</head>

<body>
    @include('admin/header')
    @include('admin/aside')
    <div class="col dashboard-body-show show-body-control" id="charts-body">
        <h2 class="show-header-title">Statistical</h2>
        <div class="section-chart first-chart revenue-chart">
            <div class="form-get-date form-sev-statistical">
                <form class="form-search" onsubmit="setDate()">
                    {{-- <div class="each-block">
                        <label for="filter-by">Filter by</label>
                        <select class="filter-date-by filter-by" name="filter-by" id="filterBy">
                            <option class="option-filter" value="1" selected @if (isset($_GET['filter-by']) && $_GET['filter-by'] == 1)
                                selected="selected"
                            @endif>Filter as day</option>
                            <option class="option-filter" value="2" @if (isset($_GET['filter-by']) && $_GET['filter-by'] == 2)
                            selected="selected"
                        @endif>Filter as month</option>
                        </select>
                    </div> --}}
                    <div class="each-block">
                        <label class="control-label" for="from">From date:</label>
                        <input class="date-choose date-from" id="from" name="from" type="date"
                            value="@php
                            echo isset($_GET['from']) ? $_GET['from'] : '';
                        @endphp">
                    </div>
                    <div class="each-block">
                        <label class="control-label" for="to">To date:</label>
                        <input class="date-choose date-to" id="to" name="to" type="date"
                            value="@php
                        echo isset($_GET['to']) ? $_GET['to'] : '';
                    @endphp">
                    </div>
                    <button class="btn btn-primary" type="submit"id="submit-search">
                        filter results</button>
                </form>
                {{-- <script type="text/javascript">
                    $("#filterBy").change(function(){
                        var value = $(this).val();
                        console.log(value);
                        if(value == 2){
                            $("#from").removeAttr("type")
                            $("#from").attr("type","month")
                            document.getElementById("from").value = "";
                            $("#to").removeAttr("type")
                            $("#to").attr("type","month")
                            document.getElementById("to").value = "";
                        }
                    })
                </script> --}}
            </div>
            <div class="panel-display-filter">
                <div class="aside-title-filter">
                    <div class="title-filter first-title">
                        DATE:
                    </div>
                    <div class="title-filter second-title">
                        QTY CART PRODUCT:
                    </div>
                    <div class="title-filter third-title">
                        TOTAL PRICE CART PRODUCT:
                    </div>
                    <div class="title-filter fourth-title">
                        QTY CART BOARDING:
                    </div>
                    <div class="title-filter fifth-title">
                        TOTAL PRICE CART BOARDING:
                    </div>
                    <div class="title-filter sixth-title">
                        QTY CART SERVICE:
                    </div>
                    <div class="title-filter seventh-title">
                        TOTAL PRICE CART SERVICE:
                    </div>
                    <div class="title-filter eighth-title">
                        TOTAL QTY CART:
                    </div>
                    <div class="title-filter nineth-title">
                        TOTAL PRICE ALL CART:
                    </div>
                    <div class="title-filter tenth-title">
                        ALL QUANTITY
                    </div>
                    <div class="title-filter eleventh-title">
                        ALL PRICE
                    </div>
                </div>

                <div class="main-side-filter side-content">
                    <div class="content-side-filter-each display-row-date">
                        @foreach ($array_date as $arr_date)
                            <div class="content-row ">{{ $arr_date }}</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-qty-cart-prd">
                        @foreach ($array_count_prd as $arr_cp)
                            <div class="content-row ">{{ $arr_cp }}</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-price-cart-prd">
                        @foreach ($array_price_prd as $arr_pp)
                            <div class="content-row ">{{ number_format($arr_pp, 0, '', '.') }} VND</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-qty-cart-board">
                        @foreach ($array_count_board as $arr_cb)
                            <div class="content-row ">{{ $arr_cb }}</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-price-cart-board">
                        @foreach ($array_price_board as $arr_pb)
                            <div class="content-row ">{{ number_format($arr_pb, 0, '', '.') }} VND</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-qty-cart-serv">
                        @foreach ($array_count_serv as $arr_cs)
                            <div class="content-row ">{{ $arr_cs }}</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-price-cart-serv">
                        @foreach ($array_price_serv as $arr_ps)
                            <div class="content-row ">{{ number_format($arr_ps, 0, '', '.') }} VND</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-qty-cart-all">
                        @foreach ($array_count_all as $arr_ca)
                            <div class="content-row ">{{ $arr_ca }}</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-price-cart-all">
                        @foreach ($array_price_all as $arr_pa)
                            <div class="content-row ">{{ number_format($arr_pa, 0, '', '.') }} VND</div>
                        @endforeach
                    </div>
                    <div class="content-side-filter-each display-row-qty-all">
                        <div class="content-row content-last">{{ $all_of_count_date }}</div>
                    </div>
                    <div class="content-side-filter-each display-row-price-all">
                        <div class="content-row content-last">{{ number_format($all_of_price_date, 0, '', '.') }} VND
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-chart second-chart status-cart-chart">
            <h3 class="section-title">Order data statistics</h3>
            <hr>
            <div class="full-block-panel-width">
                <div class="section-cart-prd">
                    <h4 class="title-section-cart">Order status</h4>
                    <div class="section-cart">
                        <div class="title-wget-panel-left panel-left">
                            <div class="title-panel-content">Not Confirmed</div>
                            <div class=" title-panel-content">Confirmed</div>
                            <div class="title-panel-content">Order confirmation(Delivery)</div>
                            <div class="title-panel-content">Cancled by customer</div>
                            <div class="title-panel-content">Out of stock</div>
                            <div class=" title-panel-content">Success delivery</div>
                            <div class="title-panel-content">No recipient</div>
                        </div>
                        <div class="content-wget-panel-right panel-right">
                            @for ($i = 1; $i <= 7; $i++)
                                @php
                                    $count = 0;
                                    $cart_id = '';
                                @endphp
                                @foreach ($array_cart_prd_status as $arrcpsta)
                                    @if ($arrcpsta->cart_id_render != $cart_id)
                                        @if ($arrcpsta->status == $i)
                                            @php
                                                $count = $count + 1;
                                                $cart_id = $arrcpsta->cart_id_render;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                                <div class="content-panel-count">{{ $count }} ordered</div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="section-cart-serv">
                    <h4 class="title-section-cart">Number of times the service is useds</h4>
                    <div class="section-cart">
                        <div class="title-wget-panel-left panel-left">
                            @foreach ($service as $serv)
                                <div class="title-panel-content">{{ $serv->name }}</div>
                            @endforeach
                        </div>
                        <div class="content-wget-panel-right panel-right">
                            @foreach ($service as $sfc)
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($array_cart_service as $arrcsu)
                                    @if ($arrcsu->service_id == $sfc->id)
                                        @php
                                            $count = $count + $arrcsu->total_pet;
                                        @endphp
                                    @endif
                                @endforeach
                                <div class="content-panel-count">{{ $count }} times</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="section-cart-board">
                    <div class="section-cart-top">
                        <h4 class="title-section-cart">Boarding status</h4>
                        <div class="section-cart">
                            <div class="title-wget-panel-left panel-left">
                                <div class=" title-panel-content">Confirmed</div>
                                <div class="title-panel-content">Processing</div>
                                <div class="title-panel-content">Done</div>
                            </div>
                            <div class="content-wget-panel-right panel-right">
                                @for ($i = 1; $i <= 3; $i++)
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($array_cart_board as $arrcbs)
                                        @if ($arrcbs->status == $i)
                                            @php
                                                $count = $count + 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="content-panel-count">{{ $count }} boarding</div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="section-cart-bot">
                        <h4 class="title-section-cart">Number of times boarding is used</h4>
                        <div class="section-cart">
                            <div class="title-wget-panel-left panel-left">
                                @foreach ($boarding as $board)
                                    <div class=" title-panel-content">{{ $board->name }}</div>
                                @endforeach
                            </div>
                            <div class="content-wget-panel-right panel-right">
                                @foreach ($boarding as $boardig)
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($array_cart_board as $arrcbn)
                                        @if ($arrcbn->boarding_id == $boardig->id && $arrcbn->status == 2)
                                            @php
                                                $count = $count + 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="content-panel-count">{{ $count }} times</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-chart second-chart status-cart-chart">
            <h3 class="section-title">Statistics for products and users</h3>
            <hr>
            <div class="section-product product-list-best">
                <div class="view-list-panel">
                    <h4 class="title-panel">List top 10 products best seller</h4>
                    <div class="list-prd-table">
                        <div class="row-title-header row-title-list row-list">
                            <div class="title-header col-4">Product</div>
                            <div class="title-header col-2">Import Price</div>
                            <div class="title-header col-2">Sale Price</div>
                            <div class="title-header col-2">Quantity left</div>
                            <div class="title-header col-2">Quantity sold</div>
                        </div>
                        <div class="row-content-field row-content">
                            @foreach ($array_product_sort as $arrprdsort)
                                <div class="each-product-panel">
                                    <div class="content-panel-field col-4">{{ $arrprdsort['product'] }}</div>
                                    <div class="content-panel-field col-2">
                                        {{ number_format($arrprdsort['import_price'], 0, '', '.') }} VND</div>
                                    <div class="content-panel-field col-2">
                                        {{ number_format($arrprdsort['sale_price'], 0, '', '.') }} VND</div>
                                    <div class="content-panel-field col-2">{{ $arrprdsort['quantity'] }}</div>
                                    <div class="content-panel-field col-2">{{ $arrprdsort['count'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-user user-list-best">
                <div class="view-list-panel">
                    <h4 class="title-panel">List top 10 user has most payment</h4>
                    <div class="list-prd-table">
                        <div class="row-title-header row-title-list row-list">
                            <div class="title-header col-2">Username</div>
                            <div class="title-header col-2">Email</div>
                            <div class="title-header col-2">Payment for products</div>
                            <div class="title-header col-2">Payment for services</div>
                            <div class="title-header col-2">Payment for boarding</div>
                            <div class="title-header col-2">Total payment</div>
                        </div>
                        <div class="row-content-field row-content">
                            @foreach ($array_users_top_sort as $arruts)
                                <div class="each-product-panel">
                                    <div class="content-panel-field col-2">{{ $arruts['username'] }}</div>
                                    <div class="content-panel-field col-2">{{ $arruts['usermail'] }}</div>
                                    <div class="content-panel-field col-2">{{ number_format($arruts['total_prd'], 0, '', '.') }} VND</div>
                                    <div class="content-panel-field col-2">{{ number_format($arruts['total_serv'], 0, '', '.') }} VND</div>
                                    <div class="content-panel-field col-2">{{ number_format($arruts['total_board'], 0, '', '.') }} VND</div>
                                    <div class="content-panel-field col-2">{{ number_format($arruts['total'], 0, '', '.') }} VND</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript"></script>
</body>

</html>
