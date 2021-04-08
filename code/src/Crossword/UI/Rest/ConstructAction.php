<?php

declare(strict_types=1);

namespace App\Crossword\UI\Rest;

use App\Crossword\Application\Enum\ErrorCode;
use App\Crossword\Application\Exception\ReceiveCrosswordException;
use App\Crossword\Application\Request\ConstructRequest;
use App\Crossword\Application\Service\CrosswordReceiver;
use App\SharedKernel\Application\Response\FailedResponse;
use App\SharedKernel\Application\Response\ResponseInterface;
use App\SharedKernel\Application\Response\SuccessResponse;
use Doctrine\Common\Annotations\Annotation\IgnoreAnnotation;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IgnoreAnnotation("OA\SecurityScheme")
 * @IgnoreAnnotation("OA\Get")
 * @IgnoreAnnotation("OA\Response")
 * @IgnoreAnnotation("OA\Parameter")
 * @IgnoreAnnotation("OA\Schema")
 */
final class ConstructAction
{
    /**
     * @OA\Get(
     *     tags={"Crossword"},
     *     path="/api/crossword/construct/{language}/{type}/{words}",
     *     description="Create a new crossword",
     *     @OA\Response(response="default", description="Build a new crossword"),
     *     @OA\Parameter(
     *          name="language",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="type",
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="words",
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *          )
     *     )
     * )
     */
    #[Route('/api/crossword/construct/{language}/{type}/{words}', name: 'crossword.api.construct', methods: ['GET'])]
    public function __invoke(ConstructRequest $request, CrosswordReceiver $constructor): ResponseInterface
    {
        try {
            $crossword = $constructor->receive($request->type(), $request->language(), $request->wordCount());

            return new SuccessResponse($crossword);
        } catch (ReceiveCrosswordException) {
            return new FailedResponse(new ErrorCode(ErrorCode::CROSSWORD_NOT_RECEIVED));
        }
    }
}