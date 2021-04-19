<?php 
namespace App\Controller;

use App\Repository\CatalogRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        
        $name = $data['name'];
        $description = $data['description'];
        $photo = $data['photo'];
        $price = $data['price'];

        if(empty($name) || empty($description) || empty($photo) || empty($price))
        {
            throw new NotFoundHttpException('Expecting mandatory parameters.');
        }

        $this->catalogRepository->saveCatalog($name, $description, $photo, $price);
        
        return new JsonResponse(['status' => 'Product created'], Response::HTTP_CREATED);
    }
}

?>
