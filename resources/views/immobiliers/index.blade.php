@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nos Propriétés</h1>
    <div class="row">
        @foreach($immobiliers as $immobilier)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ Storage::url($immobilier->image_path) }}" alt="{{ $immobilier->name }}" class="card-img-top w-full h-64 object-cover">
                {{--  <img src="{{ Storage::url($immobilier->image_path) }}" alt="{{ $immobilier->name }}" class="card-img-top w-full h-64 object-cover">  --}}
                <div class="card-body">
                    <h5 class="card-title">{{ $immobilier->name }}</h5>
                    <p class="card-text">{{ Str::limit($immobilier->description, 100) }}</p>
                    <p class="badge bg-{{ $immobilier->status == 'occupé' ? 'danger' : 'success' }}">
                        {{ $immobilier->status }}
                    </p>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('immobiliers.show', $immobilier) }}" class="btn btn-primary">
                            <i class="bi bi-eye"></i> Voir Détails
                        </a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('immobiliers.edit', $immobilier) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Éditer
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $immobilier->id }}">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmation de Suppression -->
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="modal fade" id="deleteModal-{{ $immobilier->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmation de Suppression</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Es-tu sûr de vouloir supprimer ce bien immobilier ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="{{ route('immobiliers.destroy', $immobilier) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endauth

        @endforeach
    </div>
</div>
@endsection
