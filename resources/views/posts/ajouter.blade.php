@extends('layouts.master')

@section('content')
    <div class="col-md-6 offset-md-3">
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
@endsection