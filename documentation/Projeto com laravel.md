# Installing Laravel
---
Passo a passo para a instalação do laravel e criação de um projeto base

## instalar php e composer
---
> No Windows (Powershell)
```bash
# Run as administrator...
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows'))
```
> No linux
```bash
/bin/bash -c "$(curl -fsSL https://php.new/install/linux)"
```

## instalar o laravel
---
```bash
composer global require laravel/installer
```
## instalar o node com nvm
---
```bash
# instala a nvm (Node Version Manager, ou Gestor de Pacote de Node)
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.0/install.sh | bash
# descarregar e instalar a Node.js (podemos precisar de reiniciar o terminal)
nvm install 22
# verifica se a versão correta da Node.js está no ambiente
node -v # deve imprimir `v22.11.0`
# verifica se a versão correta da npm está no ambiente
npm -v # deve imprimir `10.9.0`
```

## criar projeto
---
criando projeto com composer
```bash
composer create-project laravel/laravel chirper
```
criando projeto com cli do laravel
```bash
laravel new example-app
```

## iniciar servidor
---
iniciar servidor com artisan
```bash
cd chirper 
php artisan serve
```

instalar dependendias e iniciar servidor
```bash
cd example-app
npm install && npm run build
composer run dev

```

abrir o servidor no browser
---
http://127.0.0.1:8000

em caso de erros
---
caso haja problemas quanto ao banco de dados, certifique-se de que o php possui a extensão para o banco selecionado
- `php8.3-sqlite`
- `php8.3-pgsql`
- `php8.3-mysql`
após instaladas as dependencias, caso necessário rode os migrations
```bash
php artisan migrate
```


# Installing Laravel Breeze
---
Laravel Breeze tem 3 opções para a camada view:
 - Blade templates
 - Livewire
 - JavaScript: Vue and React with Inertia

Instalando o blade
```bash
composer require laravel/breeze --dev 
php artisan breeze:install blade
 ```
 compilar o css
 ```bash
 npm run dev
 ```
foi instalado com o blade um pool de serviços de registro e autenticação
acesse o link
http://localhost:8000/login
https://localhost:8000/register
http://localhost:8000/forgot-password
http://localhost:8000/dashboard
http://localhost:8000/profile


# 03. Creating Chirps
---
```bash
php artisan make:model -mrc Chirp
```

## Adicionando rotas
---
editar o arquivo `routes/web.php`
```php
use App\Http\Controllers\ChirpController;

...

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);
```
verificar as rotas
```bash
php artisan route:list
```

## Testar rota e controller
---
app/Http/Controllers/ChirpController.php
```php
  <?php
  ...
+ use Illuminate\Http\Response; 
 
  class ChirpController extends Controller
  {
      /**
      * Display a listing of the resource.
      */
-     public function index()
+     public function index(): Response 
      {
-          //
+          return response('Hello, World!');
      }
      ...
   }
```
verificar alterações no browser
http://localhost:8000/chirps

## Blade
---
Let's update the index method of our ChirpController class to render a Blade view:

`app/Http/Controllers/ChirpController.php`
```php
<?php
   ...
+ use Illuminate\View\View;
 
  class ChirpController extends Controller
  {
      /**
       * Display a listing of the resource.
       */
-     public function index(): Response
+     public function index(): View
      {
-         return response('Hello, World!');
+         return view('chirps.index');
      }
   ...
  }
```

We can then create our Blade view template with a form for creating new Chirps:
`resources/views/chirps/index.blade.php`
```html
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
```
verificar alterações no browser
http://localhost:8000/chirps

# Navigation Menu
---
add a menu item for desktop screens
`resources/views/layouts/navigation.blade.php`
```html
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
+   <x-nav-link :href="route('chirps.index')" :active="request()->routeIs('chirps.index')">
+       {{ __('Chirps') }}
+   </x-nav-link>
</div>
```
And also for mobile screens:
`resources/views/layouts/navigation.blade.php`
```html
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-responsive-nav-link>
+   <x-responsive-nav-link :href="route('chirps.index')" :active="request()->routeIs('chirps.index')">
+       {{ __('Chirps') }}
+   </x-responsive-nav-link>
</div>
```
verificar alterações no browser
http://localhost:8000/chirps


## Saving the Chirp
---
Let's update the store method on our ChirpController to validate the data and create a new Chirp:

`app/Http/Controllers/ChirpController.php`
```php
<?php
  ...
+ use Illuminate\Http\RedirectResponse;
  use Illuminate\Http\Request;
  use Illuminate\Http\Response;
  use Illuminate\View\View;
 
  class ChirpController extends Controller
  {
   ...
      /**
       * Store a newly created resource in storage.
       */
-     public function store(Request $request)
+     public function store(Request $request): RedirectResponse
      {
-         //
+         $validated = $request->validate([
+             'message' => 'required|string|max:255',
+         ]);
 
+         $request->user()->chirps()->create($validated);
 
+         return redirect(route('chirps.index'));
      }
   ...
  }
```
### Creating a relationship
---
You may have noticed in the previous step that we called a chirps method on the $request->user() object. We need to create this method on our User model to define a "has many" relationship:
`app/Models/User.php`
```php
<?php
 ...
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
 
class User extends Authenticatable
{
  ...
+     public function chirps(): HasMany
+    {
+        return $this->hasMany(Chirp::class);
+    }
}
```
### Mass assignment protection
---
Let's add the $fillable property to our Chirp model to enable mass-assignment for the message attribute:
`app/Models/Chirp.php`
```php
 <?php
   ... 
  class Chirp extends Model
  {
   ...
+    protected $fillable = [
+        'message',
+    ];
  }
```
### Updating the migration
---
```bash
php artisan db:show
php artisan db:table users
``` 

`database/migrations/<timestamp>_create_chirps_table.php` 
```php
<?php
 ...
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chirps', function (Blueprint $table) {
            $table->id();
+           $table->foreignId('user_id')->constrained()->cascadeOnDelete();
+           $table->string('message');
            $table->timestamps();
        });
    }
 ...
};
```
excute command
```bash
php artisan migrate
```
> Each database migration will only be run once. To make additional changes to a table, you will need to create another migration. During development, you may wish to update an undeployed migration and rebuild your database from scratch using the `php artisan migrate:fresh` command.


## Testing it out
---
- If you leave the message field empty, or enter more than 255 characters, then you'll see the validation in action.
http://localhost:8000/chirps



## Artisan Tinker
---
This is great time to learn about Artisan Tinker, a REPL (Read-eval-print loop) where you can execute arbitrary PHP code in your Laravel application.

In your console, start a new tinker session:
```bash
php artisan tinker
```
Next, execute the following code to display the Chirps in your database:
```php
App\Models\Chirp::all();
```
them see all registers from Chirp in JSON format on terminal
you may exit Tinker by using the `exit` command, or by pressing `Ctrl + c`.


## 04. Showing Chirps
---
In the previous step we added the ability to create Chirps, now we're ready to display them!

### Retrieving the Chirps
---
Let's update the index method on our ChirpController class to pass Chirps from every user to our index page:
`app/Http/Controllers/ChirpController.php`
```php
<?php
 ...
class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
-        return view('chirps.index');
+        return view('chirps.index', [
+            'chirps' => Chirp::with('user')->latest()->get(),
+        ]);
    }
 ...
}
```
Here we've used Eloquent's with method to eager-load every Chirp's associated user. We've also used the latest scope to return the records in reverse-chronological order.

## Connecting users to Chirps
---
We've instructed Laravel to return the user relationship so that we can display the name of the Chirp's author. But, the Chirp's user relationship hasn't been defined yet. To fix this, let's add a new "belongs to" relationship to our Chirp model:

`app/Models/Chirp.php`
```php
<?php
 ...
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class Chirp extends Model
{
 ...
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```
This relationship is the inverse of the "has many" relationship we created earlier on the User model.


## Updating our view
Next, let's update our chirps.index component to display the Chirps below our form:

`resources/views/chirps/index.blade.php` 
```php
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->store->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        </form>
 
+        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
+            @foreach ($chirps as $chirp)
+                <div class="p-6 flex space-x-2">
+                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
+                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
+                    </svg>
+                    <div class="flex-1">
+                        <div class="flex justify-between items-center">
+                            <div>
+                                <span class="text-gray-800">{{ $chirp->user->name }}</span>
+                                <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
+                            </div>
+                        </div>
+                        <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
+                    </div>
+                </div>
+            @endforeach
+        </div>
    </div>
</x-app-layout>
```
Now take a look in your browser to see the message you Chirped earlier!
http://127.0.0.1:8000/chirps


# 05. Editing Chirps

## Routing
- First we will update our routes file to enable the chirps.
- Edit and chirps.update routes for our resource controller. 
- The chirps.edit route will display the form for editing a Chirp, 
- The chirps.update route will accept the data from the form and update the model:
`routes/web.php`
```php
<?php
 ...
Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store'])
    ->only(['index', 'store', 'edit', 'update'])
    ->middleware(['auth', 'verified']);
 ...
 ```



## Linking to the edit page
- let's link our new chirps.edit route. 
- use the x-dropdown component that comes with Breeze, which we'll only display to the Chirp author. 
- We'll also display an indication if a Chirp has been edited by comparing the Chirp's created_at date with its updated_at date:

`resources/views/chirps/index.blade.php`
```php
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        </form>
 
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
+                                @unless ($chirp->created_at->eq($chirp->updated_at))
+                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
+                                @endunless
                            </div>
+                            @if ($chirp->user->is(auth()->user()))
+                                <x-dropdown>
+                                    <x-slot name="trigger">
+                                        <button>
+                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
+                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
+                                            </svg>
+                                        </button>
+                                    </x-slot>
+                                    <x-slot name="content">
+                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
+                                            {{ __('Edit') }}
+                                        </x-dropdown-link>
+                                    </x-slot>
+                                </x-dropdown>
+                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
```

## Creating the edit form

Let's create a new Blade view with a form for editing a Chirp. 
This is similar to the form for creating Chirps, except we'll post to the chirps.update route and use the @method directive to specify that we're making a "PATCH" request. 
We'll also pre-populate the field with the existing Chirp message:

`resources/views/chirps/edit.blade.php`
```php 
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.update', $chirp) }}">
            @csrf
            @method('patch')
            <textarea
                name="message"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message', $chirp->message) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('chirps.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
``` 

## Updating our controller

Let's update the edit method on our ChirpController to display our form. 
Laravel will automatically load the Chirp model from the database using route model binding so we can pass it straight to the view.
We'll then update the update method to validate the request and update the database.
Even though we're only displaying the edit button to the author of the Chirp, we still need to make sure the user accessing these routes is authorized:

`app/Http/Controllers/ChirpController.php`
```php
<?php
 ...
+ use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
 
class ChirpController extends Controller
{
 ...
    /**
     * Show the form for editing the specified resource.
     */
-    public function edit(Chirp $chirp)
+    public function edit(Chirp $chirp): View
    {
-        //
+        Gate::authorize('update', $chirp);
+ 
+        return view('chirps.edit', [
+            'chirp' => $chirp,
+        ]);
    }
    /**
     * Update the specified resource in storage.
     */
-    public function update(Request $request, Chirp $chirp)
+    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
-        //
+        Gate::authorize('update', $chirp);
+ 
+        $validated = $request->validate([
+            'message' => 'required|string|max:255',
+        ]);
+ 
+        $chirp->update($validated);
+ 
+        return redirect(route('chirps.index'));
    }
 ...
}
```

## Authorization
By default, the authorize method will prevent everyone from being able to update the Chirp. 
We can specify who is allowed to update it by creating a Model Policy with the following command:
```bash 
php artisan make:policy ChirpPolicy --model=Chirp
```
This will create a policy class at `app/Policies/ChirpPolicy.php` which we can update to specify that only the author is authorized to update a Chirp:

`app/Policies/ChirpPolicy.php`
```php
<?php
 ...
class ChirpPolicy
{
 ...
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chirp $chirp): bool
    {
        //
        return $chirp->user()->is($user);
    }
 ...
}
```

# 06. Deleting Chirps
Sometimes no amount of editing can fix a message, so let's give our users the ability to delete their Chirps.
Hopefully you're starting to get the hang of things now. We think you'll be impressed how quickly we can add this feature.

## Routing
We'll start again by updating our routes to enable the chirps.destroy route:

`routes/web.php`
```php
<?php
 ...
Route::resource('chirps', ChirpController::class)
-    ->only(['index', 'store', 'edit', 'update'])
+    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
 ...
```

## Updating our controller
Now we can update the destroy method on our ChirpController class to perform the deletion and return to the Chirp index:

`app/Http/Controllers/ChirpController.php`
```php
<?php
 ...
class ChirpController extends Controller
{
 ...
    /**
     * Remove the specified resource from storage.
     */
-    public function destroy(Chirp $chirp)
+    public function destroy(Chirp $chirp): RedirectResponse
    {
-        //
+        Gate::authorize('delete', $chirp);
+ 
+        $chirp->delete();
+ 
+        return redirect(route('chirps.index'));
    }
}
```

## Authorization
As with editing, we only want our Chirp authors to be able to delete their Chirps, so let's update the delete method in our ChirpPolicy class:

`app/Policies/ChirpPolicy.php` 
```php
<?php
 ...
class ChirpPolicy
{
 ...
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        //
        return $this->update($user, $chirp);
    }
 ...
}
```
Rather than repeating the logic from the update method, we can define the same logic by calling the update method from our delete method. Anyone that is authorized to update a Chirp will now be authorized to delete it as well.


## Updating our view
Finally, we can add a delete button to the dropdown menu we created earlier in our chirps.index view:

`resources/views/chirps/index.blade.php`
```php
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        </form>
 
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($chirp->created_at->eq($chirp->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                            @if ($chirp->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
+                                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
+                                            @csrf
+                                            @method('delete')
+                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
+                                                {{ __('Delete') }}
+                                            </x-dropdown-link>
+                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
```
