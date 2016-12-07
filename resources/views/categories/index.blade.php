
<h2>All Categories</h2>
@foreach($categories as $category)
    {{$category->category}}<br/><br/>
@endforeach

<br/>

<h2>Users Categories</h2>
@foreach($usersCategories as $category)
    <a href="categories/{{$category->id}}">{{$category->category}}</a><br/><br/>
@endforeach