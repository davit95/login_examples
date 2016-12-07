@if(isset($category))
    {!! Form::model($category,array('url' => '/categories/'.$category->id, 'method' => 'PUT', 'role' => 'form', 'style' => 'max-width:350px; padding:10px;', 'class' => 'center-block img-thumbnail')) !!}
@else
    {!! Form::open(array('url' => '/categories/', 'method' => 'POST', 'role' => 'form', 'style' => 'max-width:350px; padding:10px;', 'class' => 'center-block img-thumbnail')) !!}
@endif
<div class="form-group">
    {!! Form::label('category') !!}
    {!! Form::text('category', null, array('required', 'class'=>'form-control', 'placeholder'=>'Enter title', 'id' => 'title')) !!}
</div>
<div class="form-group text-center">
    {!! Form::submit('Save!', array('class'=>'btn btn-default')) !!}
</div>
{!! Form::close() !!}
