<?php

namespace app\DTO;

class ImageResponse
{

    public string $messages;

    public function __construct(string $messages)
    {
        $this->messages = $messages;
    }

}