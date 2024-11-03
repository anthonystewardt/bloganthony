```bash
    php artisan serve

    # Listas
    php artisan route:list
    php artisan r:l --path:cursos
    # en production podemos cachear las rutas y limpiarlas
    php artisan route:cache
    php artisan route:clear
    # end Listas
```

## Directivas de blade

```php
        // visualizacion de datos
    public function index()
    {
        $dato = "Listado de Posts hehe";

        return view('posts.index', compact('dato'));
    }

    // blade
    <body>
        {{ $dato }}
    </body>
```

- Marco Blade y javascript

```php
    <script>
        var posts = {!! @json_encode($posts) !!}
        console.log(posts)

        const postsShort = @json($posts) // parece que este ya no existe
        console.log("postsShort")

    </script>
```

- Condicionales

```php

       @if (false)
        <p>Existe el value</p>
    @else
        <p>No existe el value</p>
    @endif

    @unless (true)
        <p>No existe el value - unless</p>
    @else
        <p>Existe el value - unless</p>
    @endunless

    @isset($value2)
        <p>Existe el value - isset</p>
    @else
        <p>No existe el value - isset</p>
    @endisset

    @empty($value_empty)
        <p>No existe el value - empty</p>
    @else
        <p>Existe el value - empty</p>
    @endempty

```

- ENV

```php
     @production
        <h1>Estamos en production</h1>
    @else
        <h1>Estamos en desarrollo</h1>
    @endproduction
```

# Migraciones

```bash
    php artisan make:migration create_posts_table
    php artisan migrate
```

## Revertir cambios

```bash
    php artisan migrate:rollback  # elimina la migración
    php artisan migrate:rollback  --step=1
    php  artisan migrate:reset # eliminará todos los datos de la db
    php artisan migrate:refresh # primero aplica el down y luego el up
    php artisan migrate:fresh # parecido al refresh (elina todo luego las crea)
    php artisan migrate:migration add_slug_to_posts_table  # alterar o agregar una nueva columna a posts table
```

```php
      public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->text('resumen')
            ->first()
            ->after('title')
            ->before('created_at')
            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('resumen');
        });
    }
```

```bash
    php artisan make:migration drop_posts_table  # elimina la tabla
```

```php
    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('posts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }
};

```

## Tipo de datos

```php
     public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); 
            $table->boolean('is_active')->default(true);
            $table->string('name');
            $table->dateTime('created_at');
            $table->time('time');
            $table->decimal('price', 8, 2); // 8 digits in total, 2 after the decimal point
            $table->text('description');
            $table->string('slug')->unique();
            $table->enum('status', ['active', 'inactive', 'pending']);
            $table->float('rating', 8, 2); // 8 digits in total, 2 after the decimal point
            $table->foreignId('category_id')->constrained();

            $table->json('options'); // JSON column  example {"color": "red", "size": "XL"}
            $table->mediumText('content'); // MEDIUMTEXT column 16777215 characters
            $table->longText('body'); // LONGTEXT column 4294967295 characters
            $table->morphs('taggable'); // taggable_id and taggable_type columns
             $table->timestamp("created_at")
                ->useCurrent(); // created_at and updated_at columns with CURRENT_TIMESTAMP as default value

            $table->timestamps();
        });
    }
```

## Cambiar el tipo de dato de una columna

```bash
    php artisan make:migration alter_to_posts_table
```

```php
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->mediumText('body')
            ->change(); // es importante poner el change
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->longText('body');
        });
    }
```

## Renombrar columnas

```php
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('body', 'content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('content', 'body');
        });
    }
```

- Nota:

    Para que funcione el renombramiento de una columna a otra se debe de instalar un paquete

    ```bash
        composer require doctrine/dbal
    ```

### Eliminar una columna

```php
      */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->text('body');
        });
    }
```

### Indices

