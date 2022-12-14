# Планировщик задач

В системе присутствует планировщик задач, который позволяет настраивать выполнение определённых задач в назначенное время.

Для работы планировщика, в системный крон необходимо добавить выполнение следующей задачи:
```
* * * * * php path-to-your-project/ok scheduler:run
```
Где path-to-your-project является абсолютным путем к директории вашего проекта

Для регистрации задачи в модуле нужно использовать метод registerSchedule внутри метода Init. Метод принимает объект класса [Schedule](./core/Schedule.md).

Пример:
```php
class Init extends AbstractInit
{
    public function init()
    {
        $this->registerSchedule(
            (new Schedule([NovaposhtaCost::class, 'parseCitiesToCache']))
                ->name('Parses NP cities to the db cache')
                ->time('0 0 * * *')
                ->overlap(false)
                ->timeout(3600)
        );
    }
}
```

Логи работы можно найти в директории Okay/log/scheduler.

### Взаимодействие с планировщиком
Для взаимодействия с планировщиком необходимо использовать консольный помощник в директории проекта.

```
php ok scheduler:run [-f|--force]
```
Запускает выполнение всех задач, которые могут быть выполнены исходя из правил времени и пересечения. Если использовать ключ -f, то все задачи будут выполнены "насильно", в обход правил.

```
php ok scheduler:list
```
Выводит список всех зарегистрированных задач в табличном виде.
Пример:
```
+----+--------------------------------------+-----------+----------------------------------------------------------------------------+
| id | Name                                 | Time      | Command                                                                    |
+----+--------------------------------------+-----------+----------------------------------------------------------------------------+
| 1  | Parses NP cities to the db cache     | 0 0 * * * | Okay\Modules\OkayCMS\NovaposhtaCost\NovaposhtaCost::parseCitiesToCache     |
| 2  | Parses NP warehouses to the db cache | 0 0 * * * | Okay\Modules\OkayCMS\NovaposhtaCost\NovaposhtaCost::parseWarehousesToCache |
+----+--------------------------------------+-----------+----------------------------------------------------------------------------+
```

```
php ok scheduler:task [-f|--force] <task_id>
```
Запускает выполнение конкретной задачи если она может быть выполнена исходя из правил времени и пересечения. Принимает id задачи. Если использовать ключ -f, то задача будет выполнена "насильно", в обход правил.