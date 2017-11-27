@extends('layouts.master')

@section('head')
    <title>{{env('APP_NAME')}}</title>
    <meta name="robots" content="index, follow">
    <meta name="description" content="">
@endsection

@section('customCss')
    <link rel="stylesheet" href="{{asset('src/css/home.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/jquery.bxslider.min.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('src/js/jquery.bxslider.min.js')}}"></script>
    <script>
        $('.bxslider').bxSlider({
            mode: 'fade',
            captions: true,
            auto: true,
            randomStart: true
        });
    </script>
@endsection

@section('content')
    <section id="home">
        <section>
            <ul class="bxslider">
                @foreach($slides as $slide)
                    {{--todo: baxis hissesini duzelt--}}
                    <li><a href="{{route('baxis',['id'=>$slide['mal']])}}"><img src="{{asset('src/images/slide/'.$slide['img'])}}" title="{{$slide['title']}}" /></a></li>
                @endforeach
            </ul>
        </section>
        <section id="encoxsatan">
            <section class="basliq">
                <h1 style="width: 25%;">SİZİN ÜÇÜN SEÇDİKLƏRİMİZ</h1>
                <hr>
            </section>
            <section class="mallar">
                @foreach($secilmis as $item)
                    <section class="mallar-item">
                        <a href="{{route('baxis',['id'=>$item['id']])}}"><img src="{{asset('src/images/190x250/'.$item['sekil'])}}" alt="Image"></a>
                        <span>{{$item['ad']}}</span>
                        @if($item['endirim']!==0)
                            <span class="endirim">-{{$item['endirim']}}%</span>
                            <span class="qiymet"><s style="margin-right: 8px;color: #dbdbdb;display: flex;font-size: 18px;align-items:center;"><span class="store-azn-manat ikon"></span>{{$item['qiymet']}}</s><span class="store-azn-manat ikon"></span>{{$item['qiymet']-($item['qiymet']*$item['endirim']/100)}}</span>
                        @else
                            <span class="qiymet"><span class="store-azn-manat ikon"></span>{{$item['qiymet']}}</span>
                        @endif

                        <section>
                            <a href="#"><span class="store-add ikon"></span>İstək siyahısı</a>
                            <a href="#"><span class="store-add ikon"></span>Səbət</a>
                        </section>
                        <section><a href="{{route('baxis',['id'=>$item['id']])}}"><span class="store-search-1 ikon"></span>TAM BAXIŞ</a></section>
                    </section>
                @endforeach
            </section>
        </section>
        <section>
            <section class="basliq">
                <h1 style="width: 18%;">ƏN SON ƏLAVƏLƏR</h1>
                <hr>
            </section>
            <section class="mallar">
                @foreach($ensonelave as $index=>$item)
                    @if($index<8)
                        <section class="mallar-item">
                            <a href="{{route('baxis',['id'=>$item['id']])}}"><img src="{{asset('src/images/190x250/'.$item->sekil[0]->name)}}" alt="{{$item->ad->ad}}"></a>
                            <span>{{$item->ad->ad}}</span>
                            @if(isset($item->endirim->faiz))
                                <span class="endirim">-{{$item->endirim->faiz}}%</span>
                                <span class="qiymet"><s style="margin-right: 8px;color: #dbdbdb;display: flex;font-size: 18px;align-items:center;"><span class="store-azn-manat ikon"></span>{{$item->qiymet->qiymet}}</s><span class="store-azn-manat ikon"></span>{{$item->qiymet->qiymet-($item->qiymet->qiymet*$item->endirim->faiz/100)}}</span>
                            @else
                                <span class="qiymet"><span class="store-azn-manat ikon"></span>{{$item->qiymet->qiymet}}</span>
                            @endif

                            <section>
                                @if($item->stok->stok)
                                    <a href="#"><span class="store-add ikon"></span>İstək siyahısı</a>
                                    <a href="#"><span class="store-add ikon"></span>Səbət</a>
                                @else
                                    <a href="#" style=""><span class="store-add ikon"></span>İstək siyahısı</a>
                                    <a class="nostok">Stokda qalmadı</a>
                                @endif
                            </section>
                            <section><a href="{{route('baxis',['id'=>$item['id']])}}"><span class="store-search-1 ikon"></span>TAM BAXIŞ</a></section>
                        </section>
                    @endif
                @endforeach
            </section>
        </section>
        <section id="butun">
            <a href="{{route('dahacox')}}">DAHA ÇOX</a>
        </section>
    </section>
@endsection