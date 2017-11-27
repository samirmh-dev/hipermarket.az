@extends('layouts.master')

@section('head')
    <title>{{ucfirst($mallar['ad'])}}</title>
    <meta name="robots" content="index, follow">
    <meta name="description" content="{{ucfirst($mallar['ad'])}}">
@endsection

@section('customCss')
    <link rel="stylesheet" href="{{asset('src/css/bax.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/jquery.bxslider.min.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('src/js/jquery.bxslider.min.js')}}"></script>
    <script src="{{asset('src/js/jquery.elevatezoom.js')}}"></script>
    <script>
        var slider = $('.bxslider').bxSlider({
            auto: false,
            pagerCustom:'bxslider',
            zoomLevel : 1
        });

        {{--@for($i=0;$i<count($mallar['sekil']);$i++)--}}
            {{--$("#zoom_{{$i}}").elevateZoom({--}}
                {{--pickid:{{$i}},--}}
            {{--});--}}
        {{--@endfor--}}
    </script>
@endsection
@section('content')
    <section id="mal-baxis">
        <section><a href="{{route('home')}}">Əsas səhifə</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="{{route('kat',['id'=>$kateqoriya['slug']])}}">{{ucfirst($kateqoriya['kateqoriya_ad'])}}</a>&nbsp;&nbsp;>&nbsp;&nbsp;
            @if(isset($multikateqoriya))
                <a href="{{route('multikat',['id'=>$multikateqoriya['slug']])}}">{{ucfirst($multikateqoriya['kateqoriya_ad'])}}</a>&nbsp;&nbsp;>&nbsp;&nbsp;
            @endif
            {{ucfirst(ucfirst($mallar['ad']))}}
        </section>
        <section>
            <section>
                <ul class="bxslider">
                    @foreach($mallar['sekil'] as $index=>$image)
                        {{--todo: baxis hissesini duzelt--}}
                        <li><a target="_blank" href="{{asset('src/images/stock/'.$image)}}" data-sekil="{{asset('src/images/stock/'.$image)}}"><img id="zoom_{{$index}}"   src="{{asset('src/images/500x659/'.$image)}}" title="{{ucfirst($mallar['ad'])}}" alt="{{ucfirst($mallar['ad'])}}" data-zoom-image="{{asset('src/images/stock/'.$image)}}" /></a></li>
                    @endforeach
                </ul>
                <section>
                    <ul>
                        @foreach($mallar['sekil'] as $index=>$image)
                            {{--todo: baxis hissesini duzelt--}}
                            <li><a onclick="slider.goToSlide($(this).data('kecid'))" data-kecid="{{$index}}"><img  src="{{asset('src/images/60x79/'.$image)}}" title="{{ucfirst($mallar['ad'])}}" alt="{{ucfirst($mallar['ad'])}}" /></a></li>
                        @endforeach
                    </ul>
                </section>
            </section>
            <section>
                <section>
                    <span>{{$mallar['ad']}}</span>
                    <span>Kod:&nbsp;&nbsp;#{{$mallar['kod']}}</span>
                    @if($mallar['stok']=='1')
                        <span style="color: seagreen;font-size: 20px;font-family: bold, sans-serif;">Stokda var</span>
                    @else
                        <span style="color: #B11E22;font-size: 20px;font-family: bold, sans-serif;">Stokda yoxdur</span>
                    @endif
                    <select name="olcu" id="">
                        <option value="" selected disabled>Ölçü seçin</option>
                        @foreach($mallar['olcu'] as $olcu)
                                <option value="{{$olcu}}">{{$olcu}}</option>
                        @endforeach
                    </select>
                    @if($mallar['endirim']!='0')
                        <span class="qiymet"><span>
                                <s>{{$mallar['qiymet']}}&nbsp; AZN</s>
                                <span>{{$mallar['qiymet']-($mallar['qiymet']*$mallar['endirim']/100)}}&nbsp;AZN</span>
                            </span><span>-{{$mallar['endirim']}}%</span></span>
                    @else
                        <span class="qiymet">{{$mallar['qiymet']}}&nbsp;AZN</span>
                    @endif
                    <a href="#"><span class="store-add ikon"></span>İstək siyahısı</a>
                    <a href="#"><span class="store-add ikon"></span>Səbət</a>
                </section>
            </section>
        </section>
        <section>
            <section>
                <p>{{$mallar['melumat']}}</p>
            </section>
            <section>
                <table class="table">
                    <tbody>
                    @if(isset($mallar['xususiyyetler'][0]))
                        <tr style="background-color: rgba(0,0,0,.075);">
                            <td colspan="2"><span style="display: block;width: 100%;text-align: center;font-weight: 500;">Digər məlumatlar</span></td>
                        </tr>
                        @foreach($mallar['xususiyyetler'] as $index=>$xususiyyet)
                            <tr>
                                <td style="text-align:center;width: 50%">{{ucfirst($xususiyyet['xususiyyet'])}}</td>
                                <td style="text-align:center;width: 50%">{{ucfirst($xususiyyet['teyinat'])}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="background-color: rgba(0,0,0,.075);">
                            <td colspan="2"><span style="display: block;width: 100%;text-align: center;font-weight: 500;">Əlavə məlumat yoxdur</span></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </section>
        </section>
    </section>
@endsection