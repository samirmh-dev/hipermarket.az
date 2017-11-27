<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 20.08.2017
 * Time: 10:23
 */
?>
@php $rengler=['qirmizi','qara','çəhrayı','narıncı','sarı','bənövşəyi','yaşıl','mavi','qəhvəyi','ağ','boz'] @endphp


@extends('layouts.admin')

@section('custom-css')
    <link rel="stylesheet" href="{{asset('src/admin/css/jquery.tag-editor.css')}}">
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{asset('src/admin/js/jquery.caret.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('src/admin/js/jquery.tag-editor.min.js')}}"></script>
    <script type="text/javascript">
        $('#olcu').tagEditor({
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

//        $('#reng').tagEditor({
//            placeholder: 'Rəngləri yazın və Enter-ə basın',
//            onChange: function(field, editor, tags) {
//                $.each(tags,function (index,value) {
//                    if($.isNumeric(value)){
//                        $('#reng').tagEditor('removeTag', value,true);
//                    }else{
//                        $('input[name=rengler]').val((tags.length ? tags.join(',') : '----'));
//                    }
//                });
//            },
//            beforeTagDelete: function(field, editor, tags, val) {
//                if(!$.isNumeric(val)){
//                    var input = $('input[name=rengler]');
//                    var _tags=input.val();
//                    _tags=_tags.replace(val, '');
//                    input.val(_tags);
//                }
//            }
//        });

        $.fn.silxususiyyet=function () {
            var _span = $(this).parent('span');
            _span.next('div').empty();
            _span.empty();
        };

        var xususiyyetNo=1;
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
        };

        var sekilNo=2;
        $('#btnAddSekil').click(function () {

            {{--var block='<div style="margin-bottom: 8px;margin-top: 8px" class="col-sm-6">\n' +--}}
                {{--'                <span>'+sekilNo+')<a onclick="$(this).silsekil()" style="margin-left: 5px">Sil</a></span>\n' +--}}
                {{--'                <section style="display: flex;align-items: center;">\n' +--}}
                {{--'                    <input type="file" class="custom-file-input" name="sekil[]" required>\n' +--}}
                {{--'                    <select name="sekilreng[]" class="form-control" required>\n' +--}}
                {{--'                        <option value="" selected disabled>Rəng seçin</option>\n' +--}}
                {{--'                        @foreach($rengler as $index=>$reng)\n' +--}}
                {{--'                            <option value="{{$index}}">{{$reng}}</option>\n' +--}}
                {{--'                        @endforeach\n' +--}}
                {{--'                    </select>\n' +--}}
                {{--'                </section>\n' +--}}
                {{--'            </div>';--}}

            var block='<div style="margin-bottom: 8px;margin-top: 8px" class="col-sm-6">\n' +
                '                <span>'+sekilNo+')<a onclick="$(this).silsekil()" style="margin-left: 5px">Sil</a></span>\n' +
                '                <section style="display: flex;align-items: center;">\n' +
                '                    <input type="file" class="custom-file-input" name="sekil[]" required>\n' +
                '                </section>\n' +
                '            </div>';
            $(this).parent('div').append(block);
            sekilNo++;
        });
    </script>
@endsection

@section('content')
    <style type="text/css">
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
    <section>
        <h1 style="font-weight: bold;margin-bottom: 15px">Mal əlavə et</h1>
        <hr>
        {{Html::ul($errors->all(),[
            'style'=>'color:red'
        ]) }}
        <br>
        @if($status = Session::get('status'))
            <span style="color:red">XƏTA: {{$status}}</span>
        @endif
        {{Form::open([
            'url' => route('mallar.elaveet'),
            'enctype'=>'multipart/form-data',
            ]) }}

        <div class="form-group col-sm-6">
            {{ Form::label('kod', 'Kod') }}
            {{ Form::text('kod', old('kod'), array(
                'class' => 'form-control',
                'required'=>'required',
                'placeholder'=>'Malın kodu'
                )) }}
        </div>

        <div class="form-group col-sm-6">
            {{ Form::label('ad', 'Ad') }}
            {{ Form::text('ad', old('ad'), array(
                'class' => 'form-control',
                'max'=>'35',
                'required'=>'required',
                'placeholder'=>'Malın adı'
                )) }}
        </div>
        <div class="form-group" style="padding-left:15px; padding-right:15px">
            {{ Form::label('melumat', 'Məlumat') }}
            {{ Form::textarea('melumat', old('melumat'), [
                'class' => 'form-control',
                'style' => 'resize:none',
                'required'=>'required',
                'placeholder'=>'Mal haqqında məlumat'
                ]) }}
        </div>

        <div class="form-group col-sm-6">
            {{ Form::label('qiymet', 'Qiymət') }}
            {{ Form::number('qiymet', old('qiymet'), array(
                'class' => 'form-control',
                'required'=>'required',
                'min'=>'0',
                'style'=>'padding-right:45px',
                'placeholder'=>'Malın qiyməti'
                )) }}
            <span style="position: absolute;right: 25px;top: 30px;font-weight: bold">AZN</span>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('olcu', 'Ölçülər') }}
            {{ Form::text('', '' , array(
                'class' => 'form-control',
                'id'=>'olcu',
                'required'=>'required'
                )) }}
        </div>

        <div class="form-group col-sm-12" style="padding-left:15px; padding-right:15px">
            <label for="kateqoriya" class="form-control-label">Kateqoriya</label>
            <select name="kateqoriya" id="kateqoriya" class="form-control" required>
                <option value="" selected disabled>Kateqoriya seçin</option>
                @foreach($kateqoriyalar as $kateqoriya)
                    @if(is_array($kateqoriya['multi']))
                        <optgroup label="{{ucfirst(mb_strtolower($kateqoriya['kateqoriya_ad']))}}">
                        @foreach($kateqoriya['multi'] as $multikateqoriya)
                                <option value="{{$multikateqoriya['fk_kateqoriya_id']}}_{{$multikateqoriya['id']}}">{{ucfirst(mb_strtolower($multikateqoriya['kateqoriya_ad']))}}</option>
                        @endforeach
                        </optgroup>
                    @else
                        <option value="{{$kateqoriya['id']}}">{{ucfirst(mb_strtolower($kateqoriya['kateqoriya_ad']))}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-12" style="">
            {{ Form::label('', 'Əlavə xüsusiyyətlər') }}
            {{ Form::button('Əlavə et', array(
                'class' => 'btn btn-success',
                'style'=>'margin-left:10px;margin-bottom:5px',
                'id'=>'btnAddXususiyyet',
                )) }}<br>
            {{--<span>1)</span>--}}
            {{--<div style="margin-bottom: 8px;margin-top: 8px">--}}
                {{--<input type="text" name="xususiyyet[]" placeholder="Xüsusiyyət adı" class="form-control col-sm-6" style="width:calc(50% - 5px);margin-right: 5px" required value="Firma">--}}
                {{--<input type="text" name="teyinat[]" placeholder="Təyinat" class="form-control col-sm-6" style="width:50%;margin-bottom: 5px" required value="EMASS">--}}
            {{--</div>--}}
            {{--<span>2)</span>--}}
            {{--<div style="margin-bottom: 8px;margin-top: 8px">--}}
                {{--<input type="text" name="xususiyyet[]" placeholder="Xüsusiyyət adı" class="form-control col-sm-6" style="width:calc(50% - 5px);margin-right: 5px" required value="Model">--}}
                {{--<input type="text" name="teyinat[]" placeholder="Təyinat" class="form-control col-sm-6" style="width:50%;margin-bottom: 5px" required value="">--}}
            {{--</div>--}}
            <br>
        </div>

        <div class="form-group col-sm-12" style="">
            {{ Form::label('', 'Şəkillər') }}
            {{ Form::button('Əlavə et', array(
                'class' => 'btn btn-success',
                'style'=>'margin-left:10px;margin-bottom:5px',
                'id'=>'btnAddSekil',
                )) }}
            <br>
            <div style="margin-bottom: 8px;margin-top: 8px" class="col-sm-6">
                <span>1)</span>
                <section style="display: flex;align-items: center;">
                    <input type="file" class="custom-file-input" name="sekil[]" required>
                    {{--<select name="sekilreng[]" class="form-control" required>--}}
                        {{--<option value="" selected disabled>Rəng seçin</option>--}}
                        {{--@foreach($rengler as $index=>$reng)--}}
                            {{--<option value="{{$index}}">{{$reng}}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                </section>
            </div>
        </div>

        <div class="form-group col-sm-12">
            <button class="btn btn-lg btn-success col-sm-12">
                Əlavə et
            </button>
        </div>

        <input type="hidden" name="olculer" required>
    </section>
@endsection
