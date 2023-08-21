# Rest API in MVC and OOP for a simple ecommerce store
# [Front-end Part](https://github.com/AbdelwahabTop/scandiweb-ui)

 
 **Show Products**
----
  Returns json data of all products.

* **URL**

  /products

* **Method:**

  `GET`

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `
{
id: "2",
sku: "JVC990",
name: "Acme Disc",
price: "50.60",
attribute: "Size: 700 MB"
},
{
id: "3",
sku: "SKUTest000",
name: "NameTest000",
price: "25.00",
attribute: "Size: 200 MB"
}`
 

 
* **Sample Call:**

  ```axios
  async () => {
  let products = await axios.get(PRODUCTS_URL);
  return products;
   };
  ```
----
 **Create Product**
----
  Returns json data of the new product.

* **URL**

  /listing/products

* **Method:**

  `POST`
  
*  **URL Params**
  
   None

* **Data Params**

  `sku:String `
  
  `name:String `
  
  `price:Float string `
  
  `description:String `

* **Success Response:**

  * **Code:** 201 <br />
    **Content:** `
{
id: "2",
sku: "JVC990",
name: "Acme Disc",
price: "50.60",
description: "Size: 700 MB"
}`
 
* **Error Response:**

  * **Code:** 400 <br />
    **Content:** `{ message : "Error Could not make product either sku duplicated or a field is empty" }`

 
* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/listing/products",
      dataType: "json",
      data: {sku: "JVC990", name: "Acme Disc", price: "50.60", description: "Size: 700 MB"},
      type : "POST",
      success : function(r) {
        console.log(r);
      }
    });
  ```
----
 **Delete Product/s**
----
  Deletes multiple or single product.

* **URL**

  /listing/products

* **Method:**

  `GET`
  
*  **URL Params**
  
   None

* **Data Params**

  `id: Comma Seperated string containing 1 or more id`

* **Success Response:**

  * **Code:** 204 <br />
    **Content:**
    
    no content
 
* **Error Response:**

  * **Code:** 404 <br />
    **Content:** `{ message : "Error could not find product with such id" }`

 
* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/listing/products",
      dataType: "json",
      data:{id:"2,5,7,15"},
      type : "DELETE",
      success : function(r) {
        console.log(r);
      }
    });
  ```
 
