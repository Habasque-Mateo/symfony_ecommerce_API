<?php 
namespace App\Controller;

use App\Repository\CatalogRepository;
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
            throw new NotFoundHttpException("error");
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
}

?>
