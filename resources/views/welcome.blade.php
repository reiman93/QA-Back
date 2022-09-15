 <table class="table table-dark">
  <thead class="thead-dark">
      <tr>
          <th>Nombre</th> 
          <th>Descripcion</th> 
          <th>Acciones</th> 
      </tr>
  </thead>
  <tbody>
    @foreach($data as $e)
      <tr>
      <td>{{$e->name}}</td>
      <td>{{$e->description}}</td>
      <td>Editar |
      <form action="{{url('/area/'.$e->id)}}" method="post" > 
         @csrf 
         {{method_field('DELETE')}}
    <input type="submit" onclick="return confirm('Deseas realmente borrar?')" value="Borrar">
</form>
      </td>
      </tr>
      @endforeach
  </tbody>
</table>
