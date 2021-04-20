<?php 
namespace App\Controller;

use App\Repository\CartProductRepository;
use App\Repository\CartRepository;
use App\Repository\CatalogRepository;
use JsonException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class CartProductController
{
    private $cartProductRepository;
    private $cartRepository;
    private $catalogRepository;
    public function __construct(CartProductRepository $cartProductRepository, CartRepository $cartRepository, CatalogRepository $catalogRepository)
    {
        $this->cartProductRepository = $cartProductRepository;
        $this->cartRepository = $cartRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
    * @Route("/api/cart/{productId}", name="add_product_to_cart", methods={"POST"})
    */
    public function add(Request $request, $productId): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($productId) || empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $product = $this->catalogRepository->findOneById($productId);

        if(empty($product))
        {
            return new JsonResponse(["error" => "Product not found."], 400);
        }

        $cart = $this->cartRepository->findOneByUserLogin($data['userLogin']);

        if(empty($cart))
        {
            return new JsonResponse(["error" => "Cart not found."], 400);
        }

        $cartProduct = $this->cartProductRepository->saveCartProduct($product, $cart);

        return new JsonResponse(
        [
            'productId' => $cartProduct->getProductId(),
            'cartId' => $cartProduct->getCartId()
        ], 
        Response::HTTP_CREATED);
    }
}

?>
