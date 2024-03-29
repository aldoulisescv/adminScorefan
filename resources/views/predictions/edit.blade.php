@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            @lang('models/predictions.singular')
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($prediction, ['route' => ['predictions.update', $prediction->id], 'method' => 'patch']) !!}

                        @include('predictions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
