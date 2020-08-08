@extends('layouts.master')
@section('content')
    <div class="col-md-12 mb-5">
        <h1>Blog <a href="{{ route('post.ajouter') }}" class="btn btn-primary float-right">Add New Post</a></h1>
    </div>
    <div class="row">
        <div class="col-md-8">
            @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    <h3>{{ $post->title }} #{{ $post->id }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ $post->content }}</p>
                </div>
                <div class="card-footer post-{{ $post->id }}">
                    <button class="btn like" style="box-shadow: 0px 0px 0px 0px !important;" onClick="like({{ $post->id }}, {{ Auth::user()->id }})"><img id="image-{{ $post->id }}" src="{{ (App\Like::where([['user_id',Auth::user()->id],['post_id',$post->id]] )->first()) == true ? asset('assets/svg/heart_colors.svg') : asset('assets/svg/heart.svg') }}" width="25px" alt=""></button>
                    <button class="btn count"> {{ count($post->likes) }} </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <form action="{{ route('post.ajouter') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Ajouter un nouveau utilisateur</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var token = document.querySelector('meta[name="csrf-token"]').content;
        function like(postid, userid){
            $(`#image-${postid}`).attr('src', "{{ asset('assets/svg/loading.svg') }}");
            axios.post('{{ route("post.like") }}',{
                _token: token,
                post: postid,
                user: userid
            }).then((response) => {
                var like = $(`#image-${postid}`);
                var count = $(`.post-${postid}`).find('.count');
                if(response.data.like == 'disliked'){
                    var total = parseInt(count.text()) - 1;
                    count.text(total);
                    like.attr('src', "{{ asset('assets/svg/heart.svg') }}");
                }else{
                    var total = parseInt(count.text()) + 1;
                    count.text(total);
                    like.attr('src', "{{ asset('assets/svg/heart_colors.svg') }}");
                }
            }).catch((error) => {
                console.log(error);
            })
        }
    </script>
@endsection