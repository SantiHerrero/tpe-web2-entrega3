# Todo REST PHP - Perfumes CRUD (TPE Parte 3)

## Qué incluye
Proyecto mínimo en PHP que implementa un CRUD para la tabla `perfumes` y se conecta a MySQL vía PDO.
La librería `libs/router` **no** está incluida (tal como pediste) — pegala en `libs/router/Router.php` antes de ejecutar.

## Estructura
- `config.php` — editar constantes DB_HOST/DB_NAME/DB_USER/DB_PASS
- `index.php` — entrada principal y registro de rutas
- `models/PerfumesModel.php` — acceso a datos (PDO)
- `controllers/PerfumesApiController.php` — lógica de endpoints
- `libs/router/Router.php` — **no incluida**; pegala vos
- `README.md` — este archivo

## Endpoints
Asumiendo que el router expone rutas como en la cátedra y que index.php se ejecuta con `resource` en la query string:
- `GET /index.php?resource=perfumes` — lista (opcional `filter`, `sort`, `order`, `page`, `limit`)
- `GET /index.php?resource=perfumes/1` — obtener por id
- `POST /index.php?resource=perfumes` — crear (JSON body)
- `PUT /index.php?resource=perfumes/1` — actualizar (JSON body)
- `DELETE /index.php?resource=perfumes/1` — eliminar

## Notas
- Payloads esperados en JSON. Por ejemplo para crear:
```json
{
  "id_laboratorio": 1,
  "precio": 123.45,
  "codigo": "ABC123",
  "duracion": 60,
  "aroma": "Floral",
  "sexo": 0
}
```
- Asegurate de tener las tablas `laboratorios` y `perfumes` creadas según el enunciado.
- Si querés que adapte el router para otra firma distinta, pegame el contenido del router y lo integro.

