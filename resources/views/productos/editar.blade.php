<style type="text/css">
  img{
    cursor: pointer;
  }
  img.principal{
    border-color: #f2d775;
    box-shadow: 0 0 0 0.25rem rgb(255 199 0 / 34%);
  }
</style>
<x-layout>
    <main class="container-lg mt-5">
		<a href="{{route('productos')}}" class="btn btn-secondary offset-sm-3 mb-5">Volver</a>
        <form class="col-sm-6 offset-sm-3" method="post" action="#" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="codigo" class="form-label">Código *</label>
              <input type="text" name="codigo" class="form-control" id="codigo" maxlength="150" placeholder="Código único del producto" required>
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre *</label>
              <input type="text" name="nombre" class="form-control" id="nombre" maxlength="200" placeholder="Nombre visible del producto" required>
            </div>
            <div class="mb-3">
              <label for="precio" class="form-label">Precio *</label>
              <div class="input-group">
                <input type="number" name="precio" class="form-control" id="precio" min="0.01" step="0.01"  required>
                <span class="input-group-text">€</span>
              </div>
              <p class="form-text">El precio base del artículo. En el listado se podrán aplicar los descuentos temporales.</p>
            </div>
            <div class="mb-3">
              <label for="categoria" class="form-label">Categoría *</label>
              <select class="form-select" name="categoria" id="categoria" required>
                <option></option>
              </select>
            </div>
            <div class="mb-3">
              <label for="marca" class="form-label">Marca *</label>
              <select class="form-select" name="marca" id="marca" required>
                <option></option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Fotos</label>
              <div class="row">
                <div class="col-6 col-sm-4 col-md-3 mb-1">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg" class="img-thumbnail">
                </div>
                <div class="col-6 col-sm-4 col-md-3 mb-1">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg" class="img-thumbnail principal" data-bs-toggle="modal" data-bs-target="#modalFoto">
                </div>
                <div class="col-6 col-sm-4 col-md-3 mb-1">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg" class="img-thumbnail">
                </div>
                <div class="col-6 col-sm-4 col-md-3 mb-1">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg" class="img-thumbnail">
                </div>
              </div>
              <label for="subeFoto">Cargar foto</label>
              <input type="file" class="form-control mt-1" id="subeFoto" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Peso/Volumen</label>
              <div class="row">
                <div class="col-8">
                  <input type="number" class="form-control" name="peso" min="0">
                </div>
                <div class="col-4">
                  <select class="form-select" name="unidad">
                    <option val="gr">Gr</option>
                    <option val="kg">Kg</option>
                    <option val="l">L</option>
                    <option val="ml">Ml</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="ingredientes" class="form-label">Ingredientes</label>
              <textarea name="ingredientes" class="form-control" id="ingredientes" rows="4"></textarea>
            </div>
            <div class="mb-3">
              <label for="valores" class="form-label">Valores nutricionales (por cada 100 gr/ml de producto)</label>
              <table>
                <tbody>
                  <tr>
                    <td>KCAL</td>
                    <td>
                      <input type="number" class="form-control" name="kcal" min="0" step="1">
                    </td>
                  </tr>
                  <tr>
                    <td>Grasas</td>
                    <td>
                      <input type="number" class="form-control" name="grasas" min="0" step="0.01">
                    </td>
                  </tr>
                  <tr>
                    <td>Grasas saturadas</td>
                    <td>
                      <input type="number" class="form-control" name="saturadas" min="0" step="0.01">
                    </td>
                  </tr>
                  <tr>
                    <td>Hidratos de carbono</td>
                    <td>
                      <input type="number" class="form-control" name="hidratos" min="0" step="0.01">
                    </td>
                  </tr>
                  <tr>
                    <td>Azúcares</td>
                    <td>
                      <input type="number" class="form-control" name="azucar" min="0" step="0.01">
                    </td>
                  </tr>
                  <tr>
                    <td>Proteínas</td>
                    <td>
                      <input type="number" class="form-control" name="proteinas" min="0" step="0.01">
                    </td>
                  </tr>
                  <tr>
                    <td>Sal</td>
                    <td>
                      <input type="number" class="form-control" name="sal" min="0" step="0.01">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-6">
                  <label class="form-label" for="stock">Stock</label>
                  <input type="number" class="form-control" id="stock" name="stock" min="0" required step="1" value="0">
                </div>
                <div class="col-6">
                  <label class="form-label" for="aviso">Aviso</label>
                  <input type="number" class="form-control" id="aviso" name="aviso" min="0" required step="1" value="0">
                </div>
              </div>
              <p class="form-text">Se enviará un aviso por email cuando el stock alcance la cantidad indicada en el campo Aviso.</p>
            </div>
            <div class="mb-3">
              <label class="form-label">Etiquetas</label>
              <div class="row">
                <div class="col">
                  <table class="table">
                    <thead>
                      <th>Grupo</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <input class="form-check-input" type="checkbox" value="" id="demoetiqueta">
                          <label class="form-check-label" for="demoetiqueta">
                            Etiqueta
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="form-check-input" id="etiqueta"><label class="form-check-label" for="eqitueta">Etiqueta</label></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="form-check-input" id="etiqueta"><label class="form-check-label" for="eqitueta">Etiqueta</label></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="form-check-input" id="etiqueta"><label class="form-check-label" for="eqitueta">Etiqueta</label></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col">
                  <table class="table">
                    <thead>
                      <th>Grupo</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox" class="form-check-input" id="etiqueta"><label class="form-check-label" for="etiqueta">Etiqueta</label></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="form-check-input" id="etiqueta"><label class="form-check-label" for="eqitueta">Etiqueta</label></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="form-check-input" id="etiqueta"><label class="form-check-label" for="eqitueta">Etiqueta</label></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="form-check-input" id="etiqueta"><label class="form-check-label" for="eqitueta">Etiqueta</label></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="mb-3 text-center">
              <button class="btn btn-danger me-4">Borrar</button>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </main>
    <div class="modal" tabindex="-1" id="modalFoto">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg" class="img-fluid" id="fotoGrande">
                </div>
                <div></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger">Borrar</button>
                <button type="button" class="btn btn-primary">Hacer principal</button>
            </div>
        </div>
      </div>
    </div>
</x-layout>