@extends('layouts.master')

@section('head')
    <title>{{$title?$title:env('APP_NAME')}}</title>
    <meta name="robots" content="index, follow">
@endsection

@section('customCss')
    <link rel="stylesheet" href="{{asset('src/css/mallar.min.css')}}">
@endsection

@section('scripts')

@endsection
@section('content')
    <section id="mallar-kateqoriya">
        @if(!count($mallar))
            <span style="display: block;width: 100%;min-height:350px;text-align:center;color:#383838;font-size:20px;">Axtarış nəticəsində heçnə tapılmadı</span>
        @else
            @foreach($mallar as $item)
                <section class="mallar-item">
                    <a href="{{route('baxis',['id'=>$item->id])}}"><img src="{{asset('src/images/190x250/'.$item->sekil[0]->name)}}" alt="Image"></a>
                    <span>{{$item->ad['ad']}}</span>
                    @if(isset($item->endirim['faiz']) && $item->endirim['faiz']!==0)
                        <span class="endirim">-{{$item->endirim['faiz']}}%</span>
                        <span class="qiymet"><s style="margin-right: 8px;color: #dbdbdb;display: flex;font-size: 18px;align-items:center;"><span class="store-azn-manat ikon"></span>{{$item->qiymet['qiymet']}}</s><span class="store-azn-manat ikon"></span>{{$item->qiymet['qiymet']-($item->qiymet['qiymet']*$item->endirim['faiz']/100)}}</span>
                    @else
                        <span class="qiymet"><span class="store-azn-manat ikon"></span>{{$item->qiymet['qiymet']}}</span>
                    @endif

                    <section>
                        <a href="#"><span class="store-add ikon"></span>İstək siyahısı</a>
                        <a href="#"><span class="store-add ikon"></span>Səbət</a>
                    </section>
                    <section><a href="{{route('baxis',['id'=>$item->id])}}"><span class="store-search-1 ikon"></span>TAM BAXIŞ</a></section>
                </section>
            @endforeach
        @endif
    </section>
    <section id="sehifeler">
        {{$mallar->links('vendor.pagination.bootstrap-4')}}
    </section>
@endsection