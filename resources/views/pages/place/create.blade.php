
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Création lieu</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('places.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nom</label>
                        <div class="control">
                            <input  type="text" name="nom">
                        </div>

                    </div>

                    <div class="field">
                        <label class="label">Adresse</label>
                        <div class="control">
                            <textarea class="textarea"  name="adresse"> </textarea>
                        </div>

                    </div>





                    <div class="field">
                        <div class="control">
                            <button class="button is-link">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

