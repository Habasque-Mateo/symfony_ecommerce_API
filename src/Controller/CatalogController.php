<?php 
namespace App\Controller;

use App\Repository\CatalogRepository;
use JsonException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class CatalogController
{
    private $catalogRepository;
    public function __construct(CatalogRepository $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    /**
    * @Route("/api/product", name="add_catalog", methods={"POST"})
    */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['name']) || empty($data['description']) || empty($data['photo']) || empty($data['price']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $catalog = $this->catalogRepository->saveCatalog($data['name'], $data['description'], $data['photo'], $data['price']);
        return new JsonResponse(
        [
            'id' => $catalog->getId(),
            'name' => $catalog->getName(),
            'description' => $catalog->getDescription(),
            'photo' => $catalog->getPhoto(),
            'price' => $catalog->getPrice()
        ], 
        Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/product/{productId}}", name="get_one_product", methods={"GET"})
     */
    public function get($productId): JsonResponse
    {
        $catalog = $this->CatalogRepository->findOneById(['id' => $productId]);

        $data = [
            'id' => $catalog->getId(),
            'name' => $catalog->getName(),
            'description' => $catalog->getDescription(),
            'photo' => $catalog->getPhoto(),
            'price' => $catalog->getPrice(),
            
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }
}

?>
