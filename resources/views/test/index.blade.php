<p>
    Current language is
    {{$book->$title}}

</p>

<p>
    <span class="id">1</span>
    <span class="lang">{{$lang}}</span>
    current lang is from url is ` {{$lang}}
</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    var id = $('.id').html();
    var lang = $('.lang').html();
    $.get( "/test/" + lang + '/get-paragraph',{id:id}, function( data ) {
        console.log(data);
    });
</script>