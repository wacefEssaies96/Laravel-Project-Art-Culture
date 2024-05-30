<div class="container">
    <h1>Modifier une Place</h1>

    {{-- Afficher les erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de mise à jour --}}
    <form method="POST" action="{{ route('places.update', $place->id) }}">
        @csrf
        @method('PUT')

        {{-- Champ pour le nom --}}
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $place->nom) }}" required>
        </div>

        {{-- Champ pour l'adresse --}}
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse', $place->adresse) }}" required>
        </div>

        {{-- Bouton de soumission du formulaire --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>

    {{-- Lien pour revenir à la liste des places --}}
    <a href="{{ route('places.index') }}" class="btn btn-secondary">Retour à la liste des places</a>
</div>
