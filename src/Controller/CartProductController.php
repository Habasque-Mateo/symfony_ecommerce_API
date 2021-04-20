<?php 
namespace App\Controller;

use App\Repository\CartProductRepository;
//use App\Repository\CartRepository;
use App\Repository\UserRepository;
use JsonException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class CartProductController
{
    private $cartProductRepository;
    //private $cartRepository;
    private $userRepository;
    public function __construct(CartProductRepository $cartProductRepository, UserRepository $userRepository)
    {
        $this->cartProductRepository = $cartProductRepository;
       // $this->cartRepository = $cartRepository;
        $this->userRepository = $userRepository;
    }

    /**
    * @Route("/api/cart/{productId}", name="add_product_to_cart", methods={"POST"})
    */
    public function add(Request $request): JsonResponse
    {
        $productId = $request->query->get('productId');
        $data = json_decode($request->getContent(), true);
        if(empty($productId) || empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $user = $this->userRepository->findOneByLogin($data['userLogin']);

        if(empty($user))
        {
            return new JsonResponse(["error" => "user not found."], 400);
        }

        $cartId = $user->getCarts()[0]->getId();

        $cartProduct = $this->cartProductRepository->saveCartProduct($productId, $cartId);

        return new JsonResponse(
        [
            'productId' => $cartProduct->getProductId(),
            'cartId' => $cartProduct->getCartId()
        ], 
        Response::HTTP_CREATED);
    }
}

?>
