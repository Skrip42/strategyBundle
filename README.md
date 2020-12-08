# strategy-bundle
implement strategy and specification pattern in symfony

## install:
- run `composer require skrip42/strategy-bundle`

## base usage:
### strategy:
extends strategy manager:
```php
namespace App\Services\Test;

use Skrip42\Bundle\StrategyBundle\StrategyManagerAbstract;

class TestStrategyManager extends StrategyManagerAbstract
{
}
```

implements strategy interface:
```php
namespace App\Services\Test;

use Skrip42\Bundle\StrategyBundle\StrategyInterface;

abstract class TestStrategyAbstract implements StrategyInterface
{
    abstract public function doSomething();
}
```

create strategies:
```php
namespace App\Services\Test;

class Strategy1 extends TestStrategyAbstract
{
    public function doSomething()
    {
        .....
    }
}

class Strategy2 extends TestStrategyAbstract
{
    public function doSomething()
    {
        .....
    }
}
```

define:
```yaml
    App\Services\Test\TestStrategyManager:
        tags: [skrip42.strategy_manager]
        properties:
          strategy:
            strategy1: App\Services\Test\Strategy1
            strategy2: App\Services\Test\Strategy2
```

and call strategy by name!
```php
public function test(TestStrategyManager $manager): Response
{
    $strategy = $manager->get('strategy1');
    $anotherStrategy = $manager->get('strategy2');
}
```

### specification:
extends strategy manager:
```php
namespace App\Services\Test;

use Skrip42\Bundle\StrategyBundle\StrategyManagerAbstract;

class TestSpecificationManager extends SpecificationManagerAbstract
{
}
```

implements strategy interface:
```php
namespace App\Services\Test;

use Skrip42\Bundle\StrategyBundle\SpecificationInterface;

abstract class TestSpecificationAbstract implements SpecificationInterface
{
    abstract public function isStatisfiedBy($criteria) : bool;
    abstract public function doSomething();
}
```

create strategies:
```php
namespace App\Services\Test;

class Specification1 extends TestSpecificationAbstract
{
    public function isStatisfiedBy($criteria) : bool
    {
        ...check condition
    }

    public function doSomething()
    {
        .....
    }
}

class Specification2 extends TestSpecificationAbstract
{
    public function isStatisfiedBy($criteria) : bool
    {
        ...check condition
    }

    public function doSomething()
    {
        .....
    }
}
```

define:
```yaml
    App\Services\Test\TestSpecificationManager:
        tags: [skrip42.specification_manager]
        properties:
          specification:
            strategy1: App\Services\Test\Specification1
            strategy2: App\Services\Test\Specification2
```

and call specification!
```php
public function test(TestSpecificationManager $manager): Response
{
    $specification = $manager->getFirst($condition); //get the first specification that meets the condition
    $specification = $manager->getAll($condition);   //get all specifications that meets the condition
}
```



