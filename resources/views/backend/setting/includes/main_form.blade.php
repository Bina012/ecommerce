<div class="form-group">
    {!! Form::label('name', 'Name'); !!}
    {!! Form::text('name', null,['class' => 'form-control']); !!}
    @include('backend.common.validation_field',['field' => 'name'])
</div>
<div class="form-group">
    {!! Form::label('address', 'Address'); !!}
    {!! Form::text('address', null,['class' => 'form-control']); !!}
    @include('backend.common.validation_field',['field' => 'address'])

</div>
<div class="form-group">
    {!! Form::label('email', 'Email'); !!}
    {!! Form::text('email', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('phone', 'Phone'); !!}
    {!! Form::number('phone', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('pan_no', 'Pan no.'); !!}
    {!! Form::number('pan_no', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('logo', 'Logo'); !!}
    {!! Form::file('logo',['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('fav_icon', 'Fav Icon'); !!}
    {!! Form::file('fav_icon',['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('facebook', 'Facebook'); !!}
    {!! Form::text('facebook', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('twitter', 'Twitter'); !!}
    {!! Form::text('twitter', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('youtube', 'Youtube'); !!}
    {!! Form::text('youtube', null,['class' => 'form-control']); !!}
</div>

<div class="form-group">
    {!! Form::label('instagram', 'Instagram'); !!}
    {!! Form::text('instagram', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('google_map', 'Google map'); !!}
    {!! Form::text('google_map', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('status', 'Status'); !!}
    {!! Form::radio('status', 1); !!} Active
    {!! Form::radio('status', 0,true); !!} Deactive
</div>
<div class="form-group">
    {!! Form::submit('Save ' . $panel, ['class' => 'btn btn-info']); !!}
    {!! Form::reset('Clear', ['class' => 'btn btn-danger']); !!}
</div>
