@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">

                <div class="panel-heading">Main Content</div>

                <div class="panel-body">
                    
                    <h2>Create new Activity</h2>

                    <form action="/activities" method="POST">
                        
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Body</label>
                            <textarea name="body" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="title">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-default" value="Create">
                        </div>

                    </form>
                
                </div>  

            </div>

        </div>

    </div>
        
</div>
@endsection
