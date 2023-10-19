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

Creamos la clase o modelo Post dentro de la carpeta App / Models y llamamos al modelo desde route en web.php

![Alt text](image-24.png)

Llamado del modelo Post

![Alt text](image-25.png)

Ahora movemos el codigo anterior que teniamos en nuestro archivo de rutas(web.php) a la clase Post, con algunas modificaciones

![Alt text](image-27.png)

Y volvemos a modificar el archivo de rutas(web.php) para mejorar el codigo

![Alt text](image-26.png)

Modificamos los posts quemados anteriormente por el un foreach

![Alt text](image-28.png)

Luego modificamos en el archivo de rutas, la ruta del home

![Alt text](image-29.png)

Y ya que no temos un metodo all, debemos crearlo

![Alt text](image-30.png)

Asi se ve el home de momento

![Alt text](image-31.png)


Por lo que tenemos que modificar el objeto all

![Alt text](image-32.png)

Y ya se verán nuestros posts

![Alt text](image-34.png)

Agregamos un nuevo archivo post

![Alt text](image-33.png)

Y les colocamos metadata al inicio

![Alt text](image-37.png)

Vamos a instalar yaml-front-matter para manejar la metadata y el body
```bash
composer require spatie/yaml-front-matter
```

![Alt text](image-38.png)

Se agregan variables, un constructor y se modifican los metodos all y find del post.php

```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\HigherOrderCollectionProxy;
use Spatie\YamlFrontMatter\YamlFrontMatter;
class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        return collect(File::files(resource_path("posts")))
        ->map(fn($file) => YamlFrontMatter::parseFile($file))
        ->map(fn($document) => new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        ));
    }

    public static function find($slug){
       return static::all()->firstWhere("slug", $slug);
    }
}
```

El web.php donde van nuestras rutas queda de la siguiente manera
```bash
<?php
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Post;

Route::get('/', function () {   
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('posts/{post}', function ($slug) {    
    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('post', '[A-z_\-]+');
```

El posts.blade.php que carga nuestros posts, siendo este el home basicamente quedaria así
```bash
<!DOCTYPE html>

    <title>My blog</title>
    <link rel="stylesheet" href="/app.css">

<body>
    <?php foreach ($posts as $post) : ?>

        <article>
            <h1>
                <a href="/posts/<?= $post->slug; ?>">
                    <?= $post->title; ?>
                </a>
            </h1>

            <div>
                <?= $post->excerpt;?>
            </div>
        </article>

    <?php endforeach; ?>

</body>

```

Y para que cargue cada uno de los posts selecionados individualmente debemos tener nustro codigo en post.blade.php de la siguiente manera
```bash
<!DOCTYPE html>

    <title>My blog</title>
    <link rel="stylesheet" href="/app.css">

<body>
    <?php foreach ($posts as $post) : ?>

        <article>
            <h1>
                <a href="/posts/<?= $post->slug; ?>">
                    <?= $post->title; ?>
                </a>
            </h1>

            <div>
                <?= $post->excerpt;?>
            </div>
        </article>

    <?php endforeach; ?>

</body>
```

# Collection Sorting and Caching Refresher

Ahora vamos a acomodar los post por fecha de manera descendente y los vamos a guadar en la cache para que no tenga que cargar cada vez que se accede a la pagina 

![Alt text](image-35.png)

```bash
->sortBydesc('date');
```

Y para guardar en cache los post seria colocar todo el metodo all de la siguiente manera
```bash
 public static function all()
    {
        return cache()->rememberForever("posts.all", function () {
            return collect(File::files(resource_path("posts")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) => new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            ))
            ->sortBydesc('date');
        }); 
    }
```
Para validar que si guarda los post en cache podemos acceder a ella por medio del siguente comando
```bash
php artisan tinker
```
![Alt text](image-40.png)

Para eliminar la cache ejecutamos el comando

```bash
cache()->forget('posts.all')
```
![Alt text](image-41.png)

# Blade: The Absolute Basics
Blade es especifico para las vistas, nos facilita el codigo php dentro de ellas
```bash
Antes   -   <?= $post->title; ?>
Despues -   {{ $post->title }}
```
Asi quedaría la pagina de posts.blade.php y una vez aprendido esto podemos crear Layouts

![Alt text](image-42.png)

#

```bash

```


```bash

```


```bash

```


```bash

```