<?php

namespace ssim\Controllers\Http\Pilots;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use Slim\Views\Twig;

use ssim\Repository\Company;

final class AddCompany {

  protected $twig;
  protected $company;

  public function __construct(Twig $twig, Company $company) {
    $this->twig = $twig;
    $this->company = $company;
  }

  public function __invoke(ServerRequest $request, Response $response): ResponseInterface {
    $this->company->addNew($request->getParsedBody());
    return $this->twig->render($response, 'pilots/view.twig');
  }
}