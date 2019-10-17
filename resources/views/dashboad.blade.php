@extends('layouts.master')

@section('content')
@include('includes.message-block')
<section class="row new-post">
<div class="col-md-6 col-md-offset-3">
<header><h3> What you have to say ?</h3></header>
<form action="{{route('cpost')}}" method="post">
<div class="form-group">
<textarea class="form-control" name="body" id="new-post"  rows="5" placeholder="Your post"></textarea>
</div>
<button type="submit" class="btn btn-primary"> 
new post</button>
<input type="hidden" value="{{Session::token()}}" name="_token">
</form>
</div>
</section>
<section class="row posts">
<div class="col-md-6 col-md-offset-3">
<header><h3>What other people say..</h3>
</header>
@foreach($posts as $post)

<article class="post" data-postid="{{ $post->id}}">

<p>{{ $post->body}}</p>
<div class="info">
Posted by {{$post->user->name}} on {{$post->created_at}}
</div>
<div class="interaction">

<a href="#" class="like">{{ Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like == 1 ? 'You like this post' : 'Like':'Like'}}</a>|
<a href="#" class="like">{{ Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like == 0 ? 'You don\t like this post' : 'DisLike':'DisLike'}}</a>|
@if(Auth::user()==$post->user)
<a href="#" class="edit">Edit</a>|
<a href="{{ route('post.delete' , ['post_id'=>$post->id])}}">Delete</a>|
@endif
</div>
</article>

@endforeach

</div>

</section>

<div class="modal fade" id="edit-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit post</h4>
        </div>
        <div class="modal-body">
       <form> 
       <div class="form-group">
       <label for="post-body">Edit the post</label>
       <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
       </div>
       </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal-save">Save Changes</button>
        </div>
      </div>
      
    </div>
  </div>
<script>
var token ='{{Session::token()}}' ;
var urlEdit = '{{ route('edit')}}';
var urlLike = '{{ route('like')}}';
</script>
@endsection
