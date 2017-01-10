<?php
namespace App\Markdown;
/**
 * Markdown 简单封装
 */
class Markdown
{
	protected $parser;
	
	public function __construct()
	{
		$this->parser = new Parser;
	}

	public function markdown($text)
	{
		return $this->parser->makeHtml($text);
	}
}