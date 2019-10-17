<!DOCTYPE html>
<html>
    <head>
    <title> @yield('title')</title>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
 <style>
.new-post {
    padding:16px 0;
    border-bottom:1px solid #ccc;
}
.new-post header,
.posts header{
    margin-bottom: 20px;

}
.posts .post{
    padding-left:10px;
    border-left: 3px solid #a21b24;
    margin-bottom: 30px;
}

.posts .post .info{
    color:#aaa;
    font-style: italic;
}
.error{
    border: 1px solid red;
    color:black;
    background-color: #d4333f;

}
.error,
.success{
    text-align:center;
}
.error ul{
    list-style:none;
    margin:0;
    padding:0;
}
.success{
    border: 1px solid green;
    color:black;
    background-color: #17d149;
} 
 </style>
  
    </head>
<body>
@include('includes.header')
<div class="content">
@yield('content')
</div>
<!--
  <script src="//code.jquery.com/jquery-1.12.0.min.js">
  </script>
-->
<script   src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<script   src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" ></script>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 <script>

var postId=0;
var postBodyElement = null;
  $('.post').find('.interaction').find('.edit').on('click',function(event){
      event.preventDefault();
      postBodyElement=event.target.parentNode.parentNode.childNodes[1];
      var postBody = postBodyElement.textContent;
      postId = event.target.parentNode.parentNode.dataset['postid'];
      // console.log(postBody);
     $('#post-body').val(postBody);
    $('#edit-modal').modal();
  
});
$('#modal-save').on('click' , function(){
$.ajax({
    method: 'POST',
    url:urlEdit,
    data:{body: $('#post-body').val(), postId:postId , _token:token }
})
.done(function (msg){
   $(postBodyElement).text(msg['new_body']);
   $('#edit-modal').modal('hide');
});
});

$('.like').on('click', function(event){
   
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null ;
     //console.log(isLike);
    $.ajax({
      
        method:'POST',
        url:urlLike,
        data: {isLike:isLike, postId:postId  , _token:token }
        
    })
    .done(function (){
//alert('success');
event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post':'Like' : event.target.innerText == 'DisLike' ? 'You don\ t like this post':'DisLike' ;
   if(isLike){
       event.target.nextElementSibling.innerText = 'DisLike';
   }
   else{
event.target.previousElementSibling.innerText = 'Like';
   }
    }).fail(function(response){
            alert('Something went wrong in this request!');
            console.log(response);
        });
});
</script>
</body>
</html>
