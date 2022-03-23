<div class="form-group">
    {!! Form::label('category_id', 'Category'); !!}
    {!! Form::select('category_id',$data['categories'], null,['class' => 'form-control','placeholder' => 'Select']); !!}
    @include('backend.common.validation_field',['field' => 'category_id'])
</div>
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
    {!! Form::label('rank', 'Rank'); !!}
    {!! Form::number('rank', null,['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('short_description', 'Short Description'); !!}
    {!! Form::textarea('short_description', null,['class' => 'form-control','rows' => 2]); !!}
    @include('backend.common.validation_field',['field' => 'short_description'])

</div>
<div class="form-group">
    {!! Form::label('description', 'Description'); !!}
    {!! Form::textarea('description', null,['class' => 'form-control','rows' => 2]); !!}
</div>
<div class="form-group">
    {!! Form::label('image_file', 'Image'); !!}
    {!! Form::file('image_file',['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('meta_title', 'Meta Title'); !!}
    {!! Form::textarea('meta_title', null,['class' => 'form-control','rows' => 2]); !!}
</div>
<div class="form-group">
    {!! Form::label('meta_Keyword', 'Meta Keyword'); !!}
    {!! Form::textarea('meta_Keyword', null,['class' => 'form-control','rows' => 2]); !!}
</div>
<div class="form-group">
    {!! Form::label('meta_description', 'Meta Description'); !!}
    {!! Form::textarea('meta_description', null,['class' => 'form-control','rows' => 2]); !!}
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
