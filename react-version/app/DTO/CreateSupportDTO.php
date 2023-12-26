<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateSupport;

class CreateSupportDTO
{
    public function __construct(
        public string $subject, // o padrão é publico, mas pode ser private ou protected
        public string $status,
        public string $body
    ) {
    }


    public static function makeFromRequest(StoreUpdateSupport $request): self // retorna um objeto da propria class
    {
        return new self(
            $request->subject,
            'active',
            $request->body
        );
    }
}
