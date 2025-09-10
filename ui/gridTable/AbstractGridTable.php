<?php

namespace app\ui\gridTable;

use ReflectionClass;
use ReflectionProperty;

abstract class AbstractGridTable
{
    public static function getColumns(): array
    {
        $ref = new ReflectionClass(static::class);

        $properties = $ref->getProperties(ReflectionProperty::IS_PUBLIC);
        $columns = [];
        foreach ($properties as $prop) {
            $attrs = $prop->getAttributes(GridColumn::class);
            /** @var GridColumn $meta */
            $meta = $attrs[0]->newInstance();
            $attributeName = $prop->getName();
            $callback = $meta->formatter !== null
                ? [static::class, $meta->formatter] // вызов метода
                : fn($model) => $model->{$attributeName};// просто свойство DTO

            $columns[] = [
                'attribute' => $attributeName,
                'label' => $meta->label,
                'value' => $callback,
                'format' => 'raw',
            ];
        }
        return $columns;
    }
}