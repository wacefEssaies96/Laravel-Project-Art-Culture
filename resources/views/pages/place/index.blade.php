<header class="card-header">
            <p class="card-header-title">Places</p>
            <a class="button is-info" href="{{ route('places.create') }}">Ajouter un Produit</a>
        </header>
                    <tbody>

                    @foreach($places as $place)
                        <tr>
                            <td>{{$place->id }}</td>
                            <td>{{$place->nom}}</td>
                            <td>{{$place->adresse}}</td>


                            <td>
                                <a class="button is-primary" href="{{ route('places.show',$place->id) }}">
                                    Détails</a>
                                {{--  <a class="btn btn-outline-success" href="{{ route('places.edit',$place->id) }}">Modifier</a>
                                  <form action="{{ route('places.destroy',$place->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-outline-success">Delete</button>
                                  </form>
  --}}</td>
                            <td><a class="button is-warning" href="{{ route('places.edit', $place->id) }}">Modifier</a></td>
                            <td>
                                <form action="{{ route('places.destroy',$place->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" >Delete</button>
                                </form>

                            </td>

                        </tr>
                    @endforeach

</tbody>
