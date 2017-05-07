# What can we do when we purchase products?
Frontend
ok - Put products in the cart
- Remove products in the cart
- See total qty
- See sum
- Send order with cart
- Save Cart in some temp place

- Product added
ok -- Addonable same-product-id products are in different set when added in cart 
ok -- Un-Addonable same-product-id products are in same set when added in cart 
-- Can put add-on
-- Product and add on should be in same set
-- Product should be listed before add-on
-- Could know if an item is product or add-on
-- Addon base qty has same qty as the product in same set 

- Remove
-- Can remove an item : product and add-on
-- The addons in same set are removed if product in that set are removed

- Update
-- Can update the products items
-- The qty of addons in the same set are updated automatically if product qty is updated 


- Set addon options
- Only sales person can put products in the cart



# What can we do with an order?
Admin
- Can audit order
- Can see order details
- Audit process should be recorded


Frontend
- Can see order status
- Can cancel order if the order is not audited yet
- Should receive a shipment notice when order is shipped out