<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
  margin-left:50px;
  margin-top:50px;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  /* display: none; */
}

.active {
  display: block;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@extends('layouts.app')

@section('content')
    <h1 style="margin-left:60px;">Categories</h1>
    <a style="margin-left:60px;" href="{{route('categories.create')}}">Add Category</a>
    @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>{{session('success')}}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>{{session('success')}}
            </div>
        @endif
    <ul id="myUL">
        @foreach ($categories as $category)
        <li><span class="">{{ $category->name }}</span>&nbsp;<a href="{{route('categories.edit',$category->id)}}">Edit</a><form action="{{route('categories.destroy',$category->id)}}" method="post" style="display:inline">
                     @csrf 
                     @method('delete')
                     <button><i class="fa fa-trash-o"></i></button>
                  </form></li>
            @php
            $child_categories = \App\Models\Category::where('parent_id',$category->id)->get();
            @endphp
            @if( ! empty( $child_categories ) )
                <ul class="nested">
                    @foreach( $child_categories as $child )    
                    <li>{{$child->name}} &nbsp;  <a href="{{route('categories.edit',$child->id)}}">Edit</a>
                    <form action="{{route('categories.destroy',$child->id)}}" method="post" style="display:inline">
                     @csrf 
                     @method('delete')
                     <button><i class="fa fa-trash-o"></i></button>
                  </form></li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
    </ul>

@endsection

<script>
var toggler = document.getElementsByClassName("caret");
var i;
for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>