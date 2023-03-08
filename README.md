# Prueba_ItBussines_Laravel_vue_Postgres
Prueba de validación de conocimiento
Bienvenido. 
Esta es la prueba técnica para validar mis conocimientos y fortalezas en el mundo de Backend y frontend utilizando el framework de laravel, vue.js, y con base de datos Postgresql, demostrando así mi capacidad de arquitectura de codigo, patrones de diseño, clean code, normas SOLID, REST y demás para el mundo de It Business.

# Contenido
- Proyecto a realizar
- Modelo relacional base de datos.
- Patron de diseño.
- Herramientas de desarrollo utilizadas.
- Probar sin descargar
- Maual de uso
- Como descargar y ponerlo a correr en local

# Proyecto a realizar
El gerente de operaciones 
hoteleras requiere un sistema que permita ingresar los hoteles con los que cuenta la compañía, 
además de los nombres básicos del hotel, se deben ingresar los datos tributarios básicos.
Adicional a eso el gerente hotelero requiere que a los hoteles con los que cuenta la compañía, 
se les pueda asignar los tipos de habitación (Estándar, Junior y Suite). Este sistema debe validar 
que únicamente se pueda asignar las acomodaciones según el tipo:
- Si el tipo de habitación es Estándar: la acomodación debe ser Sencilla o Doble.
- Si el tipo de habitación es Junior: la acomodación debe ser Triple o Cuádruple
- Si el tipo de habitación es Suite: la acomodación debe ser Sencilla, Doble o Triple
# Modelo relacional base de datos
Se toma como tabla principal "hotel" en la cual encapsulamos todos los datos requeridos, los cuales son los datos tributarios basicos de un hotel, creamos la tabla "acoomodation" en la cual se encapsula la informacion de tanto el tipo de habitacion con la acomodacion de la misma, con las cuales se crea llave foranea en la cual vemos relacion de una a muchas teniendo como 1 el id del hotel y mucas los tipos y acomodaciones que se le puede dar a la habitacion, se genera la migracion de bases genericas de laravel, y de igual manera se crean a partir de script por migraciones para una sencilla ejecucion con el comando php artisan migration.

![image](https://user-images.githubusercontent.com/79348915/223677687-696cbb77-0d61-4b16-a011-bc31a1d099f3.png)
![image](https://user-images.githubusercontent.com/79348915/223677999-43cb2a0f-ab53-48ec-b4cf-ee59cf01b586.png)
![image](https://user-images.githubusercontent.com/79348915/223678094-d3aa2f05-5749-42c0-81c8-4b8e4a5f975d.png)


# Patrón de diseño:
Para la arquitectura se implementaron conceptos de patron repositorio para no depender de la arquitectura por defecto de laravel, la cual es MVC. Utilizando patron repositorio un mecanismo para encapsular el comportamiento de almacenamiento, obtención y búsqueda, de una forma similar a una colección de objetos (parecida a una lista o arreglo), centralizando responsabilidades a cada una de las clases, así siguiendo el principio de responsabilidad unica, que se implementa en dichas clases que cumplen más de una responsabilidad, como controladores, modelos de dominio, repositorios entre otros. Se implementaron normas REST para el API.

# HERRAMIENTAS DE DESARROLLO UTILIZADAS
- Laravel 8 Framework 
- PHP 7.3.0
- visual studio code
- xampp
- Postgresql pgAdmin4
- Git
- GitHub
- vue2
- node 9.5.0
- composer 2.5.4

# Manual de uso 
Vista principal: 
En esta se encontraran con una tabla en la cual se veran reflejados todos los registros de creacion de hoteles que no se hayan eliminado previamente.

![image](https://user-images.githubusercontent.com/79348915/223685641-0393f33d-5c1a-481b-b676-1647e2dd6fe9.png)

esta tabla en dado caso el rango de registros lo requiera se podra generar una busqueda a partir del nombre del hotel, ingesando el dato en el input o caja de texto de la parte superior.

![image](https://user-images.githubusercontent.com/79348915/223686086-69fefba2-db7c-4511-8887-dd6afb919f38.png)

Arriba a mano derecha nos encontramos con el boton para ingresar al modal de la creacion del hotel 

![image](https://user-images.githubusercontent.com/79348915/223686290-8dde8f00-a026-4cff-b06b-4ca7a7d409f0.png)

En la tabla nos encontraremos dos botones generados en la columna de opciones uno de estos para eliminar el registro del hotel

![image](https://user-images.githubusercontent.com/79348915/223686416-937a38f9-bc19-46fa-a0c0-5c50b48cec1a.png)

y otro para generar la asignacion de habitaciones

![image](https://user-images.githubusercontent.com/79348915/223686501-7001ff78-954f-483d-a8fd-386c68670f96.png)

Esta tabla maneja un conteo de registros a la parte inferior y un paginado cuando los registros lo requieran

![image](https://user-images.githubusercontent.com/79348915/223686593-15fafab4-22b6-4e2d-b3a4-714ffbaf93ae.png)
Modulo Creacion registro hotel

En este modal nos encontraremos con 5 espacios para la creacion del registro, en los cuales se agregaran 5 tipos de datos los cuales todos son necesarios, Nombre, Ciudad, Direccion, NIT de la empresa, y cantidad de habitaciones que este tendra disponibles.

![image](https://user-images.githubusercontent.com/79348915/223686736-da8e47f4-e726-4f77-8f06-9c748ae1b328.png)

La creacion del registro cuenta con restricciones, como lo es que no se puede crear el mismo hotel, o que alguno de los datos requeridos no se ingrese, en ests casos apareceran alertas indicando en campo faltante o el error al que estamos incitando.

![image](https://user-images.githubusercontent.com/79348915/223686879-7161efea-05f4-49e5-a2e9-8fc3ad0fdf47.png)
![image](https://user-images.githubusercontent.com/79348915/223687140-e68c5ab1-2f00-4da1-90a7-8738e6ff7ed3.png)
![image](https://user-images.githubusercontent.com/79348915/223687367-fa590c34-47d4-46bf-a531-5eacb0e43c97.png)

Boton y Modal asignacion
Al darle click al boton lo preparamos para el ingreso de los datos lo cual nos mostrara una alerta indicandonos de ello, al darle ok se puede generar nuevamente el click a este para entrar al modal de asignacion.

![image](https://user-images.githubusercontent.com/79348915/223687474-faa9fd2a-7d70-4716-9ee5-dbbbf7c25e31.png)
![image](https://user-images.githubusercontent.com/79348915/223687557-35d6eac4-3b64-4390-bb92-2dc1692cafbf.png)

Si no se da click nuevamente el el boton del hotel elegido nos indicara que no es este el que preparamos

![image](https://user-images.githubusercontent.com/79348915/223687823-6538bb92-c06b-4c4e-ae09-cef8448961c7.png)

Dentro del modal en caso de que este hotel no tenga ningun tipo de acomodacion solo veremos un botoncito verde con el signo "+" en el medio el cual nos empezara a crear el espacio para asignar la acomodacion

![image](https://user-images.githubusercontent.com/79348915/223687999-47a0476b-8a4e-4ae9-9c73-c2e8b558ac58.png)

Este nos abrira tres campos en los cuales nos piden tres datos primordiales y que son requeridos, cantidad de habitaciones a usar para un solo tipo y acomodacion, tipo de acomodacion "ESTANDAR" "JUNIOR" "SUITE" la cual escogeremos de una lista desplegable dando click y el tercer campo es para la acomodacion, en este tambien hay una lista desplegable con cuatro opciones de acomodar la habitacion "Sencilla" "Doble" "Triple" "Quadruple".

![image](https://user-images.githubusercontent.com/79348915/223688117-dcb01c3b-d879-43fe-8844-6db57e1022a7.png)
![image](https://user-images.githubusercontent.com/79348915/223688186-d9c426b2-3487-43e3-944c-b07d45123ec3.png)
![image](https://user-images.githubusercontent.com/79348915/223688240-352e9c81-3a63-4819-b17b-59a1fa77604f.png)

De igual manera tambien tiene restricciones, una de ellas es que la sumatoria de las habitaciones a usar no sea mayor al numero disponible de habitaciones con las que el hotel cuenta, la otra es que no se puede repetir tipo de habitacion y acomodacion por hotel, y las generales que son que se tienen que llenar los campos.

![image](https://user-images.githubusercontent.com/79348915/223688474-5c8e9cb2-667e-4b8f-b657-129af3aab351.png)
![image](https://user-images.githubusercontent.com/79348915/223688916-70f572c6-7a34-4611-83da-0840610551d5.png)

Boton Eliminar:
Este boton al dale click nos generara una alerta indicandonos que si estamos seguros de eliminar este hotel, ya que este se eliminara de manera inmediata, si se decide dar que si se eliminara de base de datos primer los registros de tipo de habitacion y acomodacion y luego el regitro de hotel, al terminar nos indicara que la accion a sido realizada.

![image](https://user-images.githubusercontent.com/79348915/223689027-87d128be-93e8-4dd5-a376-25bf0d07f210.png)
![image](https://user-images.githubusercontent.com/79348915/223689087-b26b2220-ccaf-43fc-bd79-73ead1a62742.png)

# Como descargar y ponerlo a correr en local
  1. Descargar Xampp con version de php 7.3
  2. Descargar node con version 9.5.0
  3. Descargar Postgres version 11
  4. Descargue composer
  5. Abrimos xampp, entramos a htdocs y creamos una carpeta en la cual ira nuestro repositorio
  6. abrimos cualquier editor de codigo "Recomiendo Visual Studio Code" 
  7. habra la terminal y agregue el comando git clone https://github.com/sergiodaza97/Prueba_ItBussines_Laravel_vue_Postgres.git y precione enter
  8. Una vez termine de descargar corra el comando php artisan migration
  9. corra comando npm run watch
  10. habra una terminal alternativa y corra comando php artisan serve
  11. copiar la direccio http y pegarla en su navegador y dar enter.
