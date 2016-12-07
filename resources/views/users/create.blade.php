
    {!! Form::open(array('url' => '/users/', 'method' => 'POST', 'role' => 'form', 'style' => 'max-width:350px; padding:10px;', 'class' => 'center-block img-thumbnail')) !!}
<div class="form-group">
    {!! Form::label('name') !!}
    {!! Form::text('name', null, array('required', 'class'=>'form-control', 'placeholder'=>'Enter user', 'id' => 'title')) !!}
</div>
    <div class="form-group">
        {!! Form::label('email') !!}
        {!! Form::text('email', null, array('required', 'class'=>'form-control', 'placeholder'=>'Enter user', 'id' => 'title')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('country') !!}
        {!! Form::text('country', null, array( 'class'=>'form-control', 'placeholder'=>'Enter user', 'id' => 'title')) !!}
    </div>
<div class="form-group text-center">
    {!! Form::submit('Save!', array('class'=>'btn btn-default')) !!}
</div>
{!! Form::close() !!}
