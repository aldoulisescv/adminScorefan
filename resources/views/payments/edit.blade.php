@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            @lang('models/payments.singular')
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($payment, ['route' => ['payments.update', $payment->id], 'method' => 'patch']) !!}

                        @include('payments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
