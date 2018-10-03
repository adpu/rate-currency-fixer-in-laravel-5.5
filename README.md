# Example of Currency exchange rates for Laravel 5.5

## Steps:

1 -  Install laravel-swap with composer:


```
composer require florianv/laravel-swap php-http/message php-http/guzzle6-adapter

```

2 -  In /config/app.php add 'Providers' and 'aliases':

// Providers

```
Swap\Laravel\SwapServiceProvider::class

```

// Aliases

```
'Swap' => Swap\Laravel\Facades\Swap::class

```

3 -  Publish the Package configuration:

```
php artisan vendor:publish --provider="Swap\Laravel\SwapServiceProvider"

```

4 - By default only is enable "Fixer" service , you must create an API from fixer website. After this add it  in /config/swap.php:

```
'services' => [
        'fixer' => ['access_key' => 'YOUR_KEY', 'enterprise' => false],
```

5 - Create a Controller HomeController:

```
use Illuminate\Http\Request;

use App\Http\Requests;


class HomesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
       $rate = \Swap::latest('EUR/JPY');
       $rate2 = \Swap::latest('EUR/USD');

       $ratio=$rate->getValue();
       $ratio2=$rate2->getValue();
       $jpn_eur=1/$ratio;
       $usd_eur=1/$ratio2;
       $jpn_usd=(1/$ratio)*$ratio2;



       
        return view('welcome',compact('ratio','rate2','ratio','ratio2','jpn_eur','usd_eur','jpn_usd'));
    }

```

6 - Create view (welcome.blade.php):


```
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

  
    </head>
    <body>
       

            <div class="content">
                <div class="title m-b-md">
                   Ratio EUR / JPY :{{$ratio}}<br>
                   Ratio EUR / USD :{{$ratio2}}<br>
                   1 yen is {{$jpn_eur}} Euro<br>
                   1 usd is {{$usd_eur}} Euro<br>
                   1 yen is {{$jpn_usd}} Dollar<br>
                </div>

                
            </div>

    </body>
</html>

```

## Attention

Free version of "Fixer" works with EUR currency only.
It is recommendable to use different services to solve situations in case of failure. To make it :

```
'services' => [
    'fixer' => ['access_key' => 'YOUR_KEY'],
    'currency_layer' => ['access_key' => 'secret', 'enterprise' => false],
    'forge' => ['api_key' => 'secret'],
] 

```


## References:

References of countries and states databases are from:

https://github.com/florianv/laravel-swap


