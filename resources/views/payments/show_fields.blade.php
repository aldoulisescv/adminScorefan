
<!-- State Id Field -->
<div class="form-group">
    {!! Form::label('state_id', __('models/payments.fields.state_id').':') !!}
    <p>{{ $stateItems[$payment->state_id]  ?? 'Disabled' }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/payments.fields.description').':') !!}
    <p>{{ $payment->description }}</p>
</div>

<!-- Method Id Field -->
<div class="form-group">
    {!! Form::label('method_id', __('models/payments.fields.method_id').':') !!}
    <p>{{ $methodItems[$payment->method_id]  ?? 'Disabled' }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/payments.fields.user_id').':') !!}
    <p>{{ $userItems[$payment->user_id ]  ?? 'Disabled'}}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', __('models/payments.fields.product_id').':') !!}
    <p>{{ $productItems[$payment->product_id ]  ?? 'Disabled'}}</p>
</div>

<!-- Total Field -->
<div class="form-group">
    {!! Form::label('total', __('models/payments.fields.total').':') !!}
    <p>{{ $payment->total }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/payments.fields.created_at').':') !!}
    <p>{{ $payment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/payments.fields.updated_at').':') !!}
    <p>{{ $payment->updated_at }}</p>
</div>

