# Drafterer

> The development of this package is a bit postponed for now because of lack of time.

Drafterer is a Laravel package that allows you to save a draft version of an Eloquent model. It can be used for previewing upcoming changes before commiting them. Also useful for autosaved version.

## Install

Via Composer.
``` bash
$ composer require glaivepro/drafterer
```

Afterwards you should migrate the table for drafts. Just do it.
``` bash
$ php artisan migrate
```

## Usage

Make your model draftable.
``` php
use Illuminate\Database\Eloquent\Model;
use GlaivePro\Drafterer\Draftable;

class Article extends Model
{
    use Draftable;
	//
}
```

Save changes as a draft instead of the model itself.
``` php
$article = Article::find(1);
$article->title = 'Real title';
$article->intro = 'Real introduction';
$article->save();

$article->title = 'Draft title';
$article->drafterer->save();
```

Use the real or drafted article.
``` php
$article = Article::find(1);

$article->title;  // returns 'Real title'

$article->drafterer->title; // returns 'Draft title'
$article->drafterer->intro; // returns 'Real introduction'
```

You might want to decide to use the draft as the real version - just write it down then.
``` php
$article->drafterer->write();
```

Or you might discard it.
``` php
$article->drafterer->discard();
```

For draft-only users or conditionals we can also replace the attributes with the drafted ones.
``` php
$article->title;  // returns 'Real title'

$article->drafterer->load();

$article->title;  // returns 'Draft title'
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email juris@glaive.pro instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-packagist]: https://packagist.org/packages/GlaivePro/Drafterer
[link-author]: https://github.com/tontonsb
[link-contributors]: ../../contributors
