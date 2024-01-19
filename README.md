# Rest API in MVC and OOP for a simple ecommerce store [Front-end Part](https://github.com/AbdelwahabTop/scandiweb-ui)

## Table of Contents
- [Tools](#tools)
- [Instructions](#instructions)
- [How To Use the API](#how-to-use-the-api)
- [QA Test](#qa-test)

## Tools
- PHP 8.2
- Docker
- Nginx
- OOP - MVC

## Instructions
1. Clone this repository to your local machine or download it.
2. If you are using Docker, navigate to the docker directory and run `docker-compose up -d`. If you are using a different environment like XAMPP, ensure that you have a web server (Apache), PHP, and MySQL running.
   - Please note that PHP 8 is required. You may need to modify the code to make it compatible with lower PHP versions.
3. Create a `.env` file by copying the variables from `.env.example`. Fill in the necessary values in the `.env` file.
4. Ensure that the database name you entered exists. If it doesn't, create the database.
5. Confirm that when you open `http://localhost:8000`, the home page loads successfully.

## How To Use the API
### Get Products
- **URL**: `https://scandiweb-abdo.000webhostapp.com/products`
- **Method**: `GET`
- **Success Response**:
  - **Code**: 200
  - **Content**: 
    ```json
    {
      "id": "2",
      "sku": "JVC990",
      "name": "Acme Disc",
      "price": "50.60",
      "attribute": "Size: 700 MB"
    },
    {
      "id": "3",
      "sku": "SKUTest000",
      "name": "NameTest000",
      "price": "25.00",
      "attribute": "Size: 200 MB"
    }
    ```
- **Sample Call**:
  ```javascript
  async () => {
    const products = await axios.get("https://scandiweb-abdo.000webhostapp.com/products");
    return products;
  };

### Add Product
- **URL**: `https://scandiweb-abdo.000webhostapp.com/products`
- **Method**: `POST`
- **Data Params**:
  - **type**: string
  - **sku**: string
  - **name**: string
  - **price**: number
  - **attribute**:  array
- **Sampel Call**: 
  ```javascript
  const temp = {
  "type": "DVD",
  "sku": "JVC990",
  "name": "Acme Disc",
  "price": "50.60",
  "attribute": {
     "size": "98"
    }
  };

    Additional examples:
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
     "length": "589"
   }
  }

   async (temp) => {
     return await axios.post("https://scandiweb-abdo.000webhostapp.com/products", JSON.stringify(temp));
   };

### Delete Products
- **URL**: `https://scandiweb-abdo.000webhostapp.com/products/delete`
- **Method**: `POST`
- **Data Params**:
  - **ids**: [1, 2, 3, 4]
- **Sampel Call**: 
  ```javascript
  const temp = {
  "ids": [1, 2, 3, 4]
  };

   async (temp) => {
     return await axios.post("https://scandiweb-abdo.000webhostapp.com/products/delete", JSON.stringify(temp));
   };

## QA Test
