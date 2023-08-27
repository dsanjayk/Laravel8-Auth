@extends('layouts.app')

@section('content')
    <div style="margin-left:150px;">
    <h1 style="margin-left:60px;">Edit Category</h1>
    <a style="margin-left:60px;" href="{{route('categories.index')}}">Category Lists</a>
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
        <form action="{{route('categories.update', $category->id)}}" method="post">
        @csrf
        @method('PUT')
            <label for="fname">Name:</label><br>
            <input class="form-control" type="text" id="name" name="name" value="{{$category->name}}"><br><br>
            <label for="lname">Description:</label><br>
            <input class="form-control"type="text" id="description" name="description" value="{{$category->description}}"><br><br>
            <label for="lname">Is Parent:</label><br>
            @if($category->is_parent == 1)
                <input type="checkbox" name="is_parent" id="is_parent" value="1" checked>&nbsp; Yes<br><br>
            @else
                <input type="checkbox" name="is_parent" id="is_parent" value="1">&nbsp; Yes<br><br>
            @endif
            <div id="parent_cat_div" class="{{ $category->is_parent == 1 ? 'd-none' : ''}}">
                <label for="lname">Parent Category:</label><br>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="" hidden>Select Parent Category</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}" {{$cat->id == $category->parent_id ? 'selected' : ''}}>{{$cat->name}}</option>
                    @endforeach
                </select><br><br>
            </div>
            <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
        </form> 
    </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>  
    jQuery(document).ready(function(){
        jQuery('#is_parent').on('change',function(e){
            e.preventDefault();
            let is_checked = $(this).prop('checked');
            if( is_checked ){
                jQuery('#parent_cat_div').addClass('d-none');
            }else{
                jQuery('#parent_cat_div').removeClass('d-none');
            }
        });
    });
</script>