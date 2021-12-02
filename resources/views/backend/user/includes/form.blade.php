<div class="form-group">
    {!! Form::label('role_id', 'Role'); !!}
    {!! Form::select('role_id',$data['roles'], null,['class' => 'form-control','placeholder' => 'Select role']); !!}
    @include('backend.common.validation_field',['field' => 'role_id'])
</div>
<div class="form-group">
    {!! Form::label('name', 'Name'); !!}
    {!! Form::text('name', null,['class' => 'form-control']); !!}
    @include('backend.common.validation_field',['field' => 'name'])
</div>
<div class="form-group">
    {!! Form::label('email', 'Email'); !!}
    {!! Form::text('email', null,['class' => 'form-control']); !!}
    @include('backend.common.validation_field',['field' => 'email'])
</div>
<div class="form-group">
    {!! Form::label('password', 'Password'); !!}
    {!! Form::password('password',['class' => 'form-control']); !!}
    @include('backend.common.validation_field',['field' => 'password'])
</div>
<div class="form-group">
    {!! Form::submit($button . ' ' . $panel, ['class' => 'btn btn-info']); !!}
    {!! Form::reset('Clear', ['class' => 'btn btn-danger']); !!}
</div>
