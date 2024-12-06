@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Créer un Nouveau Bien Immobilier</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('immobiliers.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Nom du Bien</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="category">Catégorie</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Statut</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="libre">Libre</option>
                                <option value="occupé">Occupé</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
