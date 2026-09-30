# ESTÁNDARES DEL PROYECTO
## Las Delicias de Mamá Ruby

## 1. Guía de estilo y nombres

**Guía oficial adoptada:** PSR-12.

**Lenguaje del código:** PHP.

**Framework:** Laravel.

**Base de datos:** MySQL.

**Formateador configurado:** Laravel Pint.

### Reglas propias de nombres

1. Las variables utilizarán nombres descriptivos en camelCase.
   Ejemplo: `nombreProducto`.

2. Las funciones y métodos utilizarán nombres descriptivos en camelCase y comenzarán con un verbo que indique la acción.
   Ejemplo: `registrarVenta()`.

3. Las tablas de la base de datos utilizarán nombres en minúscula y las palabras se separarán mediante guion bajo.
   Ejemplo: `detalle_venta`.


## 2. Convención de commits y ramas

### Formato del mensaje

Los mensajes de commit utilizarán el siguiente formato:

`tipo: descripción breve`

### Tipos permitidos

- `feat`: nueva funcionalidad.
- `fix`: corrección de errores.
- `docs`: cambios en documentación.
- `test`: creación o modificación de pruebas.
- `refactor`: modificación del código sin cambiar su comportamiento.

### Ejemplos

`feat: crear modulo de inventario`

`fix: corregir descuento de ingredientes`

`docs: actualizar documentacion`

`test: agregar pruebas de ventas`

### Esquema de ramas

La rama principal será:

`main`

Las nuevas funcionalidades se desarrollarán utilizando:

`feature/nombre-funcionalidad`

Las correcciones se desarrollarán utilizando:

`fix/nombre-correccion`.


## 3. Definition of Ready

Una tarea estará lista para comenzar cuando:

1. El objetivo de la tarea esté definido y sea comprensible.
2. Los requisitos necesarios estén identificados.
3. Los criterios de aceptación estén definidos.
4. Se conozcan los datos necesarios para realizar la tarea.
5. No exista una dependencia pendiente que impida comenzar el trabajo.


## 4. Definition of Done

Una tarea se considerará terminada cuando:

1. La funcionalidad solicitada esté implementada.
2. Los criterios de aceptación se hayan cumplido.
3. La funcionalidad haya sido probada y funcione correctamente.
4. El código haya sido formateado con Laravel Pint.
5. El código no presente errores que impidan utilizar la funcionalidad.
6. Los cambios hayan sido registrados mediante un commit en el repositorio.
7. La documentación necesaria haya sido actualizada.


## 5. Política de revisión

**Quién revisa:** Julian Moreno, responsable del desarrollo del proyecto.

**Plazo:** cada tarea será revisada antes de ser marcada como terminada.

**Qué bloquea:** errores que impidan ejecutar la funcionalidad, incumplimiento de los criterios de aceptación, pérdida de información o funcionamiento incorrecto.

**Qué no bloquea:** errores visuales menores que no afecten la funcionalidad ni el uso del sistema.

**Cómo se comenta:** los comentarios de revisión deberán indicar claramente el problema encontrado, la ubicación del problema cuando sea posible y la corrección requerida.


## 6. Aceptación

**Nombre completo:** Julian Moreno

**Aceptación:** conozco y acepto estos estándares.


**Código de sesión:** LLANO-14
