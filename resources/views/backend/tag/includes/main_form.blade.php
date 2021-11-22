
<div class="form-group">
    {!! Form::label('name', 'Name'); !!}
    {!! Form::text('name', null,['class' => 'form-control']); !!}
    @include('backend.common.validation_field',['field' => 'name'])
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug'); !!}
    {!! Form::text('slug', null,['class' => 'form-control']); !!}
    @include('backend.common.validation_field',['field' => 'slug'])

</div>
<div class="form-group">
    {!! Form::label('status', 'Status'); !!}
    {!! Form::radio('status', 1); !!} Active
    {!! Form::radio('status', 0,true); !!} Deactive
</div>
<div class="form-group">
    {!! Form::submit($button . ' ' . $panel, ['class' => 'btn btn-info']); !!}
    {!! Form::reset('Clear', ['class' => 'btn btn-danger']); !!}
</div>
