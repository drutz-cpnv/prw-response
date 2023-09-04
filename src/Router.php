<?php

namespace App;

class Router
{

	private array $routes = [];

	public function __construct(
		private string $viewRootPath = "./",

	)
	{}


	public function add(string $url, string $view, array $methods = ['GET']): self
	{
		[$attrs, $pattern] = $this->routeRe($url);

		$this->routes[] = [
			'url' => $url,
			'pattern' => $pattern,
			'attrs' => $attrs,
			'methods' => $methods,
			'view' => $view . ".php"
		];

		return $this;
	}


	public function run(): void
	{
		$url = explode('?',$_SERVER['REQUEST_URI'])[0];
		$method = $_SERVER['REQUEST_METHOD'];

		foreach ($this->routes as $route) {
			if(!in_array($method, $route['methods'])) continue;

			if(preg_match_all($route['pattern'], $url, $matches) !== 0) {
				$context = [
					'url' => $url,
					'method' => $method,
					'headers' => [
						'accept' => explode(',', $_SERVER['HTTP_ACCEPT']),
					]
				];
				//dd($route['attrs'], $matches);
				foreach ($route['attrs'] as $attr) {
					$context[$attr] = $matches[$attr][0];
				}

				//dd($context);

				require "$this->viewRootPath{$route['view']}";

				exit();
				break;
			}

		}

		http_response_code(404);

	}


	private function routeRe(string $url): array
	{
		$exploded = explode('/', ltrim($url, '/'));
		$output = "^";
		$attrs = [];
		foreach ($exploded as $str) {
			if(preg_match_all('`\[\w+]`', $str, $matches)) {
				$attName = trim($matches[0][0], "[]");
				$attrs[] = $attName;
				$output .= "\/(?<$attName>\w+-?\w+)";
			} else {
				$output .= "\/(?<_ressource>$str)";
			}

		}

		return [
			$attrs,
			"`$output$`"
		];

	}


}