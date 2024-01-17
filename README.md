# Rest API in MVC and OOP for a simple ecommerce store
[Installation](#installation)

# [Front-end Part](https://github.com/AbdelwahabTop/scandiweb-ui)

# Tools
  * PHP 8.2
  * Docker
  * Nginx
  * OOP - MVC

 #### Instructions
1. Clone this repository to your local or download it.
2. If you are using docker you can `cd` into the docker directory & run `docker-compose up -d`. If you are using something else like XAMPP just make sure you have Web Server (Apache), PHP & MySQL running.
   * Please note that **PHP 8** is required. You will need to adjust the code to make it work for lower PHP versions.
3. Create a `.env` file by copying variables from `.env.example`. Fill in those values in `.env` file.
4. Make sure that whatever database name you enter actually exists, if not, create that database.
5. Confirm that once you open your `http://localhost:8000` it loads the home page.

 ###installation


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
  `type:String `

  `sku:String `
  
  `name:String `
  
  `price:Float string `
  
  `attribute:array `

* **Sample Call:**

  ```axios
    let temp = {
    "type": "DVD",
    "sku": "JVC990",
    "name": "Acme Disc",
    "price": "50.60",
    "attribute": {
         "size": "98"
      }
    }

   {
    "type": "book",
    "sku": "JVC990",
    "name": "Acme Disc",
    "price": "50.60",
    "attribute": {
         "weight": "98"
      }
    }
  
  {
    "type": "furniture",
    "sku": "JVC990",
    "name": "Acme Disc",
    "price": "50.60",
    "attribute": {
        "height": "89",
         "width": "89",
         "length": "589",
      }
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
As a result, I added an additional route (/products/delete) alongside the existing route (/products) to handle the deletion. I have only one route for all methods but I changed on webhost code. This was necessary because my application relies on registering routes and methods ,and I couldn't use the same route with the POST method.

* **Method:**

  `POST`

* **Data Params**

  `ids: [1, 2, 3, 4]`
 
* **Sample Call:**

  ```axios
  let temp = {
    "ids": [1, 2, 3, 4]
  }
    async (temp) => {
    return await axios.post("https://scandiweb-abdo.000webhostapp.com/products/delete", JSON.stringify(temp));
  };
  ```
