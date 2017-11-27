<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 20.08.2017
 * Time: 10:23
 */
?>
@extends('layouts.admin')

@section('content')
    <style>
        td{
            vertical-align: middle!important;
            padding: 0;
            text-align: center;
            color:#172029
        }
        th{
            font-weight: 700;
            text-align: center;
        }
        *{
            outline: none;
        }
        .clearfix:before, .clearfix:after, .dl-horizontal dd:before, .dl-horizontal dd:after, .container:before, .container:after, .container-fluid:before, .container-fluid:after, .row:before, .row:after, .form-horizontal .form-group:before, .form-horizontal .form-group:after, .btn-toolbar:before, .btn-toolbar:after, .btn-group-vertical > .btn-group:before, .btn-group-vertical > .btn-group:after, .nav:before, .nav:after, .navbar:before, .navbar:after, .navbar-header:before, .navbar-header:after, .navbar-collapse:before, .navbar-collapse:after, .pager:before, .pager:after, .panel-body:before, .panel-body:after, .modal-header:before, .modal-header:after, .modal-footer:before, .modal-footer:after{
            content:none;
        }
    </style>
    <div class="container" style="width: 100%">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('mallar.elaveet-form')}}"><button class="elaveet btn btn-danger btn-xs" data-title="Sil" style="width: 85px;display: flex;justify-content: center;align-items: center;margin-bottom: 15px;" data-toggle="modal" data-target="#add" >
                        <span class="entypo-plus" style="font-size: 20px;"></span>Əlavə et
                    </button></a>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>№</th>
                            <th>Ad</th>
                            <th>Kod</th>
                            <th>Qiymət</th>
                            <th>Stok</th>
                            <th>Məlumat</th>
                            <th>Endirim</th>
                            <th>Əlavə edilib</th>
                            <th>Bax</th>
                            <th>Dəyişdir</th>
                            <th>Sil</th>
                        </thead>
                        <tbody>
                            @foreach($infomal as $mal)
                                <tr>
                                    <td>{{$mal['id']}}</td>
                                    <td>{{ucfirst(mb_strtolower($mal['ad']))}}</td>
                                    <td>{{$mal['kod']}}</td>
                                    <td>{{$mal['qiymet']}}</td>
                                    <td>{{($mal['stok']*1)==1?'YES':'NO'}}</td>
                                    <td>{{ucfirst(mb_strtolower($mal['melumat']))}}...</td>
                                    <td>{{$mal['endirim']}}</td>
                                    <td>{{$mal['created_at']}}</td>
                                    <td>
                                        <a href="{{route('mallar.bax',['id'=>$mal['id']])}}" style="margin: 0" data-placement="top" data-toggle="tooltip" title="Bax">
                                            <button class="delete btn btn-info btn-xs" style="width: 30px;">
                                                <span class="entypo-eye" style="font-size: 15px;position: relative;left: -1px"></span>
                                            </button>
                                            <input type="hidden" value="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('mallar.deyis-form',['id'=>$mal['id']])}}" style="margin: 0" data-placement="top" data-toggle="tooltip" title="Dəyişdir">
                                            <button  class="edit btn btn-primary btn-xs">
                                                <span style="font-size: 15px;" class="entypo-pencil"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a style="margin: 0" data-placement="top" data-toggle="tooltip" title="Sil">
                                            <button onclick='$(this).next("form").submit()' class="delete btn btn-danger btn-xs" style="width: 30px;">
                                                <span class="" style="font-size: 15px;">&times;</span>
                                            </button>
                                            {{ Form::open([
                                                    'url' => route('mallar.sil',['id'=>$mal['id']]),
                                                    'method'=> 'POST'
                                                    ])}}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::close() }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
