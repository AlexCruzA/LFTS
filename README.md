# Laravel From Scratch

## My first commit
Archivos base para empezar el curso LFTS a partir de la Section 2

![Alt text](image-1.png)

## Include CSS and Javascript
Modificamos el welcom.blade.php que cargaba la vista basica de laravel creando nuestro propio código

![Alt text](image-2.png)

Agregamos un archivo app.css para dar estilo por medio de css

![Alt text](image-3.png)

Agregamos un archivo app.js para crear código javascript

![Alt text](image-4.png)

## Make a Route and Link to it
Modificamos el nombre de la vista en la carpeta views y el llamado en el archivo web.php de la carpeta routes

![Alt text](image-6.png)

Cambiamos el contenido del html de posts.blade.php

![Alt text](image-5.png)

Junto con el css

![Alt text](image-7.png)

Hacemos los titulos de cada post cliqueables y con un link que redireccione a otra página

![Alt text](image-8.png)

![Alt text](image-9.png)

![Alt text](image-10.png)

Esto se logra creando una nueva vista en la carpeta views

![Alt text](image-11.png)

Y una nueva ruta en web.php

![Alt text](image-12.png)

Una vez creada la nueva vista del post individual, creamos un boton para regresar al Home

![Alt text](image-14.png)

![Alt text](image-13.png)

## Store Blog Posts as HTML Files

Creamos una variable $post que podamos llamar

![Alt text](image-15.png)

Creamos un folder llamado Posts con un archivo html por cada post

![Alt text](image-17.png)

Pero para que funcione la variable $post debemos crearla en el archivo de rutas web.php cambiando un poco el get de la ruta, vamos a crear variables que obtengan la ruta del post seleccionado y vamos a evitar errores cuando se digite una ruta inexistente en la url

![Alt text](image-16.png)

Antes de probar las rutas primero debemos modificarlas en el archivo posts.blade.php

![Alt text](image-19.png)

A nivel de la página se vería de la siguiente manera

![Alt text](image-18.png)

## Route Wildcard Constraints
Para delimitar lo que se puede o no poner en la ruta utilizamos un where para una expresión regular

![Alt text](image-20.png)

## Use Caching for Expensive Operations
Vamos a crear código para que cada vez que se acceda a la ruta nuevamente, la cargue desde la memoria cache y no tenga que pasar por el sistema de archivos en cada hit.

![Alt text](image-21.png)

Así se vería el código de la ruta un poco mas limpio

![Alt text](image-22.png)

## Use the Filesystem Class to Read a Directory
Vamos a cambiar el codigo de la ruta para poder encontrar post especificos y pasarlos a la vista "post". Demos tomar en cuenta que la clase Post no está creada, es el siguiente paso.

![Alt text](image-23.png)

Creamos la clase Post dentro de la carpeta App

