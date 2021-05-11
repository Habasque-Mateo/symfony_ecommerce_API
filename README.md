# T-WEB-600-PAR-6-1-ecommerce-pierre-emmanuel.coq


# Routes : 

## PUT /api/user (AUTHED) : update current user information 

Body :  

-   login 

-   password 

-   email 

-   firstname 

-   lastname 

## GET /api/user (AUTHED) : get user information 

## GET /api/products Retrieve list of products 

## GET /api/product/{productId} Retrieve information on a specific product 

## POST api/product (AUTHED) 

Body : 

-   id 

-   name 

-   description 

-   photo 

-   price 

## PUT /api/product/{productId}(AUTHED) Modify a product (AUTHED) 

Body : 

-   id 

-   name 

-   description 

-   photo 

-   price 

## DELETE /api/product/{productId}(AUTHED) Delete a product (AUTHED) 

## POST /api/cart/{productId} (AUTHED) Add a product to the shopping cart. 

## DELETE /api/cart/{productId} (AUTHED) Remove a product to the shopping cart. 

## GET /api/cart (AUTHED) State of the shopping cart (list of products in the cart) 

## PATCH /api/cart/validate (AUTHED) Validation of the cart (aka converting the cart to an order) 

## GET /api/orders/ (AUTHED) recover all orders of the current user 

## GET /api/order/{orderId} (AUTHED) Get information about a specific order
