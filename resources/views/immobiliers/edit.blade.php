@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier le Bien Immobilier</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('immobiliers.update', $immobilier->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Nom du Bien</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $immobilier->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="category">Catégorie</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ $immobilier->category }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $immobilier->description }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $immobilier->address }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Statut</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="libre" {{ $immobilier->status == 'libre' ? 'selected' : '' }}>Libre</option>
                                <option value="occupé" {{ $immobilier->status == 'occupé' ? 'selected' : '' }}>Occupé</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            {{--  <label for="image">Image (optionnel)</label>  --}}
                            <input type="file" class="form-control-file" id="image" name="image">
                            @if($immobilier->image_path)

                                <img src="{{ asset('storage/' . $immobilier->image_path) }}" class="img-fluid rounded mt-3" width="150" alt="{{ $immobilier->name }}">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
