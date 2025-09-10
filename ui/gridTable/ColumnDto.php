<?php

namespace app\ui\gridTable;

use Closure;

class ColumnDto
{
    public function __construct(
        public string $attribute,
        public string $label,
        public Closure $callback,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'attribute' => $this->attribute,
            'label' => $this->label,
            'value' => $this->callback,
        ];
    }
}