<?php


namespace Mdigi\PBB\Exceptions;


class FormatNopNotValidException extends \Exception
{
    protected $code = 422;
    protected $message = 'Format NopHelper not valid';
}