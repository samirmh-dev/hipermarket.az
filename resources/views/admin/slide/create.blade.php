@extends('layouts.admin')

@section('content')
    <section>
        <h1 style="font-weight: bold;margin-bottom: 15px">Şəkil əlavə et</h1>
        <hr>
        {{Html::ul($errors->all(),[
            'style'=>'color:red'
        ]) }}
        <br>
        @if($status = Session::get('status'))
            <span style="color:red">XƏTA: {{$status}}</span>
        @endif
        {{Form::open([
            'url' => route('slide.store'),
            'enctype'=>'multipart/form-data',
            ]) }}

        <div class="form-group col-sm-6">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', old('title'), array(
                'class' => 'form-control',
                'required'=>'required',
                'placeholder'=>'Malın üçün title'
                )) }}
        </div>

        <div class="form-group col-sm-6">
            {{ Form::label('mal', 'Mal №') }}
            {{ Form::number('mal', old('mal'), array(
                'class' => 'form-control',
                'required'=>'required',
                'placeholder'=>'Malın nömrəsi'
                )) }}
        </div>

        <div class="form-group col-sm-12">
            <label for="sekilslide">Şəkil seçin</label>
            <input type="file" id="sekilslide" name="sekil">
        </div>

        <div class="form-group col-sm-12">
            <button class="btn btn-lg btn-success col-sm-12">
                Əlavə et
            </button>
        </div>
    </section>
@endsection