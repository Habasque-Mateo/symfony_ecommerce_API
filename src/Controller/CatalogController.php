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
     * @Route("/api/product/{productId}", name="get_one_product", methods={"GET"})
     */
    public function get($productId): JsonResponse
    {
        $catalog = $this->catalogRepository->findOneById($productId);

        $data = [
            'id' => $catalog->getId(),
            'name' => $catalog->getName(),
            'description' => $catalog->getDescription(),
            'photo' => $catalog->getPhoto(),
            'price' => $catalog->getPrice(),
            
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/api/products", name="get_all_products", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        //Find all existe nativement avec doctrine, pas besoin de l'implémenter dans le repo
        $catalog = $this->catalogRepository->findAll();
        $data = [];

        foreach($catalog as $product)
        {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'photo' => $product->getPhoto(),
                'price' => $product->getPrice(),
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/product/{productId}", name="update_product", methods={"PUT"})
     */
    public function update($productId, Request $request)
    {
        $catalog = $this->catalogRepository->findOneById($productId);
        $data = json_decode($request->getContent(), true);

        empty($data['name']) ? true : $catalog->setName($data['name']);
        empty($data['description']) ? true : $catalog->setDescription($data['description']);
        empty($data['photo']) ? true : $catalog->setPhoto($data['photo']);
        empty($data['price']) ? true : $catalog->setPrice($data['price']);

        $updatedCatalog = $this->catalogRepository->updateCatalog($catalog);

        return new JsonResponse($updatedCatalog->toArray(), Response::HTTP_OK);
    }

    /**
     * @Route("/api/product/{productId}", name="delete_product", methods={"DELETE"})
     */
    public function delete($productId): JsonResponse
    {
        $catalog = $this->catalogRepository->findOneById($productId);

        $this->catalogRepository->removeCatalog($catalog);
        
        return new JsonResponse(["status" => "Product deleted"], Response::HTTP_NO_CONTENT);
    }

}

?>
