<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 20.08.2017
 * Time: 10:23
 */
?>
@extends('layouts.admin')
@php $renglerumumi=['qirmizi','qara','çəhrayı','narıncı','sarı','bənövşəyi','yaşıl','mavi','qəhvəyi','ağ','boz'] @endphp

@section('custom-css')
    <link rel="stylesheet" href="{{asset('src/admin/css/jquery.tag-editor.css')}}">
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{asset('src/admin/js/jquery.caret.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('src/admin/js/jquery.tag-editor.min.js')}}"></script>
    <script type="text/javascript">
        $('#olcu').tagEditor({
            initialTags: [
                @foreach($content['olculer'] as $olcu)
                    '{{$olcu}}',
                @endforeach
            ],
            placeholder: 'Ölçüləri yazın və Enter-ə basın',
            onChange: function(field, editor, tags) {
                $.each(tags,function (index,value) {
                        $('input[name=olculer]').val((tags.length ? tags.join(',') : '----'));
                });
            },
            beforeTagDelete: function(field, editor, tags, val) {
                    var input = $('input[name=olculer]');
                    var _tags=input.val();
                    _tags=_tags.replace(val, '');
                    input.val(_tags);
            }
        });

        {{--$('#reng').tagEditor({--}}
            {{--initialTags: [--}}
                {{--@foreach($content['rengler'] as $reng)--}}
                    {{--'{{$reng}}',--}}
                {{--@endforeach--}}
            {{--],--}}
            {{--placeholder: 'Rəngləri yazın və Enter-ə basın',--}}
            {{--onChange: function(field, editor, tags) {--}}
                {{--$.each(tags,function (index,value) {--}}
                    {{--if($.isNumeric(value)){--}}
                        {{--$('#reng').tagEditor('removeTag', value,true);--}}
                    {{--}else{--}}
                        {{--$('input[name=rengler]').val((tags.length ? tags.join(',') : '----'));--}}
                    {{--}--}}
                {{--});--}}
            {{--},--}}
            {{--beforeTagDelete: function(field, editor, tags, val) {--}}
                {{--if(!$.isNumeric(val)){--}}
                    {{--var input = $('input[name=rengler]');--}}
                    {{--var _tags=input.val();--}}
                    {{--_tags=_tags.replace(val, '');--}}
                    {{--input.val(_tags);--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}

        $.fn.silxususiyyet=function () {
            var _span = $(this).parent('span');
            _span.next('div').empty();
            _span.empty();
            xususiyyetNo--;

        };
        @if(isset($content['xususiyyetler']))
            var xususiyyetNo={{count($content['xususiyyetler'])+1}};
        @else
            var xususiyyetNo=1;
        @endif
        $('#btnAddXususiyyet').click(function () {
            var block='<span>'+xususiyyetNo + ')' + '<a onclick="$(this).silxususiyyet()" style="margin-left: 5px">Sil</a></span>' +
                '<div style="margin-bottom: 8px;margin-top: 8px">' +
                '<input type="text" name="xususiyyet[]" placeholder="Xüsusiyyət adı" class="form-control col-sm-6" style="width:calc(50% - 5px);margin-right: 5px" required>' +
                '<input type="text" name="teyinat[]" placeholder="Təyinat" class="form-control col-sm-6" style="width:50%;margin-bottom: 5px" required>' +
                '</div>';
            $(this).parent('div').append(block);
            xususiyyetNo++;
        });

        $.fn.silsekil=function () {
            $(this).parent('span').parent('div').remove();
            sekilNo--;
        };

        var movcudsekilNo={{count($content['sekiller'])}};
        var sekilNo=movcudsekilNo+1;
        $('#btnAddSekil').click(function () {
            var block='<div style="margin-bottom: 8px;margin-top: 8px" class="col-sm-6">\n' +
                '                <span>'+sekilNo+')<a onclick="$(this).silsekil()" style="margin-left: 5px">Sil</a></span>\n' +
                '                <section style="display: flex;align-items: center;">\n' +
                '                    <input type="file" class="custom-file-input" name="sekil[]" required>\n' +
                '                </section>\n' +
                '            </div>';
            $(this).parent('div').append(block);
            sekilNo++;
        });

        $.fn.sekilSil=function(e){
            $(this).parent('div').find('select').prop('disabled',true);
            $(this).parent('div').fadeOut();
            $('form').append('<input type="hidden" name="silineceksekil[]" value='+e+'>');
            if(movcudsekilNo==1){
                var block='<div style="margin-bottom: 8px;margin-top: 8px" class="col-sm-6">\n' +
                    '                <span>'+sekilNo+')</span>\n' +
                    '                <section style="display: flex;align-items: center;">\n' +
                    '                    <input type="file" class="custom-file-input" name="sekil[]" required>\n' +
                    '                </section>\n' +
                    '            </div>';
                $(this).parent('div').parent('div').append(block);
                sekilNo++;
            }else{
                movcudsekilNo--;
                sekilNo--;
            }
        }
    </script>
@endsection

@section('content')

    @php
        $olcuinput='';
        foreach($content['olculer'] as $olcu){
            $olcuinput.=$olcu.',';
        }
        $olcuinput=trim($olcuinput,',');
        $renginput='';
    @endphp
    <style type="text/css">
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
    <section>
        <h1 style="font-weight: bold;margin-bottom: 15px">Dəyişdir</h1>
        <hr>
        {{Html::ul($errors->all(),[
            'style'=>'color:red'
        ]) }}
        <br>
        @if($status = Session::get('status'))
            <span style="color:red">XƏTA: {{$status}}</span>
        @endif
        {{Form::open([
            'url' => route('mallar.deyis',['id'=>$id]),
            'enctype'=>'multipart/form-data',
            ]) }}
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="kodstandart" value="{{$content['kod']}}">
        <div class="form-group col-sm-6">
            {{ Form::label('kod', 'Kod') }}
            {{ Form::text('kod', $content['kod'], array(
                'class' => 'form-control',
                'required'=>'required',
                'placeholder'=>'Malın kodu'
                )) }}
        </div>

        <div class="form-group col-sm-6">
            {{ Form::label('ad', 'Ad') }}
            {{ Form::text('ad', $content['ad'], array(
                'class' => 'form-control',
                'max'=>'35',
                'required'=>'required',
                'placeholder'=>'Malın adı'
                )) }}
        </div>
        <div class="form-group" style="padding-left:15px; padding-right:15px">
            {{ Form::label('melumat', 'Məlumat') }}
            {{ Form::textarea('melumat', $content['melumat'], [
                'class' => 'form-control',
                'style' => 'resize:none',
                'required'=>'required',
                'placeholder'=>'Mal haqqında məlumat'
                ]) }}
        </div>

        <div class="form-group col-sm-6">
            {{ Form::label('olcu', 'Ölçülər') }}
            {{ Form::text('', '' , array(
                'class' => 'form-control',
                'id'=>'olcu',
                'required'=>'required'
                )) }}
        </div>


        <div class="form-group col-sm-6" style="padding-left:15px; padding-right:15px">
            <label for="kateqoriya" class="form-control-label">Kateqoriya</label>
            <select name="kateqoriya" id="kateqoriya" class="form-control" required>
                @if(isset(explode( '_', $content['kateqoriya'])[1]))
                    @foreach($kateqoriyalar as $kateqoriya)
                        @if(is_array($kateqoriya['multi']))
                            <optgroup label="{{ucfirst(mb_strtolower($kateqoriya['kateqoriya_ad']))}}">
                                @foreach($kateqoriya['multi'] as $multikateqoriya)
                                    @if($multikateqoriya['id']==explode('_',$content['kateqoriya'])[1])
                                        <option selected value="{{$kateqoriya['id']}}_{{$multikateqoriya['id']}}" >{{ucfirst(mb_strtolower($multikateqoriya['kateqoriya_ad']))}}</option>
                                    @else
                                        <option value="{{$kateqoriya['id']}}_{{$multikateqoriya['id']}}" >{{ucfirst(mb_strtolower($multikateqoriya['kateqoriya_ad']))}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @else
                            <option value="{{$kateqoriya['id']}}">{{ucfirst(mb_strtolower($kateqoriya['kateqoriya_ad']))}}</option>
                        @endif
                    @endforeach
                @else
                    @foreach($kateqoriyalar as $kateqoriya)
                        @if(is_array($kateqoriya['multi']))
                            <optgroup label="{{ucfirst(mb_strtolower($kateqoriya['kateqoriya_ad']))}}">
                                @foreach($kateqoriya['multi'] as $multikateqoriya)
                                    <option value="{{$kateqoriya['id']}}_{{$multikateqoriya['id']}}" >{{ucfirst(mb_strtolower($multikateqoriya['kateqoriya_ad']))}}</option>
                                @endforeach
                            </optgroup>
                        @else
                            @if($content['kateqoriya']==$kateqoriya['id'])
                                <option value="{{$kateqoriya['id']}}" selected>{{ucfirst(mb_strtolower($kateqoriya['kateqoriya_ad']))}}</option>
                            @else
                                <option value="{{$kateqoriya['id']}}">{{ucfirst(mb_strtolower($kateqoriya['kateqoriya_ad']))}}</option>
                            @endif
                        @endif
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-sm-12">
            <div class="form-group col-sm-6" style="padding-left: 0;">
                {{ Form::label('qiymet', 'Qiymət') }}
                {{ Form::number('qiymet', $content['qiymet'], array(
                    'class' => 'form-control',
                    'required'=>'required',
                    'min'=>'0',
                    'style'=>'padding-right:45px',
                    'placeholder'=>'Malın qiyməti'
                    )) }}
                <span style="position: absolute;right: 25px;top: 30px;font-weight: bold">AZN</span>
            </div>


            <div class="form-group col-sm-5" style="padding-right:0;">
                {{ Form::label('endirim', 'Endirim (yoxdursa 0 yazın)') }}
                {{ Form::number('endirim',trim(mb_strtolower($content['endirim']))=='no'?'0':$content['endirim'] , array(
                    'class' => 'form-control',
                    'id'=>'reng',
                    'required'=>'required'
                    )) }}
                <span style="position: absolute;right: 12px;top: 30px;font-weight: bold">%</span>
            </div>


            <div class="form-group col-sm-1" style="padding-right:0;">
                {{ Form::label('', 'Stokda') }}<br>
                {{ Form::label('stok', 'Var') }}
                {{ Form::checkbox('stok','1',trim(mb_strtolower($content['stok']))=='yes'?1:0,array(
                    'id'=>'reng',
                    'style'=>'position:relative;top:2px'
                    )) }}
            </div>

        </div>

        <div class="form-group col-sm-12" style="">
            {{ Form::label('', 'Əlavə xüsusiyyətlər') }}
            {{ Form::button('Əlavə et', array(
                'class' => 'btn btn-success',
                'style'=>'margin-left:10px;margin-bottom:5px',
                'id'=>'btnAddXususiyyet',
                )) }}
            <br><br>
            @if(isset($content['xususiyyetler']))
                @foreach($content['xususiyyetler'] as $index=>$xususiyyet)
                    <span>{{$index+1}})</span>
                    <div style="margin-bottom: 8px;margin-top: 8px"><input type="text" name="xususiyyet[]" placeholder="Xüsusiyyət adı" class="form-control col-sm-6" style="width:calc(50% - 5px);margin-right: 5px" required="required" value="{{$xususiyyet['xususiyyet']}}"><input type="text" name="teyinat[]" placeholder="Təyinat" class="form-control col-sm-6" style="width:50%;margin-bottom: 5px" required="required" value="{{$xususiyyet['teyinat']}}"></div>
                @endforeach
            @endif
        </div>

        <div class="form-group col-sm-12" style="">
            {{ Form::label('', 'Şəkillər') }}
            {{ Form::button('Əlavə et', array(
                'class' => 'btn btn-success',
                'style'=>'margin-left:10px;margin-bottom:5px',
                'id'=>'btnAddSekil',
                )) }}
            <br>
            <div style="display: flex;justify-content:flex-start;flex-wrap: wrap">
                @foreach($content['sekiller'] as $index=>$sekil)
                    <div style="display:flex;justify-content:flex-start;align-items:center;flex-direction: column;margin-bottom:10px;margin-right: 3px;">
                        <a href="{{asset('src/images/stock/'.$sekil)}}" target="_blank" style="display: flex; justify-content:flex-start;flex-direction: column;align-items:center;">
                            <img src="{{asset('src/images/500x659/'.$sekil)}}" alt="" style="margin-right: 15px">
                        </a>
                        {{--<select name="sekilreng[]" id="" class="form-control" style="margin-top: 15px;">--}}
                            {{--@foreach($renglerumumi as $index2=>$reng)--}}
                                {{--@if($index2==$content['rengler'][$index]['reng'])--}}
                                    {{--<option value="{{$index2}}" selected>{{$reng}}</option>--}}
                                {{--@else--}}
                                    {{--<option value="{{$index2}}">{{$reng}}</option>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                        <a onclick="$(this).sekilSil('{{base64_encode($sekil)}}')" style="color: #fff;background-color: #cc2424;border-color: #b62020;padding: 5px 8px;font-size: 15px;cursor:pointer;line-height: 1.5;margin-top:5px;border-radius: 2px;">Sil</a>
                    </div>
                @endforeach

            </div>

        </div>

        <div class="form-group col-sm-12">
            <button class="btn btn-lg btn-success col-sm-12">
                Dəyişdir
            </button>
        </div>

        <input type="hidden" name="olculer" required value="{{$olcuinput}}">
    </section>
@endsection
