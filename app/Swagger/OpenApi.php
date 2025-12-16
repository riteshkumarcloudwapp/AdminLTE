<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *   @OA\Info(
 *     title="My Laravel API",
 *     version="1.0.0",
 *     description="API documentation for Laravel project"
 *   )
 * )
 * 
 *  @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 *     )
 */
class OpenApi {}
