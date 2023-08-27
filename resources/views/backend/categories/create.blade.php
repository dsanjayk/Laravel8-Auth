@extends('layouts.app')

@section('content')
    <div style="margin-left:150px;">
    <h1 style="margin-left:60px;">Add Category</h1>
    <a style="margin-left:60px;" href="{{route('categories.index')}}">Category Lists</a>
       
        <form action="{{route('categories.store')}}" method="post">
        @csrf

            <label for="fname">Name:</label><br>
            <input class="form-control" type="text" id="name" name="name" value=""><br><br>
            <label for="lname">Description:</label><br>
            <input class="form-control"type="text" id="description" name="description" value=""><br><br>
            <label for="lname">Is Parent:</label><br>
            <input type="checkbox" name="is_parent" id="is_parent" value="1">&nbsp; Yes<br><br>
          
            <div id="parent_cat_div">
                <label for="lname">Parent Category:</label><br>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="" hidden>Select Parent Category</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
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