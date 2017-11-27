<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 20.08.2017
 * Time: 10:22
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
    <script>
       $(document).ready(function () {
           $('.edit').click(function () {
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });

               $.post('{{route('kateqoriya-get')}}',{kateqoriya:$(this).siblings('input[type=hidden]').val()},function (data,status) {

                   if(status==='success'){
//                       $('#multiyes').prop('disabled',false);
//                       $('#multino').prop('disabled',false);
                       $('#edit').find('h4#Heading').html('Kateqoriyanın dəyişdirilməsi');
                       $('#edit').find('input#ad').val(data.kateqoriya_ad);
                       $('#edit').find('input#link').val(data.slug);
                       $('.deyisdir').siblings('input[type=hidden]').val(data.id);
                       if(data.multi){
                           $('#editmultiyes').prop('checked',true);
                       }else{
                           $('#editmultino').prop('checked',true);
                       }
                   }else{
                        alert('ERROR');
                   }
               },'json');
           });

           $('.editBagla').click(function () {
               $('#edit').find('h4#Heading').html('Gözləyin..');
               $('#edit').find('input#ad').val('');
               $('#edit').find('input#link').val('');
               $('#edit #multiyes').prop('disabled',true);
               $('#edit #multino').prop('disabled',true);
               $('.deyisdir').siblings('input[type=hidden]').val('');
               $('#error').html('');
               $('#edit #ad').prop('disabled',true);
               $('#edit #link').prop('disabled',true);
           });

           $('#kateqoriyaDeyisdir input#ad').keyup(function () {
               editSlugChange(this);
           });

           $('#kateqoriyaElaveet input#ad').keyup(function () {
              elaveetSlugChange(this);
           });

           $('.deyisdir').click(function () {
               if($('#kateqoriyaDeyisdir input#ad').val()==''){
                   $('#kateqoriyaDeyisdir #error').html('Kateqoriya adı yazın');
                   return;
               }else{

                   $.post('{{route('kateqoriya-deyisdir')}}',$('#kateqoriyaDeyisdir').serialize(),function (data,status) {
                       if(data=='2'){
                           $('#kateqoriyaDeyisdir #error').html('<span style="color: green;">Dəyişiklik yoxdur</span>');
                       }else if(data=='1'){
                           $('#kateqoriyaDeyisdir #error').html('<span style="color: green;">Dəyişdirildi</span>');
                           location.reload();
                       }else if(data=='0'){
                           $('#kateqoriyaDeyisdir #error').html('Bu kateqoriya artıq var');
                       }
                   }).fail(function () {
                        alert('error');
                   });
               }


           });

           $('.editKatAd').click(function () {
               $(this).siblings('input#ad').prop('disabled',false);
               $('input#link').prop('disabled',false);
           });

           $('.editMulti').click(function () {
               $('#edit #editmultiyes').prop('disabled',false);
               $('#edit #editmultino').prop('disabled',false);
           });

           $('.silKateq').click(function () {
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               $.post('{{route('kateqoriya-sil')}}',{kateqoriya:$(this).siblings('input[type=hidden]').val(),_method:'DELETE'},function(data,status){
                    if(status==='success'){
                        data?$('#info').html('<span style="color:green"">Dəyişdirildi</span>'):$('#info').html('<span style="color:red">ERROR</span>');
                        location.reload();
                    }
               }).fail(function () {
                   alert('error');
               });
           });

           $('.delete').click(function () {
              $('#delete').find('input[type=hidden]').val($(this).siblings('input[type=hidden]').val());
           });

           $('.elaveet').click(function () {
              $('#kateqoriyaElaveet').find('#multino').attr('checked',true);
           });

           $('.elaveetButton').click(function () {
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               if($('#kateqoriyaElaveet input#ad').val()==''){
                   $('#kateqoriyaElaveet #error').html('Kateqoriya adı yazın');
                   return;
               }else {
                   $.post('{{route('kateqoriyalar.store')}}',$('#kateqoriyaElaveet').serialize(),function (data,status) {
                       if(status==='success'){
                            if(data=='1'){
                                $('#kateqoriyaElaveet #error').html('<span style="color:green">Əlavə edildi</span>');
                                location.reload();
                            }else{
                                $('#kateqoriyaElaveet #error').html('<span>ERROR</span>');
                            }
                       }
                   }).fail(function () {
                       alert('error');
                   });
               }
           });

           $('.elaveetBagla').click(function () {
               $('#add').find('input[name=ad]').val('');
               $('#add').find('input[name=link]').val('');
           });
       });

       function editSlugChange(e){
           var value=$(e).val().trim().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_ƏəŞşÖöĞğÜü\s]/g, '-');
           $('#kateqoriyaDeyisdir #link').val(value);
       }

       function elaveetSlugChange(e){
           var value=$(e).val().trim().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_ƏəŞşÖöĞğÜü\s]/g, '-');
           $('#kateqoriyaElaveet #link').val(value);
       }

    </script>
    <div class="container" style="width: 100%">
        <div class="row">




            <div class="col-md-12">

                <button class="elaveet btn btn-danger btn-xs" data-title="Sil" style="width: 85px;display: flex;justify-content: center;align-items: center;margin-bottom: 15px;" data-toggle="modal" data-target="#add" >
                    <span class="entypo-plus" style="font-size: 20px;"></span>Əlavə et
                </button>

                <div class="table-responsive">


                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>

                        <th>№</th>
                        <th>Kateqoriya adı</th>
                        <th>Link</th>
                        <th>Multi</th>
                        <th>Yaradılıb</th>
                        <th>Dəyişdirilib</th>
                        <th>Dəyişdir</th>

                        <th>Sil</th>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category['id']}}</td>
                                <td>{{ucfirst(mb_strtolower(trim(htmlspecialchars_decode($category['kateqoriya_ad']))))}}</td>
                                <td>{{mb_strtolower(trim(htmlspecialchars_decode($category['slug'])))}}</td>
                                @if($category['multi'])
                                    <td>YES</td>
                                @else
                                    <td>NO</td>
                                @endif
                                <td>{{$category['created_at']}}</td>
                                <td>{{$category['updated_at']}}</td>
                                <td>
                                    <p style="margin: 0" data-placement="top" data-toggle="tooltip" title="Dəyişdir">
                                        <button  class="edit btn btn-primary btn-xs" data-title="Dəyişdir" data-toggle="modal" data-target="#edit">
                                            <span style="font-size: 15px;" class="entypo-pencil"></span>
                                        </button>
                                        <input type="hidden" value="{{$category['id']}}">
                                    </p>
                                </td>
                                <td>
                                    <p style="margin: 0" data-placement="top" data-toggle="tooltip" title="Sil">
                                        <button class="delete btn btn-danger btn-xs" data-title="Sil" style="width: 30px;" data-toggle="modal" data-target="#delete" >
                                            <span class="" style="font-size: 15px;">&times;</span>
                                        </button>
                                        <input type="hidden" value="{{$category['id']}}">
                                    </p>
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

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close elaveetBagla" data-dismiss="modal" aria-hidden="true"><span class="" aria-hidden="true" >&times;</span></button>
                    <h4 class="modal-title custom_align" id="Heading">Kateqoriya əlavə edilməsi</h4>
                </div>
                <form id="kateqoriyaElaveet">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ad" style="margin-bottom: 10px;">Kateqoriya adı</label>
                            <input class="form-control " id='ad' name="ad" type="text" placeholder="Kateqoriya adı" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Kateqoriya linki</label>
                            <input class="form-control" id="link" name="link" readonly type="text" placeholder="Gozleyin.." value="">
                        </div>
                        <div class="form-group">
                            <label for="">Multi</label>
                            <input type="radio" id="multiyes"  name="multi" value="yes">
                            <label for="multiyes">Yes</label>
                            <input type="radio" id="multino"  name="multi" value="no">
                            <label for="multino">NO</label>
                        </div>
                        <span id="error" style="display:block;font-size: 16px;font-weight:700;color:#B11E22;"></span>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                    <div class="modal-footer ">
                        <button type="button"  class=" elaveetButton btn btn-warning btn-lg" style="width: 100%; background-color: #B11E22;border-color:#B11E22">
                            <span class=""></span> Əlavə et
                        </button>

                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close editBagla" data-dismiss="modal" aria-hidden="true"><span class="" aria-hidden="true" >&times;</span></button>
                    <h4 class="modal-title custom_align" id="Heading">Gozleyin..</h4>
                </div>
                <form id="kateqoriyaDeyisdir">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ad" style="margin-bottom: 10px;">Kateqoriya adı</label>
                        <button type="button" class="editKatAd btn btn-primary btn-xs" data-title="Dəyişdir" data-toggle="" data-target="" style="padding: 0;width: 25px;height: 25px;margin-left: 8px;">
                            <span style="font-size: 15px;" class="entypo-pencil"></span>
                        </button>
                        <input class="form-control " id='ad' disabled name="ad" type="text" placeholder="Gozleyin.." value="">
                    </div>
                    <div class="form-group">
                        <label for="">Kateqoriya linki</label>
                        <input class="form-control" id="link" name="link" disabled readonly type="text" placeholder="Gozleyin.." value="">
                    </div>
                    <div class="form-group">
                        <label for="">Multi</label>
                        <button type="button" class="editMulti btn btn-primary btn-xs" data-title="Dəyişdir" data-toggle="" data-target="" style="padding: 0;width: 25px;height: 25px;margin-left: 8px;">
                            <span style="font-size: 15px;" class="entypo-pencil"></span>
                        </button>

                        <input type="radio" id="editmultiyes" disabled name="multi" value="yes">
                        <label for="editmultiyes">Yes</label>

                        <input type="radio" id="editmultino" disabled name="multi" value="no">
                        <label for="editmultino">NO</label>
                    </div>
                    <span id="error" style="display:block;font-size: 16px;font-weight:700;color:#B11E22;"></span>
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
                <div class="modal-footer ">
                    <button type="button"  class=" deyisdir btn btn-warning btn-lg" style="width: 100%; background-color: #B11E22;border-color:#B11E22">
                        <span class=""></span> Dəyişdir
                    </button>
                    <input type="hidden" name="kateqoriya">
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="" aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title custom_align" id="Heading">Kateqoriya silinməsi</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger" style="display: flex;justify-content: flex-start;align-items: center;"><span style="font-size: 20px;color:#B11E22;margin-right: 8px;">&times;</span> Bu kateqoriyani silməkdə əminsiniz? </div>

                </div>
                <div class="modal-footer " style="display: flex;justify-content: space-between">
                    <span id="info"></span>
                    <section style="display: flex;justify-content: space-between;align-items: center">
                        <button type="button" style="margin-right:10px;padding:0;width:75px;height:33px;display: flex;justify-content:center;align-items: center" class="silKateq btn btn-success" ><span class="entypo-check"></span>Sil</button>
                        <input type="hidden" name="kateqoriya">
                        <button type="button" style="padding:0;width:75px;height:33px;display: flex;justify-content: center;align-items: center"  class="btn btn-default" data-dismiss="modal"><span class="" style="font-size: 20px;color:#B11E22;">&times;</span> Ləğv et</button>
                    </section>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@endsection