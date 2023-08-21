# Rest API in MVC and OOP for a simple ecommerce store
# [Front-end Part](https://github.com/AbdelwahabTop/scandiweb-ui)

 
 **Get Products**
----
  Returns json data of all products.

* **URL**

  https://scandiweb-abdo.000webhostapp.com/products

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
  let products = await axios.get("https://scandiweb-abdo.000webhostapp.com/products");
  return products;
   };
  ```
----
 **Add Product**
----
  Returns json data of the new product.

* **URL**

  https://scandiweb-abdo.000webhostapp.com/products

* **Method:**

  `POST`

* **Data Params**

  `sku:String `
  
  `name:String `
  
  `price:Float string `
  
  `description:String `

* **Sample Call:**

  ```axios
    let temp = {
    id: "2",
    sku: "JVC990",
    name: "Acme Disc",
    price: "50.60",
    attribute: "Size: 700 MB"
    }
  
   async (temp) => {
  return await axios.post("https://scandiweb-abdo.000webhostapp.com/products", JSON.stringify(temp));
  };
  ```
----
 **Delete Products**
----
  Deletes multiple or single product.

* **URL**

  https://scandiweb-abdo.000webhostapp.com/products/delete

> Note: Due to the limitations of 000webhostapp, I had to use the POST method instead of the DELETE method to delete products. 
As a result, I added an additional route (/products/delete) alongside the existing route (/products) to handle the deletion. 
This was necessary because my application relies on registering routes and methods separately,and I couldn't use the same route with the POST method.

* **Method:**

  `POST`

* **Data Params**

  `ids: [1, 2, 3, 4]`
 
* **Sample Call:**

  ```axios
  let temp = {
    ids: [1, 2, 3, 4]
  }
    async (temp) => {
    return await axios.post("https://scandiweb-abdo.000webhostapp.com/products/delete", JSON.stringify(temp));
  };
  ```
 
