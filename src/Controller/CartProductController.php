<?php 
namespace App\Controller;

use App\Repository\CartProductRepository;
use App\Repository\CartRepository;
use App\Repository\CatalogRepository;
use App\Repository\OrdersRepository;
use App\Repository\OrderProductRepository;
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
    private $orderRepository;
    private $orderProductRepository;

    public function __construct(CartProductRepository $cartProductRepository, CartRepository $cartRepository, CatalogRepository $catalogRepository, OrdersRepository $orderRepository, OrderProductRepository $orderProductRepository)
    {
        $this->cartProductRepository = $cartProductRepository;
        $this->cartRepository = $cartRepository;
        $this->catalogRepository = $catalogRepository;
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
    }

    /**
    * @Route("/api/orders", name="get_all_user_orders", methods={"GET"})
    */
    public function getAllOrders(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $cart = $this->cartRepository->findOneByUserLogin($data['userLogin']);

        if(empty($cart))
        {
            return new JsonResponse(["error" => "Cart not found."], 400);
        }

        $order = $this->orderRepository->findBy(["cartId"=> $cart]);

        $orderProducts = $this->orderProductRepository->findBy(["orderId"=> $order]);

        //fill order
        $products = [];
        $totalPrice = 0;
        foreach($orderProducts as $childProduct)
        {
            $product = $childProduct->getProductId();
            
            $products[] = [
                "id" => $product->getId(),
                "name" => $product->getName(),
                "description" => $product->getDescription(),
                "photo" => $product->getPhoto(),
                "price" => $product->getPrice()
            ];

            $totalPrice += $product->getPrice();
        }

        $retData = [
            "id" => $order->getId(),
            "totalPrice" => $totalPrice,
            "creationDate" => $order->getCreationDate()->format('Y-m-d H:i:s'),
            "products" => $products
        ];

        return new JsonResponse($retData, Response::HTTP_OK);
    }

     /**
    * @Route("/api/order/{orderId}", name="get_one_user_order", methods={"GET"})
    */
    public function getOrderbyId(Request $request, $orderId): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $cart = $this->cartRepository->findOneByUserLogin($data['userLogin']);

        if(empty($cart))
        {
            return new JsonResponse(["error" => "Cart not found."], 400);
        }

        $order = $this->orderRepository->findBy(["id"=> $orderId]);

        $orderProducts = $this->orderProductRepository->findBy(["orderId"=> $order]);

        //fill order
        $products = [];
        $totalPrice = 0;
        foreach($orderProducts as $childProduct)
        {
            $product = $childProduct->getProductId();
            
            $products[] = [
                "id" => $product->getId(),
                "name" => $product->getName(),
                "description" => $product->getDescription(),
                "photo" => $product->getPhoto(),
                "price" => $product->getPrice()
            ];

            $totalPrice += $product->getPrice();
        }

        $retData = [
            "id" => $order->getId(),
            "totalPrice" => $totalPrice,
            "creationDate" => $order->getCreationDate()->format('Y-m-d H:i:s'),
            "products" => $products
        ];

        return new JsonResponse($retData, Response::HTTP_OK);
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
            'productId' => $cartProduct->getProductId()->getId(),
            'cartId' => $cartProduct->getCartId()->getId()
        ], 
        Response::HTTP_CREATED);
    }

    /**
    * @Route("/api/cart/{productId}", name="remove_product_to_cart", methods={"DELETE"})
    */
    public function remove(Request $request, $productId): JsonResponse
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

        $cartProduct = $this->cartProductRepository->findOneByPK($cart->getId(), $product->getId());

        $this->cartProductRepository->removeCartProduct($cartProduct);


        return new JsonResponse(["status" => "Product deleted"], Response::HTTP_NO_CONTENT);
    }

    /**
    * @Route("/api/cart", name="get_all_product_to_cart", methods={"GET"})
    */
    public function getAll(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $cart = $this->cartRepository->findOneByUserLogin($data['userLogin']);

        if(empty($cart))
        {
            return new JsonResponse(["error" => "Cart not found."], 400);
        }

        $cartProducts = $this->cartProductRepository->findBy(['cartId' => $cart->getId()]);

        $retData = [];

        foreach($cartProducts as $childProduct)
        {
            $product = $childProduct->getProductId();
            $retData[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'photo' => $product->getPhoto(),
                'price' => $product->getPrice(),
            ];
        }

        return new JsonResponse($retData, Response::HTTP_OK);
    }

    /**
    * @Route("/api/cart/validate", name="convert_cart_into_order", methods={"PATCH"})
    */
    public function createOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $cart = $this->cartRepository->findOneByUserLogin($data['userLogin']);

        if(empty($cart))
        {
            return new JsonResponse(["error" => "Cart not found."], 400);
        }

        $cartProducts = $this->cartProductRepository->findBy(['cartId' => $cart->getId()]);

        if(count($cartProducts) < 1)
        {
            return new JsonResponse(["error" => "Cart is empty."], 400);
        }

        $order = $this->orderRepository->saveOrder(date("Y-m-d H:i:s"), $cart);

        //fill order
        $products = [];
        $totalPrice = 0;
        foreach($cartProducts as $childProduct)
        {
            $product = $childProduct->getProductId();
            $orderProduct = $this->orderProductRepository->saveOrderProduct($product, $order);
            
            $products[] = [
                "id" => $product->getId(),
                "name" => $product->getName(),
                "description" => $product->getDescription(),
                "photo" => $product->getPhoto(),
                "price" => $product->getPrice()
            ];

            $totalPrice += $product->getPrice();
        }

        $retData = [
            "id" => $order->getId(),
            "totalPrice" => $totalPrice,
            "creationDate" => $order->getCreationDate()->format('Y-m-d H:i:s'),
            "products" => $products
        ];

        foreach($cartProducts as $childProduct)
        {
            $this->cartProductRepository->removeCartProduct($childProduct);
        }

        return new JsonResponse($retData, Response::HTTP_CREATED);
    }
}

?>
