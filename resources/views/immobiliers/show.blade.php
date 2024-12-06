@extends('layouts.app')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endsection

@section('content')

<div class="container mt-5">
     @if (session('success'))
     <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card custom-card shadow-sm mb-4">
                <img src="{{ asset('storage/' . $immobilier->image_path) }}" alt="{{ $immobilier->name }}" class="card-img-top w-full h-64 object-cover">
                <div class="card-body">
                    <h1 class="card-title">{{ $immobilier->name }}</h1>
                    <p class="card-text">{{ $immobilier->description }}</p>
                    <div class="mb-3">
                        <strong>Catégorie :</strong> {{ $immobilier->category }}<br>
                        <strong>Adresse :</strong> {{ $immobilier->address }}<br>
                        <strong>Statut :</strong>
                        <span class="badge badge-custom bg-{{ $immobilier->status == 'occupé' ? 'danger' : 'success' }}">
                            {{ $immobilier->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @auth
                <div class="card custom-card shadow-sm">
                    <div class="card-header">Ajouter un Commentaire</div>
                    <div class="card-body">
                        <form action="{{ route('commentaires.store', $immobilier) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="3" required style="border-radius: 10px;"></textarea>
                            </div>
                            <button type="submit" class="btn btn-custom">Envoyer</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-custom mt-3">
                    Vous devez être <a href="{{ route('login') }}">connecté</a> pour ajouter un commentaire.
                </div>
            @endauth

            <div class="card custom-card mt-4 shadow-sm">
                <div class="card-header">Commentaires</div>
                <ul class="list-group list-group-flush">
                    @foreach($immobilier->commentaires as $commentaire)
                        <li class="list-group-item">
                            <strong>{{ $commentaire->user->first_name }} {{ $commentaire->user->last_name }}</strong>
                            <p>{{ $commentaire->content }}</p>
                            <small class="text-muted">{{ $commentaire->created_at->diffForHumans() }}</small>
                            @can('delete', $commentaire)
                                <form action="{{ route('commentaires.destroy', $commentaire) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm float-end">Supprimer</button>
                                </form>
                            @endcan
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
